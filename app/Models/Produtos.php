<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;
    protected$fillable = [
        'nome',
        'descricao',
        'marca',
        'categoria',
        'preco_custo',
        'preco_venda',
        'qtd_disponivel',
        'estoque_minimo',
        'validade'
    ];
}

