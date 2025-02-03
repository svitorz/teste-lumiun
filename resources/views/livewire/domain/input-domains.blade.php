<div class="antialiased">
    <form wire:submit="save">
    <div class="flex gap-x-3 w-full flex-row justify-center items-center">
        <div class="">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="input-domains">Upload file</label>
            <input required wire:model="domains" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="input-domains" type="file" accept="txt">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">txt (MAX. 2MB).</p>
        </div>
        <div class="">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
        </form>
    </div>

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
