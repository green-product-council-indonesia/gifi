@section('title', 'Dokumen Sertifikasi')
<div>
    <p class="mb-2 text-3xl font-bold leading-7 text-gray-900 ">
        Dokumen Sertifikasi
    </p>
    <div class="p-6 mt-5 space-y-4 bg-white border-2 border-green-200 rounded-lg shadow-lg">
        <div class="grid grid-cols-2 gap-4">
            <div class="grid grid-cols-2 col-span-2 gap-4 md:col-span-1">
                <div class="col-span-2 sm:col-span-1">
                    <label for="" class="label">Select Nama Ruas</label>
                    <select id=" category_id" name="category_id" wire:model="registration_id" class="block w-full px-2 py-2 mt-1 text-xs border border-gray-300 rounded shadow md:mt-0 focus:border-green-200 focus:outline-none focus:ring-2 focus:ring-green-300">
                        <option value="" selected>Nama Ruas Jalan Tol ... </option>
                        @foreach ($data as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_ruas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label for="" class="label">Sub Kategori Dokumen</label>
                    <select id="category_id" name="category_id" wire:model="kategori" class="block w-full px-2 py-2 mt-1 text-xs border border-gray-300 rounded shadow md:mt-0 focus:border-green-200 focus:outline-none focus:ring-2 focus:ring-green-300">
                        <option value="" selected>Sub Kategori Dokumen ... </option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nama_kategori_dokumen }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        @if ($result)
        @foreach ($result as $item)
        <div class="flex flex-col">
            <p class="text-xs">
                Status Dokumen :
                @switch($item->status_dokumen)
                @case(null)
                <span class="font-semibold">-</span>
                @break

                @case(1)
                <span class="font-semibold text-red-500">Reject</span>
                @break

                @case(2)
                <span class="font-semibold text-green-500">Approved with Note</span>
                @break

                @case(3)
                <span class="font-semibold text-green-500">Approved</span>
                @break

                @default
                @endswitch
            </p>
            @if ($item->note_dokumen)
            <p class="text-xs">
                {{$item->note_dokumen}}
            </p>
            @endif
        </div>
        @endforeach
        @endif

        <div class="mt-6 overflow-hidden overflow-x-auto border border-gray-200 shadow-md sm:rounded">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-200">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase">
                            Kode
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase">
                            Nama Dokumen
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase">
                            File
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-medium tracking-wider text-center text-gray-800 uppercase">
                            Action
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-medium tracking-wider text-center text-gray-800 uppercase">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase">
                            Catatan
                        </th>
                    </tr>
                </thead>
                <tbody class="text-xs bg-white divide-y divide-gray-200" x-data="{ selected: null }">
                    @forelse ($result as $item)
                    @forelse ($item->document as $doc)
                    <tr>
                        <td class="px-6 py-4 font-semibold">
                            {{ $doc->kode }}
                        </td>
                        <td class="px-6 py-4 font-semibold">
                            {{ $doc->nama_dokumen }}
                        </td>
                        @if ($doc->pivot->nama_dokumen == null)
                        <td class="px-6 py-4 font-semibold text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button type="button" class="flex items-center justify-between px-2 py-1 mx-1 text-xs text-blue-500 bg-transparent border-2 border-blue-500 rounded-md focus:ring-blue-500 hover:bg-blue-500 hover:text-white" wire:click="$emit('openModal', 'sertifikasi.modal.upload-dokumen', {{ json_encode(['doc_id' => $doc->id, 'registration_id' => $registration_id]) }})">
                                Upload
                            </button>
                        </td>
                        @else
                        <td class="px-6 py-4 font-semibold text-center">
                            @if ($doc->pivot->status == 2)
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ $doc->pivot->status == 1 ? 'text-blue-500' : 'text-green-500' }}" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            @endif
                        </td>
                        <td class="flex flex-col px-6 py-4 space-y-2 font-semibold text-center">
                            @if ($doc->pivot->status == 2 && !$doc->pivot->nama_dokumen_edited)
                            <button wire:click="$emit('openModal', 'sertifikasi.modal.revisi-dokumen', {{ json_encode(['doc_id' => $doc->id, 'registration_id' => $registration_id]) }})" class="px-2 py-1 text-xs text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                                Revisi
                            </button>
                            @endif
                            <button wire:click="$emit('openModal', 'penilaian.modal.preview-document', {{ json_encode(['doc_id' => $doc->id, 'registration_id' => $registration_id]) }})" class="px-2 py-1 text-xs text-white {{ $doc->type == 'file' ? 'bg-indigo-500 hover:bg-indigo-600' : 'bg-green-500 hover:bg-green-600' }} rounded-md ">
                                Preview
                            </button>
                        </td>
                        @endif
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @switch($doc->pivot->status)
                            @case(0)
                            <span class="px-2 py-0 mx-0 text-xs text-white bg-red-500 rounded-lg">
                                kosong
                            </span>
                            @break

                            @case(1)
                            <span class="px-2 py-0 mx-0 text-xs text-white bg-blue-500 rounded-lg">
                                Belum disetujui
                            </span>
                            @break

                            @case(2)
                            <span class="px-2 py-0 mx-0 text-xs text-white bg-yellow-500 rounded-lg">
                                Rejected
                            </span>
                            @break

                            @case(3)
                            <span class="px-2 py-0 mx-0 text-xs text-white bg-green-500 rounded-lg">
                                Sudah Disetujui
                            </span>
                            @break

                            @default
                            @endswitch
                        </td>
                        <td class="px-6 py-4 font-semibold">
                            {{ $doc->pivot->keterangan }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="flex items-center justify-center gap-4 py-20 font-semibold text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-2xl">
                                    Data Tidak Ada
                                </span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="flex items-center justify-center gap-4 py-20 font-semibold text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                </svg>
                                <span class="text-2xl">
                                    Choose Data First
                                </span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>