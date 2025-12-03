<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remedio extends Model
{
    public $fillable = [
        'id',
        'nome',
        'frequencia',
        'quantidadeCaixa',
        'quantidadeTomada',
        'qtdRestante',
        'miligramas',
        'caixas',
        'dose',
        'intervaloHoras'
    ];

    protected $casts = [
        'last_decremented_at' => 'datetime',
    ];
    
}
