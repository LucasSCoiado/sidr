<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Remedio;
use Carbon\Carbon;

class DecrementRemediosStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remedios:decrement-stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Decrementa qtdRestante de cada remédio com base no consumo diário e dias passados.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $remedios = Remedio::all();
        $this->info('Iniciando decremento de estoque para '. $remedios->count() .' remédios.');

        foreach ($remedios as $remedio) {
            $quantidadeTomada = (int) $remedio->quantidadeTomada;
            $frequencia = (int) $remedio->frequencia;
            $dailyConsumption = $quantidadeTomada * $frequencia;

            // Se consumo diário é 0, nada a decrementar
            if ($dailyConsumption <= 0) {
                continue;
            }

            // Se nunca decrementado antes, use created_at como referência
            $last = $remedio->last_decremented_at ? Carbon::parse($remedio->last_decremented_at) : Carbon::parse($remedio->created_at);

            // Quantos dias se passaram (inteiros)
            $days = $last->diffInDays($now);

            if ($days <= 0) {
                continue; // nada a fazer
            }

            $subtract = $days * $dailyConsumption;
            $newQtd = max(0, (int) $remedio->qtdRestante - $subtract);

            // Recalcula caixas com base em quantidade por caixa (se disponível)
            $quantidadeCaixa = (int) $remedio->quantidadeCaixa;
            if ($quantidadeCaixa > 0) {
                // número de caixas inteiras restantes após decrementar unidades
                $newCaixas = intdiv($newQtd, $quantidadeCaixa);
                $remedio->caixas = $newCaixas;
            }

            $remedio->qtdRestante = $newQtd;
            // atualiza last_decremented_at para hoje
            $remedio->last_decremented_at = $now;
            $remedio->save();

            $this->info("Remédio ID {$remedio->id}: -{$subtract} (dias: {$days}, consumo/dia: {$dailyConsumption}) => nova qtdRestante: {$newQtd}, caixas: {$remedio->caixas}");
        }

        $this->info('Decremento finalizado.');
        return 0;
    }
}
