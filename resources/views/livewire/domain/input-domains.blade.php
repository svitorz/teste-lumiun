<div class="antialiased">
    <form wire:submit="save">
    <div class="flex gap-x-3 w-full flex-row justify-center items-center">
        <div class="">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="input-domains">Upload file</label>
            <input required wire:model="domains" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="input-domains" type="file" accept="txt">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">txt (MAX. 2MB).</p>
        </div>
        <div class="">

            <x-primary-button x-bind:disable="loading" wire:loading.remove>
                Save
            </x-primary-button>
            <div class="loader" wire:loading></div>
        </div>
        </form>
    </div>
    <style>

.loader {
  width: 50px;
  padding: 8px;
  aspect-ratio: 1;
  border-radius: 50%;
  background: #25b09b;
  --_m:
    conic-gradient(#0000 10%,#000),
    linear-gradient(#000 0 0) content-box;
  -webkit-mask: var(--_m);
          mask: var(--_m);
  -webkit-mask-composite: source-out;
          mask-composite: subtract;
  animation: l3 1s infinite linear;
}
@keyframes l3 {to{transform: rotate(1turn)}}

   </style>
</div>
