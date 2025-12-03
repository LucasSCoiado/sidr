<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Remedio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class RemediosTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_store()
    {
        // Cria um modelo e usa seus dados para o POST (limpando id/timestamps)
        $remedioModel = $this->modelo_para_test();
        $dados = $remedioModel->toArray();
        unset($dados['id'], $dados['created_at'], $dados['updated_at']);

        // Envia requisição POST
        $response = $this->post(route('remedios.store'), $dados);
        // Verifica se redirecionou
        $response->assertRedirect(route('remedios.home'));

        // Calcula o valor esperado
        $qtdEsperada = $dados['quantidadeCaixa'] * $dados['caixas'];

        // Verifica se existe no banco
        $this->assertDatabaseHas('remedios', [
            'nome' => 'Paracetamol',
            'frequencia' => 2,
            'quantidadeCaixa' => 20,
            'quantidadeTomada' => 1,
            'miligramas' => 500,
            'caixas' => 3,
            'dose' => 1,
            'qtdRestante' => $qtdEsperada,
        ]);
    }

    public function test_edit()
    {
        $remedio = $this->modelo_para_test();
        $remedio->nome = 'Ibuprofeno';

        // Envia requisição POST
        $response = $this->post(route('remedios.edit'), $remedio->toArray());
        // Verifica se redirecionou
        $response->assertRedirect(route('remedios.home'));
        // Verifica se existe no banco
        $this->assertDatabaseHas('remedios', [
            'id' => $remedio->id,
            'nome' => 'Ibuprofeno',
        ]);

    }

    public function test_delete()
    {
        // Cria o registro a ser deletado
        $remedio = $this->modelo_para_test();

        // Confirma que existe antes de deletar
        $this->assertDatabaseHas('remedios', [
            'id' => $remedio->id,
        ]);

        // Chama a rota de destruição (rotas do projeto usam GET para destroy)
        $response = $this->get(route('remedios.destroy', $remedio->id));

        // Deve redirecionar para a lista
        $response->assertRedirect(route('remedios.home'));

        // Agora o registro não deve mais existir
        $this->assertDatabaseMissing('remedios', [
            'id' => $remedio->id,
        ]);
    }

    public function test_update_day()
    {
        // Cria um remédio com last_decremented_at retroativo (3 dias atrás)
        // cria o registro sem last_decremented_at (não é fillable)
        $remedio = Remedio::create([
            'nome' => 'TesteDias',
            'frequencia' => 2,
            'quantidadeCaixa' => 10,
            'quantidadeTomada' => 1,
            'miligramas' => 50,
            'caixas' => 2,
            'dose' => 1,
            // qtdRestante inicial: quantidadeCaixa * caixas
            'qtdRestante' => 10 * 2,
        ]);

        // Ajusta last_decremented_at manualmente e salva (campo não é fillable)
        $remedio->last_decremented_at = Carbon::now()->startOfDay()->subDays(3);
        $remedio->save();

        // Calcula quanto deve ser removido: dias * (quantidadeTomada * dose)
        $days = 3;
        $dailyAmount = $remedio->quantidadeTomada*$remedio->frequencia;
        $totalToRemove = $days * $dailyAmount;

        // Chama a rota que executa a atualização automática (index)
        $response = $this->get(route('remedios.home'));

        $response->assertStatus(200);

        $expected = max(0, ($remedio->qtdRestante - $totalToRemove));

        // Verifica se a quantidade restante foi atualizada
        $this->assertDatabaseHas('remedios', [
            'id' => $remedio->id,
            'qtdRestante' => $expected,
        ]);
    }

    public function test_take_dose()
    {
        // Cria remédio com qtdRestante conhecida
        $remedio = $this->modelo_para_test();
        // garante qtdRestante inicial baseado em quantidadeCaixa * caixas
        $initial = $remedio->quantidadeCaixa * $remedio->caixas;
        $this->assertDatabaseHas('remedios', ['id' => $remedio->id, 'qtdRestante' => $initial]);

        // Toma 1 dose (default)
        $response = $this->post(route('remedios.take', $remedio->id));
        $response->assertRedirect(route('remedios.home'));

        $decrement = 1 * $remedio->dose;
        $expected = max(0, $initial - $decrement);

        $this->assertDatabaseHas('remedios', [
            'id' => $remedio->id,
            'qtdRestante' => $expected,
        ]);
    }

    private function modelo_para_test()
    {
        return Remedio::create([
            'nome' => 'Paracetamol',
            'frequencia' => 2,
            'quantidadeCaixa' => 20,
            'quantidadeTomada' => 1,
            'miligramas' => 500,
            'caixas' => 3,
            'dose' => 1,
            // inicializa qtdRestante como quantidadeCaixa * caixas
            'qtdRestante' => 20 * 3,
        ]);
    }

}
