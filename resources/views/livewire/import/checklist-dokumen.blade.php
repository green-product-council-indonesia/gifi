@section('title', 'Checklist Dokumen Sertifikasi')
<div>
    <p class="mb-2 text-3xl font-bold leading-7 text-gray-900 ">
        Checklist Dokumen Sertifikasi
    </p>
    <hr>

    <div class="flex flex-col items-center justify-between mt-4 sm:flex-row">
        <div class="flex flex-col">
            <label class="mb-2 text-sm font-semibold">Select Kategori Brand</label>
            <select wire:model="category_name"
                class="w-full px-5 text-xs bg-white border border-gray-300 rounded-md shadow-sm appearance-none sm:w-4/5 focus:outline-none focus:ring-green-400 focus:border-green-400">
                <option value="">Select Kategori Brand</option>
                {{-- @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->categories }}</option>
                @endforeach --}}
            </select>
        </div>
        <div class="flex flex-col mt-4 sm:mt-0">
            <button wire:click="$emit('openModal', 'import.modal.tambah-checklist')"
                class="flex items-center gap-2 px-3 py-2 text-xs text-white bg-green-600 rounded-md shadow hover:bg-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Tambah Dokumen Checklist
            </button>
        </div>
    </div>

    <div class="mt-4 overflow-hidden overflow-x-auto border border-gray-200 rounded-md shadow-md">
        <table class="min-w-full divide-y divide-gray-200 md:table-fixed">
            <thead class="bg-green-200">
                <tr>
                    <th scope="col"
                        class="w-3/5 px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        Nama Dokumen Checklist
                    </th>
                    <th scope="col"
                        class="w-1/5 px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        Kategori Brand
                    </th>
                    <th scope="col" class="relative w-1/5 px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            {{-- <tbody class="text-sm bg-white divide-y divide-gray-200">
                @if (!is_null($category_name))
                    @if (!empty($docs))
            @forelse ($docs as $doc)
                <tr wire:loading.remove wire:target="previousPage, nextPage, gotoPage">
                    <td class="px-6 py-4 font-semibold">
                        {{ $doc->nama_dokumen }}
                    </td>
                    <td class="px-6 py-4 font-semibold">
                        {{ $doc->kategoriBrand->categories }}
                    </td>
                    <td
                        class="flex justify-center py-4 mx-4 space-x-2 text-sm font-semibold whitespace-normal sm:whitespace-normal">
                        @if ($doc->kategoriBrand->id !== 1)
                            <button
                                wire:click="$emit('openModal', 'import.modal.edit-checklist', {{ json_encode(['id' => $doc->id]) }})"
                                class="px-3 py-1 text-white bg-green-600 rounded-md hover:bg-green-700">
                                Edit
                            </button>
                            <button
                                wire:click="$emit('openModal', 'import.modal.delete-checklist', {{ json_encode(['id' => $doc->id]) }})"
                                class="px-3 py-1 text-white bg-red-600 rounded-md hover:bg-red-700">
                                Delete
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="flex items-center justify-center gap-4 py-20 font-semibold text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-yellow-500"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-2xl">
                                Data Belum Ada
                            </span>
                        </div>
                    </td>
                </tr>
            @endforelse
        @else
            <tr>
                <td colspan="3">
                    <div class="flex items-center justify-center gap-4 py-20 font-semibold text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-blue-600" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                        </svg>
                        <span class="text-2xl">
                            Choose Data First
                        </span>
                    </div>
                </td>
            </tr>
            @endif
            <tr wire:loading.class="table-row" wire:loading.remove.class="hidden"
                wire:target="previousPage, nextPage, gotoPage" class="hidden">
                <td colspan="5" class="text-center bg-gray-50 p-36">
                    <div class="flex justify-center">
                        Loading
            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-green-500 animate-spin" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
    </div>
    </td>
    </tr>
    </tbody> --}}
        </table>
    </div>
</div>
