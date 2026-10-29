<?php

namespace App\Livewire;

use App\Models\Produtos;
use Livewire\Component;

class ProdutoEdit extends Component
{
    public $produtoId;

    public $nome = '';
    public $descricao = '';
    public $marca = '';
    public $categoria = '';
    public $preco_custo = '';
    public $preco_venda = '';
    public $qtd_disponivel = '';
    public $estoque_minimo = '';
    public $validade = '';

    public function mount($id)
    {
        $produto = Produtos::findOrFail($id);

        $this->produtoId = $produto->id;
        $this->nome = $produto->nome;
        $this->descricao = $produto->descricao;
        $this->marca = $produto->marca;
        $this->categoria = $produto->categoria;
        $this->preco_custo = $produto->preco_custo;
        $this->preco_venda = $produto->preco_venda;
        $this->qtd_disponivel = $produto->qtd_disponivel;
        $this->estoque_minimo = $produto->estoque_minimo;
        $this->validade = $produto->validade;
    }

    protected function rules()
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'marca' => ['nullable', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:255'],
            'preco_custo' => ['nullable', 'numeric', 'min:0'],
            'preco_venda' => ['required', 'numeric', 'min:0'],
            'qtd_disponivel' => ['required', 'integer', 'min:0'],
            'estoque_minimo' => ['required', 'integer', 'min:0'],
            'validade' => ['nullable', 'date'],
        ];
    }

    public function update()
    {
        $dados = $this->validate();

        $produto = Produtos::findOrFail($this->produtoId);

        $produto->nome = $dados['nome'];
        $produto->descricao = $dados['descricao'] ?? null;
        $produto->marca = $dados['marca'] ?? null;
        $produto->categoria = $dados['categoria'];
        $produto->preco_custo = $dados['preco_custo'] ?? null;
        $produto->preco_venda = $dados['preco_venda'];
        $produto->qtd_disponivel = $dados['qtd_disponivel'];
        $produto->estoque_minimo = $dados['estoque_minimo'];
        $produto->validade = $dados['validade'] ?? null;

        $produto->save();

        session()->flash('success', 'Produto atualizado com sucesso.');

        return redirect()->route('produtos.index');
    }

    public function render()
    {
        return view('livewire.produto-edit');
    }
}
