<?php

namespace App\Livewire\Domain;

use App\Models\Category;
use App\Models\Domain;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListDomains extends Component
{
    use WithPagination;

    public $selectedCategory = null;

    public function render()
    {
        $authId = Auth::id();
        $categories = Category::get();

        $domains = $this->selectedCategory
            ? Domain::where('user_id',$authId)->where('category_id', $this->selectedCategory)->paginate(10)
            : Domain::where('user_id',$authId)->paginate(10);

        return view('livewire.domain.list-domains', [
            'categories' => $categories,
            'domains' => $domains,
        ]);
    }

    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage();
    }
}
