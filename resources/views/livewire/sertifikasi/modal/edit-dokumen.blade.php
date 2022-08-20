<div>
    <div class="bg-white divide-y divide-gray-200">
        <div class="flex items-center justify-between px-5 py-4 bg-white">
            <div class="flex items-center space-x-4">
                <p class="text-xl font-semibold text-gray-800">
                    Ubah Dokumen
                </p>
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
            <div class="col-span-12">
                <div class="text-xs input">
                    <div>
                        <label class="border-2 border-gray-300 p-3 w-full block rounded-lg cursor-pointer my-2"
                            for="customFile1">
                            <input type="file" class="sr-only" id="customFile1" wire:model="dokumen_edit">
                            <div class="flex space-x-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <span class="text-gray-500">Change File</span>
                            </div>
                        </label>

                        @if ($dokumen_edit)
                            <ul class="p-3 bg-green-300 rounded-md">
                                <li class="flex justify-between items-center py-2">
                                    <p>
                                        {{ $dokumen_edit->getClientOriginalName() }}
                                    </p>
                                    <p class="text-xs whitespace-nowrap font-semibold">
                                        @if ($dokumen_edit->getSize() >= 1048576)
                                            {{ number_format($dokumen_edit->getSize() / 1048576, 2) }} MB
                                        @elseif ($dokumen_edit->getSize() >= 1024)
                                            {{ number_format($dokumen_edit->getSize() / 1024, 2) }} KB
                                        @endif
                                    </p>
                                </li>
                            </ul>
                        @else
                            <ul class="p-3 list-disc">
                                <li class="py-2">
                                    <p>Dokumen harus berukuran maksimal 50MB</p>
                                </li>
                                <li class="py-2">
                                    <p>Dokumen sebelumnya akan dihapus</p>
                                </li>
                            </ul>
                        @endif
                    </div>
                    <div wire:loading wire:target="dokumen_edit" class="mt-2 text-xs text-green-500">
                        Uploading...</div>

                    @error('dokumen_edit')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

    </div>
    <div class="flex justify-end px-4 py-3 space-x-4 bg-gray-50">
        <button type="button" wire:loading.attr="disabled" wire:loading.class="animate-pulse" wire:click="edit"
            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-xs font-medium text-blue-700 bg-white border border-blue-500 rounded-md shadow-sm hover:bg-blue-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Update
        </button>
        <button type="button" wire:click.prevent="$emit('closeModal')"
            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Kembali
        </button>
    </div>
</div>
