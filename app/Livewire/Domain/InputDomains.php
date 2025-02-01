<?php

namespace App\Livewire\Domain;

use App\Models\Domain;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class InputDomains extends Component
{
    use WithFileUploads;

    //Valida o arquivo para aceitar somente um tipo de extensão.
    #[Validate('required|file|mimes:txt', message: "Follow the accepted files.")]
    public $domains;

    public $lines = [];

    public function save()
    {
        $domain = new Domain();

        $this->lines = []; // impedir que dois arquivos de envios diferentes se misturem.

        // "Abre" o arquivo (o lê), e utiliza somente linhas válidas
        $handle = fopen($this->domains->getRealPath(), "r");

        while (($linha = fgets($handle)) !== false) {
            $linha = trim($linha);
            if (!empty($linha)) {
                if($domain->validateDomains($linha)){
                    $this->lines[] = $linha;
                }
            }
        }

        fclose($handle);
    }


    public function render()
    {
        return view('livewire.domain.input-domains');
    }
}
