<?php

namespace App\Livewire;

use App\Models\Produtos;
use Livewire\Component;

class ProdutoIndex extends Component
{
    public function excluir($id)
    {
        $produto = Produtos::findOrFail($id);
        $produto->delete();

        session()->flash('success', 'Produto excluído com sucesso.');
    }

    public function render()
    {
        $produtos = Produtos::all();

        return view('livewire.produto-index', compact('produtos'));
    }
}
