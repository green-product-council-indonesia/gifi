@section('title', 'Import Kategori Brand')
<div>
    <div class="flex flex-col justify-between sm:flex-row">
        <p class="mb-2 text-3xl font-bold leading-7 text-gray-900 ">
            Import Kategori Brand
        </p>
        <button wire:click="$emit('openModal', 'import.modal.tambah-brand')"
            class="px-3 py-2 mt-4 mb-2 text-xs text-white bg-blue-600 rounded-md shadow-md sm:mt-0 hover:bg-blue-700">
            Tambah Brand Baru
        </button>
    </div>
    <hr>

    <div class="flex flex-col justify-between mx-4 mt-6 sm:flex-row">
        <div class="flex flex-col">
            <span class="mb-2 text-xs font-semibold sm:text-sm">
                Cari Kategori Brand :
            </span>
            <input type="text" wire:model="search" placeholder="Cari Kategori Brand ..."
                class="inset-y-0 right-0 block w-full text-xs border-gray-300 rounded-md shadow-sm focus:ring-green-400 focus:border-green-400 sm:text-sm">
        </div>
        <div class="flex flex-col">
            <span class="mt-4 mb-2 text-xs font-semibold sm:mt-0 sm:text-sm md:text-right">
                Items Per Page :
            </span>
            <select wire:model="paginate"
                class="w-full px-5 text-xs bg-white border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-green-400 focus:border-green-400 sm:text-sm">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
            </select>
        </div>
    </div>


    <div class="mt-4 overflow-hidden overflow-x-auto border border-gray-200 rounded-md shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-green-200">
                <tr>
                    <th scope="col"
                        class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        <div class="flex justify-between">
                            <span>
                                Kategori Brand
                            </span>
                        </div>

                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm bg-white divide-y divide-gray-200">
                @forelse ($categories as $category)
                    <tr wire:loading.remove wire:target="previousPage, nextPage, gotoPage">
                        <td class="px-6 py-4 font-semibold">
                            {{ $category->categories }}
                        </td>
                        <td
                            class="flex flex-col justify-center px-2 py-4 space-y-2 text-sm font-semibold sm:space-y-0 sm:space-x-2 sm:flex-row sm:whitespace-nowrap">
                            <button
                                wire:click="$emit('openModal', 'import.modal.edit-brand', {{ json_encode(['category' => $category->id]) }})"
                                class="px-3 py-1 text-white bg-green-600 rounded-md hover:bg-green-700">
                                Edit
                            </button>
                            <button
                                wire:click="$emit('openModal', 'import.modal.delete-brand', {{ json_encode(['category' => $category->id]) }})"
                                class="px-3 py-1 text-white bg-red-600 rounded-md hover:bg-red-700">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">
                            <div class="flex items-center justify-center gap-4 py-20 font-semibold text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-yellow-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-2xl">
                                    Tidak Ada Data
                                </span>
                            </div>
                        </td>
                    </tr>
                @endforelse
                <tr wire:loading.class="table-row" wire:loading.remove.class="hidden"
                    wire:target="previousPage, nextPage, gotoPage" class="hidden">
                    <td colspan="5" class="text-center bg-gray-50 p-36">
                        <div class="flex justify-center">
                            {{-- Loading --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-green-500 animate-spin"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
