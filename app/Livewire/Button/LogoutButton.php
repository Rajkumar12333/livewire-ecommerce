<?php

namespace App\Livewire\Button;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class LogoutButton extends Component
{
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login'); // Redirect to the login page
    }

    public function render()
    {
        return view('livewire.button.logout-button');
    }
}
