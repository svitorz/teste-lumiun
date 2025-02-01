
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs rounded-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3" wire:click="orderByName">
                    <button type="button">
                        Domain
                    </button>
                </th>
                <th scope="col" class="px-6 py-3" wire:click="orderByCategory">
                    <button type="button">
                        Category
                   </button>
                </th>
                <th>
                    <button type="button" wire:click="orderByDate">
                         Date
                    </button>
                </th>
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
            </tr>
            @endforeach
            </tbody>
    </table>
</div>

