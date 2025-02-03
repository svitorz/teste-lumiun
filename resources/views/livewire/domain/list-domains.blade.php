<div class="relative overflow-x-auto" x-init="setInterval(() => {
            $wire.$refresh()
        }, 5000)">
    <!-- atualiza o componente a cada 5 segundos. -->

    <div class="max-w-sm mx-auto py-6">
        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category:</label>
        <select wire:model="selectedCategory" wire:change="filterByCategory($event.target.value)"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="" class="dark:text-white">All categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->value}}</option>
            @endforeach
        </select>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs rounded-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                   Domain
                </th>
                <th scope="col" class="px-6 py-3">
                   Category
                </th>
                <th>
                    Date
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($domains as $domain)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $domain->name}}
                    </th>
                    <td class="px-6 py-4">
                        {{ $domain->category->value}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $domain->created_at->format('h:m - d.m.Y')}}
                    </td>
                    <td>
                        <button type="button" wire:click="destroy({{ $domain->id }})" wire:confirm="Are you sure you want to delete this domain?" >
                            <x-bi-trash class="text-red-600" />
                        </button>
                    </td>
            </tr>
            @endforeach
            </tbody>
    </table>
    <div class="flex justify-center items-center">
        {{ $domains->links() }}
    </div>
</div>

