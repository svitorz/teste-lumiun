<?php

namespace App\Livewire;

use Livewire\Component;

class ToastManager extends Component
{
    public $message;
    public $type = 'info';
    public $show = false;

    protected $listeners = ['showToast'];

    public function showToast($message, $type)
    {
        $this->message = $message;
        $this->type = $type;
        $this->show = true;

        $this->dispatch('hide-toast');
    }

    public function render()
    {
        return view('livewire.toast-manager');
    }
}
