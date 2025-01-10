<?php

namespace App\Livewire\Table;

use Livewire\Component;
use Yajra\DataTables\DataTables;
use App\Models\User;

class UserDatatables extends Component
{
    public function render()
    {
        return view('livewire.table.user-datatables',[
              'page_title'=>'List Users | Ecommerce'
        ])->layout('layouts.app');
    }

 
}
