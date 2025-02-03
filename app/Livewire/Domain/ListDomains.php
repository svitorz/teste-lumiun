<?php

namespace App\Livewire\Domain;

use App\Models\Category;
use App\Models\Domain;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use PhpParser\Node\Stmt\TryCatch;

class ListDomains extends Component
{
    use WithPagination;

    public $selectedCategory = null;

    public $authUser;

    public function __construct(){
        $this->authUser = Auth::id();
    }

    public function destroy(Domain $domain)
    {
        try{

            if($domain->user_id != $this->authUser)
            {
                abort(403);
            }

            $domain->delete();
        }catch(Exception $e){
            Log::error('Error deleting' . $e->getMessage());
        }
    }



    public function render()
    {
        $categories = Category::get();

        $domains = $this->selectedCategory
            ? Domain::where('user_id','=',$this->authUser)->where('category_id', $this->selectedCategory)->paginate(10)
            : Domain::where('user_id','=',$this->authUser)->paginate(10);

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
