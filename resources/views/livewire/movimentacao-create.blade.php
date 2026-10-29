<div class="container py-4">
    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            <i class="bi bi-arrow-left-right text-primary me-2"></i>
            Movimentações de estoque
        </h2>
        <p class="text-secondary mb-0">
            Registre entradas e saídas e consulte o histórico nesta mesma tela.
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Fechar"
            ></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-0 px-4 pt-4">
            <h3 class="h5 fw-bold mb-0">Registrar movimentação</h3>
        </div>

        <div class="card-body p-4">
            <form wire:submit="store">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="produto_id" class="form-label fw-semibold">
                            Produto
                        </label>

                        <select
                            id="produto_id"
                            class="form-select @error('produto_id') is-invalid @enderror"
                            wire:model="produto_id"
                            required
                        >
                            <option value="">Selecione um produto</option>

                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}">
                                    {{ $produto->nome }}
                                    — estoque: {{ $produto->qtd_disponivel }}
                                </option>
                            @endforeach
                        </select>

                        @error('produto_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="tipo" class="form-label fw-semibold">
                            Tipo de movimentação
                        </label>

                        <select
                            id="tipo"
                            class="form-select @error('tipo') is-invalid @enderror"
                            wire:model="tipo"
                            required
                        >
                            <option value="entrada">Entrada</option>
                            <option value="saida">Saída</option>
                        </select>

                        @error('tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="quantidade" class="form-label fw-semibold">
                            Quantidade
                        </label>

                        <input
                            id="quantidade"
                            type="number"
                            min="1"
                            step="1"
                            class="form-control @error('quantidade') is-invalid @enderror"
                            placeholder="Ex.: 5"
                            wire:model="quantidade"
                            required
                        >

                        @error('quantidade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="data" class="form-label fw-semibold">
                            Data
                        </label>

                        <input
                            id="data"
                            type="date"
                            class="form-control @error('data') is-invalid @enderror"
                            wire:model="data"
                            required
                        >

                        @error('data')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="funcionario" class="form-label fw-semibold">
                            Funcionário
                        </label>

                        <input
                            id="funcionario"
                            type="text"
                            class="form-control @error('funcionario') is-invalid @enderror"
                            placeholder="Nome do funcionário"
                            wire:model="funcionario"
                            required
                        >

                        @error('funcionario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                    <button
                        type="submit"
                        class="btn btn-primary"
                        wire:loading.attr="disabled"
                        wire:target="store"
                    >
                        <span wire:loading.remove wire:target="store">
                            <i class="bi bi-check-circle me-1"></i>
                            Registrar movimentação
                        </span>

                        <span wire:loading wire:target="store">
                            Salvando...
                        </span>
                    </button>

                    <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-box-seam me-1"></i>
                        Voltar aos produtos
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 px-4 pt-4">
            <h3 class="h5 fw-bold mb-0">Histórico de movimentações</h3>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Data</th>
                            <th>Produto</th>
                            <th>Tipo</th>
                            <th>Quantidade</th>
                            <th>Funcionário</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($movimentacoes as $movimentacao)
                            <tr wire:key="movimentacao-{{ $movimentacao->id }}">
                                <td>
                                    {{ $movimentacao->data
                                        ? $movimentacao->data->format('d/m/Y')
                                        : '—' }}
                                </td>

                                <td>
                                    {{ $movimentacao->produto?->nome ?? 'Produto não encontrado' }}
                                </td>

                                <td>
                                    @if ($movimentacao->entrada)
                                        <span class="badge text-bg-success">Entrada</span>
                                    @elseif ($movimentacao->saida)
                                        <span class="badge text-bg-danger">Saída</span>
                                    @else
                                        <span class="badge text-bg-secondary">Não informado</span>
                                    @endif
                                </td>

                                <td>{{ $movimentacao->quantidade }}</td>
                                <td>{{ $movimentacao->funcionario }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-secondary py-4">
                                    Nenhuma movimentação registrada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
