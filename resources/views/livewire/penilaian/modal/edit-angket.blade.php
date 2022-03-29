<div>
    <div class="bg-white divide-y divide-gray-200">
        <div class="flex items-center justify-between px-5 py-4 bg-green-100">
            <div class="flex items-center space-x-4">
                <div
                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-blue-200 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                        <path fill-rule="evenodd"
                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <h2 class="font-semibold text-gray-700">
                    Edit {{ $category->categories }}
                </h2>
            </div>
            <button class="text-gray-400 hover:text-gray-600" wire:click="$emit('closeModal')">
                <svg class="w-4 transition duration-150 fill-current" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512.001 512.001">
                    <path
                        d="M284.286 256.002L506.143 34.144c7.811-7.811 7.811-20.475 0-28.285-7.811-7.81-20.475-7.811-28.285 0L256 227.717 34.143 5.859c-7.811-7.811-20.475-7.811-28.285 0-7.81 7.811-7.811 20.475 0 28.285l221.857 221.857L5.858 477.859c-7.811 7.811-7.811 20.475 0 28.285a19.938 19.938 0 0014.143 5.857 19.94 19.94 0 0014.143-5.857L256 284.287l221.857 221.857c3.905 3.905 9.024 5.857 14.143 5.857s10.237-1.952 14.143-5.857c7.811-7.811 7.811-20.475 0-28.285L284.286 256.002z" />
                </svg>
            </button>
        </div>

        <div class="grid grid-cols-12 gap-4 p-8">
            <div class="col-span-12 md:col-span-9">
                <label class="font-semibold text-gray-900">Dokumen Template</label>
                <p class="text-xs tracking-wider text-green-500">File harus berupa file excel (xls, xslx)</p>
                <div class="flex justify-center px-6 py-10 mt-1 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="flex items-center space-x-4 space-y-2" x-data="{ files: null }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto text-gray-400 w-14 h-14" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <div class="detail">
                            <div class="text-sm text-gray-600">
                                <label for="edit_angket_penilaian"
                                    class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span
                                        x-text="files ? files.map(file => file.name).join(', ') : 'Upload a file...'"></span>
                                    <input id="edit_angket_penilaian" name="edit_angket_penilaian" type="file"
                                        wire:model="angket_penilaian" class="sr-only"
                                        x-on:change="files = Object.values($event.target.files)">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">
                                XLSX file up to 10MB
                            </p>
                            @error('angket_penilaian')
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
            <div class="col-span-12 md:col-span-3">

            </div>
        </div>

    </div>
    <div class="flex justify-end px-4 py-3 space-x-4 bg-green-50">
        <button wire:click.prevent="editAngket({{ $category->kategoriAngket->id }})"
            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-xs font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm sm:mt-0">
            Update
        </button>
        <button type="button" wire:click.prevent="$emit('closeModal')"
            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Kembali
        </button>
    </div>
</div>
