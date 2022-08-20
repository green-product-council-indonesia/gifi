<div>
    <div class="bg-white divide-y divide-gray-200">
        <div class="flex items-center justify-between px-5 py-4 bg-white">
            <div class="flex items-center space-x-4">
                <p class="text-sm font-semibold text-gray-800">
                    Preview Dokumen
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
            <div class="col-span-12 space-y-2">
                <p class="text-sm font-bold">Dokumen</p>
                <ul class="pl-4 list-disc">
                    @foreach (json_decode($doc->nama_dokumen) as $dokumen)
                        <li class="mb-2 ">
                            <div class="flex items-center justify-between space-x-4">
                                <p class="text-xs">
                                    {{ $dokumen }}
                                </p>
                                <div class="flex space-x-2">
                                    <a href="{{ asset('storage/checklist-dokumen/' . $data->registration[0]->nama_bujt . '/' . $data->registration[0]->nama_ruas . '/' . $dokumen) }}"
                                        target="_blank"
                                        class="flex items-center p-2 space-x-2 bg-green-600 rounded-md hover:bg-green-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                        </svg>
                                        <p class="text-xs text-white">Preview</p>
                                    </a>
                                    @hasanyrole('client|super-admin')
                                        @if ($doc->status == 1)
                                            <button
                                                wire:click="$emit('openModal', 'sertifikasi.modal.edit-dokumen', {{ json_encode(['document_id' => $doc->document_id, 'registration_id' => $doc->registration_id, 'nama_dokumen' => $dokumen]) }})"
                                                class="flex items-center p-2 space-x-2 bg-indigo-600 rounded-md hover:bg-indigo-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                                {{-- <p class="text-xs text-white">Edit</p> --}}
                                            </button>
                                            <button
                                                wire:click="$emit('openModal', 'sertifikasi.modal.delete-dokumen', {{ json_encode(['document_id' => $doc->document_id, 'registration_id' => $doc->registration_id, 'nama_dokumen' => $dokumen]) }})"
                                                class="flex items-center p-2 space-x-2 bg-red-500 rounded-md hover:bg-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{-- <p class="text-xs text-white">Delete</p> --}}
                                            </button>
                                        @endif
                                    @endhasanyrole
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                @isset($doc->nama_dokumen_edited)
                    <p class="text-sm font-bold">Edited Dokumen</p>
                    <ul class="pl-4 list-disc">
                        @foreach (json_decode($doc->nama_dokumen_edited) as $dokumen)
                            <li class="mb-2 ">
                                <div class="flex items-center justify-between space-x-4">
                                    <p class="text-xs">
                                        {{ $dokumen }}
                                    </p>
                                    <div class="flex space-x-2">
                                        <a href="{{ asset('storage/checklist-dokumen/' . $data->registration[0]->nama_bujt . '/' . $data->registration[0]->nama_ruas . '/' . $dokumen) }}"
                                            target="_blank"
                                            class="flex items-center p-2 space-x-2 bg-green-600 rounded-md hover:bg-green-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                            </svg>
                                            <p class="text-xs text-white">Preview</p>
                                        </a>
                                        @hasanyrole('client|super-admin')
                                            @if ($doc->status != 3)
                                                <button
                                                    wire:click="$emit('openModal', 'sertifikasi.modal.edit-dokumen', {{ json_encode(['document_id' => $doc->document_id, 'registration_id' => $doc->registration_id, 'nama_dokumen' => $dokumen]) }})"
                                                    class="flex items-center p-2 space-x-2 bg-indigo-600 rounded-md hover:bg-indigo-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                    {{-- <p class="text-xs text-white">Edit</p> --}}
                                                </button>
                                                <button
                                                    wire:click="$emit('openModal', 'sertifikasi.modal.delete-dokumen', {{ json_encode(['document_id' => $doc->document_id, 'registration_id' => $doc->registration_id, 'nama_dokumen' => $dokumen]) }})"
                                                    class="flex items-center p-2 space-x-2 bg-red-500 rounded-md hover:bg-red-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{-- <p class="text-xs text-white">Delete</p> --}}
                                                </button>
                                            @endif
                                        @endhasanyrole
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endisset
            </div>
        </div>

    </div>
    <div class="flex justify-end px-4 py-3 bg-white">
        <button type="button" wire:click.prevent="$emit('closeModal')"
            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Kembali
        </button>
    </div>
</div>
