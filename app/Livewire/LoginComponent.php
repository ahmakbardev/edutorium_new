<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LoginComponent extends Component
{
    public $emailOrName;
    public $password;

    protected $rules = [
        'emailOrName' => 'required',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        // Cek apakah input adalah email atau nama
        $credentials = filter_var($this->emailOrName, FILTER_VALIDATE_EMAIL) ? ['email' => $this->emailOrName] : ['name' => $this->emailOrName];

        if (Auth::attempt(array_merge($credentials, ['password' => $this->password]))) {
            session()->flash('success', 'Login berhasil! Anda akan diarahkan ke dashboard.');
            session()->put('just_logged_in', true);  // Set session for just logged in
            $this->dispatch('login-success', ['message' => session('success')]);
            Log::info('Login success message:', ['message' => session('success')]);
        } else {
            session()->flash('error', 'Email, nama, atau password salah.');
            $this->dispatch('login-error', ['message' => session('error')]);
            Log::info('Login error message:', ['message' => session('error')]);
        }
    }

    public function render()
    {
        return view('livewire.login-component');
    }
}
