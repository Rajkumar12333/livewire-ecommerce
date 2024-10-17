<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Contact;
class ContactForm extends Component
{
    public $name,$email,$message,$ip,$agent;

    public function render()
    {
        return view('livewire.frontend.contact-form');
    }
    public function store(){
        $product = new Contact();
        $product->name = $this->name;
        $product->email = $this->email;
        $product->message = $this->message;
        $product->ip = request()->ip();
        $product->agent =request()->userAgent();
        $product->save();
        $this->dispatch('swal', [
            'title' => 'Item has been removed.',
            'icon' => 'success',
            'iconColor' => 'blue',
        ]);
        $this->dispatch('redirect', route('contact'));
    }
}
