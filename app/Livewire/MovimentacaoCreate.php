<?php

namespace App\Livewire;

use App\Models\Movimentacoes;
use App\Models\Produtos;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class MovimentacaoCreate extends Component
{
    public $produto_id = '';
    public $tipo = 'entrada';
    public $quantidade = '';
    public $data = '';
    public $funcionario = '';

    public function mount()
    {
        $this->data = now()->toDateString();
    }

    protected function rules()
    {
        return [
            'produto_id' => ['required', 'exists:produtos,id'],
            'tipo' => ['required', 'in:entrada,saida'],
            'quantidade' => ['required', 'integer', 'min:1'],
            'data' => ['required', 'date'],
            'funcionario' => ['required', 'string', 'max:255'],
        ];
    }

    public function store()
    {
        $dados = $this->validate();

        DB::transaction(function () use ($dados) {
            $produto = Produtos::whereKey($dados['produto_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if (
                $dados['tipo'] === 'saida'
                && $produto->qtd_disponivel < $dados['quantidade']
            ) {
                throw ValidationException::withMessages([
                    'quantidade' => 'A quantidade de saída é maior do que o estoque disponível.',
                ]);
            }

            if ($dados['tipo'] === 'entrada') {
                $produto->qtd_disponivel += $dados['quantidade'];
            } else {
                $produto->qtd_disponivel -= $dados['quantidade'];
            }

            $produto->save();

            Movimentacoes::create([
                'produto_id' => $produto->id,
                'entrada' => $dados['tipo'] === 'entrada',
                'saida' => $dados['tipo'] === 'saida',
                'quantidade' => $dados['quantidade'],
                'data' => $dados['data'],
                'funcionario' => $dados['funcionario'],
            ]);
        });

        session()->flash('success', 'Movimentação registrada com sucesso.');

        $this->reset(['produto_id', 'quantidade', 'funcionario']);
        $this->tipo = 'entrada';
        $this->data = now()->toDateString();
        $this->resetValidation();
    }

    public function render()
    {
        $produtos = Produtos::orderBy('nome')->get();

        $movimentacoes = Movimentacoes::with('produto')
            ->orderByDesc('data')
            ->orderByDesc('id')
            ->get();

        return view('livewire.movimentacao-create', compact(
            'produtos',
            'movimentacoes'
        ));
    }
}
