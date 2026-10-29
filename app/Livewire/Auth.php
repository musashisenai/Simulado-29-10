<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth as AuthFacade;
use Livewire\Component;

class Auth extends Component
{
    public $email;
    public $password;

public function entrar()
{
    $this->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credenciais = [
        'email' => $this->email,
        'password' => $this->password,
    ];

    if (AuthFacade::attempt($credenciais)) {
        session()->regenerate();

        return redirect()->route('produtos.index');
    }

    session()->flash('error', 'E-mail ou senha inválidos.');
}

    public function sair()
{
    Auth::logout();

    session()->invalidate();
    session()->regenerateToken();

    return redirect()->route('login');
}
    public function render()
    {
        return view('livewire.auth');
    }
}
