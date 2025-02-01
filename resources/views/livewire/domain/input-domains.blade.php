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
    <p class="text-red-600 small text-center text-md">Accepted files: .txt</p>

    @isset($lines)
       @foreach ($lines as $line)
           {{ $line }}
       @endforeach
    @endisset
</div>
