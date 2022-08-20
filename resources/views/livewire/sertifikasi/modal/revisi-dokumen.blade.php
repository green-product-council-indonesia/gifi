<div>
    <div class="bg-white divide-y divide-gray-200">
        <div class="flex items-center justify-between px-5 py-4 bg-white">
            <div class="flex items-center space-x-4">
                <p class="text-xl font-semibold text-gray-800">
                    Edit Dokumen
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
                        <div class="p-3 bg-yellow-300 rounded-md mb-4 space-y-2">
                            <p class="font-semibold text-sm">Catatan</p>
                            <p class="text-xs font-light">
                                {{ $doc->registration[0]->pivot->keterangan }}
                            </p>
                        </div>
                        <p class="font-semibold text-xs">Upload Dokumen</p>
                        <label class="border-2 border-gray-300 p-3 w-full block rounded-lg cursor-pointer my-2"
                            for="customFile1">
                            <input type="file" class="sr-only" id="customFile1" multiple="true"
                                wire:model="nama_dokumen">
                            <div class="flex space-x-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <span class="text-gray-500">Pilih File </span>
                            </div>
                        </label>

                        <ul class="p-3 bg-green-300 rounded-md">
                            @forelse ($nama_dokumen as $doc)
                                <li class="flex justify-between items-center py-2" wire:key="{{ $loop->index }}">
                                    <p>{{ $doc->getClientOriginalName() }}</p>
                                    <button wire:click="remove({{ $loop->index }})">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-6 w-6 text-red-500 hover:text-red-700 " viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </li>
                            @empty
                                <li class="py-2">
                                    <p class="font-semibold">Dokumen harus berukuran maksimal 50MB</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                    <div wire:loading wire:target="nama_dokumen" class="mt-2 text-xs text-green-500">
                        Uploading...</div>

                    @error('nama_dokumen')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

    </div>
    <div class="flex justify-end px-4 py-3 space-x-4 bg-gray-50">
        <button type="button" wire:loading.attr="disabled" wire:loading.class="animate-pulse" wire:click="upload"
            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-xs font-medium text-blue-700 bg-white border border-blue-500 rounded-md shadow-sm hover:bg-blue-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Update
        </button>
        <button type="button" wire:click.prevent="$emit('closeModal')"
            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Kembali
        </button>
    </div>
</div>
