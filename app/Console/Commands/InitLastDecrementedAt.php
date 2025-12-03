<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Remedio;
use Carbon\Carbon;

class InitLastDecrementedAt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remedios:init-last-decremented';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inicializa last_decremented_at para registros existentes (define como agora quando nulo).';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $count = Remedio::whereNull('last_decremented_at')->count();

        if ($count === 0) {
            $this->info('Nenhum registro precisa ser inicializado.');
            return 0;
        }

        Remedio::whereNull('last_decremented_at')->update(['last_decremented_at' => $now]);

        $this->info("Inicializados {$count} registros com last_decremented_at = {$now}.");
        return 0;
    }
}
