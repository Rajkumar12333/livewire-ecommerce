<?php

namespace App\Livewire;

use Livewire\Component;

class UserDashboard extends Component
{
    public function render()
    {
        return view('livewire.user-dashboard',[
            'page_title'=>"User Dashboard | Ecommerce"
        ])->layout('layouts.user-dashboard');
    }
}
