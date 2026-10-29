<?php

use App\Livewire\Auth;
use App\Livewire\MovimentacaoCreate;
use App\Livewire\ProdutoCreate;
use App\Livewire\ProdutoEdit;
use App\Livewire\ProdutoIndex;
use Illuminate\Support\Facades\Route;

    Route::get('/produtos',ProdutoIndex::class)->name('produtos.index');

    Route::get('/produtos/{id}/editar', ProdutoEdit::class)->name('produtos.edit');

    Route::get('/produtos/create',ProdutoCreate::class)->name('produtos.create');

    Route::get('/login',Auth::class)->name('login');

    Route::get('/movimentacao', MovimentacaoCreate::class)->name('movimentacao.create');
