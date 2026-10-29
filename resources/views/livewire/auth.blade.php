<div class="min-vh-100 d-flex align-items-center bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">

                <div class="card border-0 shadow rounded-4">
                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">
                            <div class="text-primary mb-2">
                                <i class="bi bi-house-heart-fill fs-1"></i>
                            </div>

                            <h1 class="h3 fw-bold mb-1">Pet Shop</h1>
                            <p class="text-secondary mb-0">Entre para continuar</p>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger rounded-3" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form wire:submit="entrar">
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    E-mail
                                </label>

                                <input
                                    id="email"
                                    type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    wire:model="email"
                                    placeholder="seuemail@exemplo.com"
                                    autocomplete="email"
                                    required
                                >

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">
                                    Senha
                                </label>

                                <input
                                    id="password"
                                    type="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    wire:model="password"
                                    placeholder="Digite sua senha"
                                    autocomplete="current-password"
                                    required
                                >

                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button
                                class="btn btn-primary btn-lg w-100 rounded-3"
                                type="submit"
                                wire:loading.attr="disabled"
                                wire:target="entrar"
                            >
                                <span wire:loading.remove wire:target="entrar">
                                    <i class="bi bi-box-arrow-in-right me-1"></i>
                                    Entrar
                                </span>

                                <span wire:loading wire:target="entrar">
                                    Aguarde...
                                </span>
                            </button>
                        </form>

                        <p class="text-center text-secondary small mt-4 mb-0">
                            Acesso seguro ao sistema
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
