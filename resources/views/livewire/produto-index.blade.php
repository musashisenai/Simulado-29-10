<div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Produtos</h2>
            <p class="text-secondary mb-0">Gerencie seus produtos e acompanhe o estoque.</p>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ url('produtos/create') }}" class="btn btn-primary">
                <i class="bi bi-patch-plus me-1"></i>
                Cadastrar produto
            </a>

            <a href="{{ url('movimentacao') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-right me-1"></i>
                Movimentações
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Marca</th>
                            <th>Categoria</th>
                            <th>Preço de custo</th>
                            <th>Preço de venda</th>
                            <th>Qtd. disponível</th>
                            <th>Status do estoque</th>
                            <th>Estoque mínimo</th>
                            <th>Validade</th>
                            <th>Status da validade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($produtos as $p)
                            <tr wire:key="produto-{{ $p->id }}">
                                <td>{{ $p->id }}</td>
                                <td class="fw-semibold">{{ $p->nome }}</td>
                                <td>{{ $p->descricao ?: '—' }}</td>
                                <td>{{ $p->marca ?: '—' }}</td>
                                <td>{{ $p->categoria }}</td>
                                <td>
                                    {{ $p->preco_custo !== null ? number_format((float) $p->preco_custo, 2, ',', '.') : '—' }}
                                </td>
                                <td>
                                    {{ $p->preco_venda !== null ? number_format((float) $p->preco_venda, 2, ',', '.') : '—' }}
                                </td>
                                <td>{{ $p->qtd_disponivel }}</td>

                                <td>
                                    @if ($p->qtd_disponivel > $p->estoque_minimo)
                                        <span class="badge text-bg-success">Acima do mínimo</span>
                                    @elseif ($p->qtd_disponivel == $p->estoque_minimo)
                                        <span class="badge text-bg-warning">No mínimo</span>
                                    @else
                                        <span class="badge text-bg-danger">Abaixo do mínimo</span>
                                    @endif
                                </td>

                                <td>{{ $p->estoque_minimo }}</td>
                                <td>
                                    {{ $p->validade ? \Illuminate\Support\Carbon::parse($p->validade)->format('d/m/Y') : '—' }}
                                </td>

                                <td>
                                    @if (!$p->validade)
                                        <span class="badge text-bg-secondary">Sem validade</span>
                                    @else
                                        @php
                                            $dataValidade = \Illuminate\Support\Carbon::parse(
                                                $p->validade,
                                            )->startOfDay();
                                            $hoje = \Illuminate\Support\Carbon::today();
                                        @endphp

                                        @if ($dataValidade->lt($hoje))
                                            <span class="badge text-bg-danger">Vencido</span>
                                        @elseif ($dataValidade->equalTo($hoje))
                                            <span class="badge text-bg-warning">Vence hoje</span>
                                        @else
                                            <span class="badge text-bg-success">Dentro da validade</span>
                                        @endif
                                    @endif
                                </td>

                                <td class="text-nowrap">
                                    <a href="{{ route('produtos.edit', $p->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil-square"></i>
                                        Editar
                                    </a>

                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        wire:click="excluir({{ $p->id }})"
                                        wire:confirm="Tem certeza de que deseja excluir este produto?">
                                        <i class="bi bi-trash"></i>
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center text-secondary py-4">
                                    Nenhum produto cadastrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
