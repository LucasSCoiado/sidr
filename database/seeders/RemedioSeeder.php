<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RemedioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // criar 5 remedios de exemplo
        for ($i = 0; $i < 5; $i++) {
            $quantidadeTomada = $i + 1; // por ex. 1,2,3...
            $miligramas = 100; // exemplo fixo; pode vir de um faker ou variação

            DB::table('remedios')->insert([
                'nome' => "Remedio $i",
                'frequencia' => $i,
                'quantidadeCaixa' => 30,
                'quantidadeTomada' => $quantidadeTomada,
                'miligramas' => $miligramas,
                'caixas' => $i,
                // dose = quantidadeTomada * miligramas
                'dose' => $quantidadeTomada * $miligramas,
            ]);
        }
    }
}
