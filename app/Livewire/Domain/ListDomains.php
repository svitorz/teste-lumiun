<?php

namespace App\Livewire\Domain;

use App\Models\Domain;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
class ListDomains extends Component
{

    public $domains;

    public $orderBy = 'created_at';
    public $method = 'asc';

    public function mount(): void
    {
        $authUser = Auth::id();
        $this->domains = Domain::where('user_id',$authUser)->with('category')->get();
    }
    public function render()
    {
        return view('livewire.domain.list-domains');
    }
}
