<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movimentacoes extends Model
{
    use HasFactory;

    protected $table = 'movimentacoes';

    protected $fillable = [
        'produto_id',
        'entrada',
        'saida',
        'quantidade',
        'data',
        'funcionario',
    ];

    protected $casts = [
        'entrada' => 'boolean',
        'saida' => 'boolean',
        'data' => 'date',
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produtos::class, 'produto_id');
    }
}
