<div class="antialiased">
    <form wire:submit="save">
    <div class="flex gap-x-3 w-full flex-row justify-center items-center">
        <div class="">
            <x-text-input type="file"   accept=".txt" wire:model="domains" />
        </div>
        <div class="">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
        </form>
    </div>
    <p class="dark:text-white small text-center text-md">Accepted files: .txt</p>

    @isset($lines)
    <p class="dark:text-green-600 text-green-400">
        Foram encontrados os seguintes domínios validados:
       @foreach ($lines as $line)
        {{ $line . "\n"}}
       @endforeach
        @empty($lines)
            <p class="text-red-600">Nenhum domínio foi validado.</p>
        @endempty
    @endisset
    </p>

</div>
