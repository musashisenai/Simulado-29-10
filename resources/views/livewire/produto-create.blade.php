<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9 col-xl-8">

            <div class="mb-4">
                <h2 class="fw-bold mb-1">
                    <i class="bi bi-box-seam text-primary me-2"></i>
                    Cadastrar produto
                </h2>
                <p class="text-secondary mb-0">
                    Preencha os dados para adicionar um produto ao estoque.
                </p>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <form wire:submit="store">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label fw-semibold">Nome</label>
                                <input
                                    id="nome"
                                    type="text"
                                    class="form-control @error('nome') is-invalid @enderror"
                                    placeholder="Ex.: Ração para cães"
                                    wire:model="nome"
                                    required
                                >
                                @error('nome')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="descricao" class="form-label fw-semibold">Descrição</label>
                                <input
                                    id="descricao"
                                    type="text"
                                    class="form-control @error('descricao') is-invalid @enderror"
                                    placeholder="Descrição do produto"
                                    wire:model="descricao"
                                >
                                @error('descricao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="marca" class="form-label fw-semibold">Marca</label>
                                <input
                                    id="marca"
                                    type="text"
                                    class="form-control @error('marca') is-invalid @enderror"
                                    placeholder="Marca do produto"
                                    wire:model="marca"
                                >
                                @error('marca')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="categoria" class="form-label fw-semibold">Categoria</label>
                                <input
                                    id="categoria"
                                    type="text"
                                    class="form-control @error('categoria') is-invalid @enderror"
                                    placeholder="Ex.: Alimentação"
                                    wire:model="categoria"
                                    required
                                >
                                @error('categoria')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="preco_custo" class="form-label fw-semibold">Preço de custo</label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input
                                        id="preco_custo"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        class="form-control @error('preco_custo') is-invalid @enderror"
                                        placeholder="0,00"
                                        wire:model="preco_custo"
                                    >
                                    @error('preco_custo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="preco_venda" class="form-label fw-semibold">Preço de venda</label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input
                                        id="preco_venda"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        class="form-control @error('preco_venda') is-invalid @enderror"
                                        placeholder="0,00"
                                        wire:model="preco_venda"
                                        required
                                    >
                                    @error('preco_venda')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="qtd_disponivel" class="form-label fw-semibold">
                                    Quantidade disponível
                                </label>
                                <input
                                    id="qtd_disponivel"
                                    type="number"
                                    min="0"
                                    step="1"
                                    class="form-control @error('qtd_disponivel') is-invalid @enderror"
                                    placeholder="0"
                                    wire:model="qtd_disponivel"
                                    required
                                >
                                @error('qtd_disponivel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="estoque_minimo" class="form-label fw-semibold">
                                    Estoque mínimo
                                </label>
                                <input
                                    id="estoque_minimo"
                                    type="number"
                                    min="0"
                                    step="1"
                                    class="form-control @error('estoque_minimo') is-invalid @enderror"
                                    placeholder="0"
                                    wire:model="estoque_minimo"
                                    required
                                >
                                @error('estoque_minimo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="validade" class="form-label fw-semibold">Validade</label>
                                <input
                                    id="validade"
                                    type="date"
                                    class="form-control @error('validade') is-invalid @enderror"
                                    wire:model="validade"
                                >
                                @error('validade')
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
                                    Cadastrar produto
                                </span>
                                <span wire:loading wire:target="store">
                                    Salvando...
                                </span>
                            </button>

                            <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>
                                Voltar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
