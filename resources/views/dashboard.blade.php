<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl gap-y-5 flex flex-col mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div x-data="{ open: false }">
                    <button type="button" class="p-3 dark:text-white dark:bg-slate-950 rounded m-4 bg-slate-100 text-slate-950 hover:dark:bg-slate-200 hover:dark:bg-slate-900"  x-on:click="open = !open">How to use?</button>
                    <div class="fixed inset-0 bg-black bg-opacity-50"  x-show="open" x-transition >
                        <div class="dark:bg-slate-950 bg-slate-100 dark:text-white p-8 rounded-lg shadow-lg">
                            <h2 class="text-xl font-bold mb-4">File format</h2>
                            <p>Please write the name of all the domains you wish to categorize in a .txt file, containing only one address per line. After that, submit the file in the form below.</p>
                            <button class="mt-4 px-4 py-2 bg-blue-900 text-white rounded" x-on:click="open = false">Close</button>
                        </div>
                    </div>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 w-full">
                    @livewire('domain.input-domains')
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 w-full">
                    @livewire('domain.list-domains')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
