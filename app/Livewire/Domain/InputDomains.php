<?php

namespace App\Livewire\Domain;

use App\Jobs\ProccessDomainCategory;
use App\Models\Domain;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class InputDomains extends Component
{
    use WithFileUploads;

    #[Validate('required|file|mimes:txt', message: "Follow the accepted files.")]
    public $domains;

    public $lines;
    public function save()
    {
        $user_id = Auth::id();
        $domain = new Domain();

        $this->lines = [];

        $handle = fopen($this->domains->getRealPath(), "r");

        while (($linha = fgets($handle)) !== false) {
            $linha = trim($linha);
            if (!empty($linha)) {
                if($domain->validateDomains($linha)){
                    $this->lines[] = $linha;

                    ProccessDomainCategory::dispatch($linha,$user_id);
                }
            }

            if(empty($this->lines)){
                $this->dispatch('showToast', "No validated domains were found.", 'danger');
            }

            $this->dispatch('showToast', "" . count($this->lines) . " validated domains were found.", 'success');

        }

        fclose($handle);
    }


    public function render()
    {
        return view('livewire.domain.input-domains');
    }
}
