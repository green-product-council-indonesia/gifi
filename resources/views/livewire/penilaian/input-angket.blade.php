@section('title', 'Angket Penilaian Sertifikasi')
<div>
    <p class="mb-2 text-3xl font-bold leading-7 text-gray-900 ">
        Angket Penilaian Sertifikasi
    </p>
    <div class="p-6 mt-10 bg-white border-2 border-green-200 rounded-lg shadow-lg md:mx-10">
        <form wire:submit.prevent="angketPenilaian" x-data="{ files: null }">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 md:col-span-6">
                    <label class="font-semibold text-gray-900">Dokumen Template</label>
                    <p class="text-xs tracking-wider text-green-500">File harus berupa file excel (xls, xslx)</p>
                    <div
                        class="flex justify-center px-6 pt-5 pb-6 mt-1 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="flex items-center space-x-4 space-y-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto text-gray-400 w-14 h-14" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <div class="detail">
                                <div class="text-sm text-gray-600">
                                    <label for="angket_penilaian"
                                        class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span
                                            x-text="files ? files.map(file => file.name).join(', ') : 'Upload a file...'"></span>
                                        <input id="angket_penilaian" name="angket_penilaian" type="file"
                                            wire:model="angket_penilaian_doc" class="sr-only"
                                            x-on:change="files = Object.values($event.target.files)">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">
                                    XLSX file up to 10MB
                                </p>
                                @error('angket_penilaian_doc')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <template x-if="files">
                                <button type="reset" @click="files = null"
                                    class="px-2 py-1 text-xs text-white bg-red-600 rounded-md hover:bg-red-400">Reset</button>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6">
                    <label class="font-semibold text-gray-900">Kategori</label>
                    <!-- Kategori Brand -->
                    <div class="grid grid-cols-12 gap-4 mt-4">
                        <div class="col-span-12 sm:col-span-6 category">
                            <select id="category_id" name="category_id" wire:model="category_id"
                                class="block w-full px-3 py-2 text-xs bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                <option value selected>Kategori Brand ... </option>
                                @foreach ($list as $item)
                                    <option value="{{ $item->id }}">{{ $item->categories }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end col-span-12 sm:col-span-6">
                            <button type="submit" @click="files = null"
                                class="w-full px-3 py-2 mx-1 text-xs text-white bg-blue-600 rounded-md md:w-1/2 hover:bg-blue-400">
                                Upload
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div
        class="p-5 mt-10 overflow-hidden overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-md md:mx-10">
        <div class="grid grid-cols-12 my-3">
            <div class="flex flex-col col-span-12 sm:col-span-6">
                <span class="mb-2 text-xs font-semibold sm:text-sm">
                    Cari Kategori Brand :
                </span>
                <input type="text" wire:model="search" placeholder="Cari Kategori Brand ..."
                    class="inset-y-0 right-0 block w-full text-xs border-gray-300 rounded-md shadow-sm md:w-3/4 lg:w-1/2 focus:ring-green-400 focus:border-green-400 sm:text-sm">
            </div>
            <div class="flex flex-col col-span-12 sm:col-end-13 sm:col-start-9">
                <span class="mt-4 mb-2 text-xs font-semibold sm:text-sm md:text-right sm:mt-0">
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
        <table class="min-w-full border border-gray-200 divide-y divide-gray-200 shadow-lg">
            <thead class="bg-green-200">
                <tr>
                    <th scope="col"
                        class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        Kategori
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        Nama File
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
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if (isset($category->kategoriAngket->angket_penilaian_doc))
                                {{ $category->kategoriAngket->angket_penilaian_doc }}
                            @else
                                <span class="px-2 py-1 text-xs text-white bg-red-500 rounded-full">Data Tidak
                                    Ada</span>
                            @endif
                        </td>
                        <td class="flex justify-center py-4 space-x-4 text-sm font-semibold whitespace-nowrap">
                            @if (isset($category->kategoriAngket->angket_penilaian_doc))
                                <a target="_blank"
                                    href="{{ asset('storage/template_angket/' . $category->kategoriAngket->angket_penilaian_doc) }}"
                                    class="px-2 py-1 text-sm bg-indigo-300 rounded-lg hover:bg-indigo-400">Download</a>
                                <button class="px-2 py-1 text-sm bg-yellow-300 rounded-lg hover:bg-yellow-400"
                                    wire:click="$emit('openModal', 'penilaian.modal.edit-angket', {{ json_encode(['category' => $category->id]) }})">Edit</button>
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
        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</div>
