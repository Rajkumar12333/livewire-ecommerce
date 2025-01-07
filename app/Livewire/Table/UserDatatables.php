<?php

namespace App\Livewire\Table;

use Livewire\Component;
use Yajra\DataTables\DataTables;
use App\Models\User;

class UserDatatables extends Component
{
    public function render()
    {
        return view('livewire.table.user-datatables')->layout('layouts.app');
    }

 
}
