<?php

namespace App\Http\Controllers;

use App\Models\Remedio;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RemediosController extends Controller
{
    public function index()
    {
        $remedios = Remedio::all();

        foreach ($remedios as $remedio) {

            // 1 — Se não existe last_decremented_at, cria agora mas NÃO desconta nada
            if (!$remedio->last_decremented_at) {
                $remedio->last_decremented_at = now();
                $remedio->save();
                continue;
            }

            // 2 — Compara datas apenas pelo DIA
            $last = $remedio->last_decremented_at->copy()->startOfDay();
            $today = now()->startOfDay();

            // Já houve desconto hoje? → não desconta de novo
            if ($last->equalTo($today)) {
                continue;
            }

            // 3 — Quantos dias passaram desde o último desconto?
            $days = $last->diffInDays($today);

            if ($days > 0) {

                // 4 — Consumo diário CORRETO
                // toma X comprimidos por dose * quantas vezes ao dia
                $dailyAmount = $remedio->quantidadeTomada * $remedio->frequencia;

                // proteção: se não tem consumo diário válido, apenas atualiza a data
                if ($dailyAmount <= 0) {
                    $remedio->last_decremented_at = now();
                    $remedio->save();
                    continue;
                }

                // 5 — Quanto remover no total
                $totalToRemove = $days * $dailyAmount;

                // 6 — Aplica o desconto sem deixar negativo
                $remedio->qtdRestante = max(0, $remedio->qtdRestante - $totalToRemove);

                // 7 — Recalcula quantidade de caixas restantes
                if ($remedio->quantidadeCaixa > 0) {
                    $remedio->caixas = intdiv($remedio->qtdRestante, $remedio->quantidadeCaixa);
                }

                // 8 — Marca que o desconto foi feito HOJE
                $remedio->last_decremented_at = now();
                $remedio->save();
            }
        }

        return view('remedios.home', compact('remedios'));
    }

    public function create()
    {
        return view('remedios.create');
    }

    public function store(Request $request)
    {
        $remedios = $request->validate([
            'nome' => 'required|string|max:255',
            'frequencia' => 'required|integer',
            'quantidadeCaixa' => 'required|integer',
            'quantidadeTomada' => 'required|integer',
            'miligramas' => 'required|integer',
            'caixas' => 'required|integer',
            'dose' => 'required|integer',
        ]);

        $remedios['qtdRestante'] = $request->quantidadeCaixa * $request->caixas;
        
        Remedio::create($remedios);

        return redirect()->route('remedios.home');
    }

    public function update($id)
    {
        $remedios = Remedio::findOrFail($id);
        return view('remedios.edit', compact('remedios'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $remedios = Remedio::findOrFail($id);
        $originalQtd = (int) $remedios->qtdRestante;
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'miligramas' => 'required|integer|min:0',
            'quantidadeTomada' => 'required|integer|min:0',
            'dose' => 'required|integer|min:0',
            'frequencia' => 'required|integer|min:0',
            'caixas' => 'nullable|integer|min:0',
            'qtdRestante' => 'nullable|integer|min:0',
            'add_caixas' => 'nullable|integer|min:0',
            'add_qtdRestante' => 'nullable|integer|min:0',
        ]);
        // $remedios['qtdRestante'] = $remedios->qtdRestante;
        $remedios->nome = $validated['nome'];
        $remedios->miligramas = $validated['miligramas'];
        // $remedios->qtdRestante = $request->qtdRestante;
        $remedios->quantidadeTomada = $request->quantidadeTomada;
        $remedios->dose = $request->dose;
        // If user submits an 'add_caixas' value, increment caixas; otherwise, if they submitted 'caixas' treat it as replacement
        if (!empty($validated['add_caixas'])) {
            $remedios->caixas = $remedios->caixas + (int) $validated['add_caixas'];
        } elseif (!empty($validated['caixas'])) {
            $remedios->caixas = (int) $validated['caixas'];
        }
        $remedios->frequencia = $validated['frequencia'];

        // If user submitted an addition for qtdRestante, sum it with current qtdRestante
        if (!empty($validated['add_qtdRestante'])) {
            $remedios->qtdRestante = $remedios->qtdRestante + (int) $validated['add_qtdRestante'];
        } elseif (!empty($validated['qtdRestante'])) {
            $remedios->qtdRestante = (int) $validated['qtdRestante'];
        }

        // If qtdRestante changed (manualmente ou por adição), recalc caixas com base em quantidadeCaixa
        $finalQtd = (int) $remedios->qtdRestante;
        $quantidadeCaixa = (int) $remedios->quantidadeCaixa;
        if ($finalQtd !== $originalQtd) {
            if ($quantidadeCaixa > 0) {
                $remedios->caixas = intdiv($finalQtd, $quantidadeCaixa);
            }
            // atualiza last_decremented_at para agora, já que o usuário alterou o estoque manualmente
            $remedios->last_decremented_at = Carbon::now();
        }

        $remedios->save();
        return redirect()->route('remedios.home');
    }

    public function delete($id)
    {
        $remedios = Remedio::findOrFail($id);
        return view('remedios.delete', compact('remedios'));
    }
    public function destroy($id)
    {
        $remedios = Remedio::findOrFail($id);
        $remedios->delete();
        return redirect()->route('remedios.home');
    }

    public function fimDeEstoque()
    {
        $remedios = Remedio::all();
        return view('esgotar.home', compact('remedios'));
    }

    public function medicamento($id)
    {
        $remedios = Remedio::findOrFail($id);
        // Calcular consumo diário: quantidade tomada por vez * frequencia diária
        $quantidadeTomada = (int) $remedios->quantidadeTomada;
        $frequencia = (int) $remedios->frequencia;
        $dailyConsumption = $quantidadeTomada * $frequencia;

        // Evita divisão por zero; se consumo diário for 0, considera duração 0
        if ($dailyConsumption > 0) {
            //$tempoDuracao = (int) ceil((float) $remedios->qtdRestante / $dailyConsumption);
            $tempoDuracao = (int) ($remedios->qtdRestante / $dailyConsumption);
        } else {
            $tempoDuracao = 0;
        }

        $sobra = $remedios->qtdRestante % $dailyConsumption;

        return view('remedios.medicamento', compact(
            'remedios', 
            'tempoDuracao',
            'dailyConsumption',
            'quantidadeTomada',
            'frequencia',
            'sobra'
        ));
    }

    public function take(Request $request, $id)
    {
        $remedio = Remedio::findOrFail($id);

        $taken = (int) $request->input('taken', 1);

        // decrement by number of doses taken * dose (dose() returns attribute)
        $decrement = $taken * $remedio->dose;

        $remedio->qtdRestante = max(0, $remedio->qtdRestante - $decrement);

        if ($remedio->quantidadeCaixa > 0) {
            $remedio->caixas = intdiv($remedio->qtdRestante, $remedio->quantidadeCaixa);
        }

        $remedio->last_decremented_at = Carbon::now();
        $remedio->save();

        return redirect()->route('remedios.home');
    }

}
