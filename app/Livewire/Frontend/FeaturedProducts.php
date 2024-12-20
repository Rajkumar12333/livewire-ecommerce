<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;
use App\Models\Department;

class FeaturedProducts extends Component
{
    public $filter = '*'; // Tracks the current filter

    public function setFilter($filter)
    {
        $this->filter = $filter === '*' ? '*' : (int) $filter; // Ensure valid filter values
        
    }
    public function mount(){
        $this->filter="*";
        $this->setFilter($this->filter);
    }

    public function render()
    {
        $feature_products = $this->filter === '*'
            ? Product::all()
            : Product::where('department_id', $this->filter)->get();

        $departmnet = Department::all(); // Use all() for consistency

        return view('livewire.frontend.featured-products', compact('feature_products', 'departmnet'));
    }

}
