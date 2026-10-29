<?php

namespace App\Livewire;

use App\Models\Produtos;
use Livewire\Component;

class ProdutoCreate extends Component
{
    public $nome;
    public $descricao;
    public $marca;
    public $categoria;
    public $preco_custo;
    public $preco_venda;
    public $qtd_disponivel;
    public $estoque_minimo;
    public $validade;

    public function store()
    {

        Produtos::create([
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'marca' => $this->marca,
            'categoria' => $this->categoria,
            'preco_custo' => $this->preco_custo,
            'preco_venda' => $this->preco_venda,
            'qtd_disponivel' => $this->qtd_disponivel,
            'estoque_minimo' => $this->estoque_minimo,
            'validade' => $this->validade,
        ]);

        session()->flash(
            'success',
            'Produto cadastrado com sucesso!'
        );
        return redirect()->route('produtos.index');
    }

    public function render()
    {
        return view('livewire.produto-create');
    }
}
