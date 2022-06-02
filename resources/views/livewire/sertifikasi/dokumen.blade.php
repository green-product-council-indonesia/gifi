@section('title', 'Dokumen Sertifikasi')
<div>
    <p class="mb-2 text-3xl font-bold leading-7 text-gray-900 ">
        Dokumen Sertifikasi
    </p>
    <div class="p-6 mt-5 bg-white border-2 border-green-200 rounded-lg shadow-lg">
        <div class="grid grid-cols-2 gap-4">
            <div class="grid grid-cols-2 col-span-2 gap-4 md:col-span-1">
                <div class="col-span-2 sm:col-span-1">
                    <label for="" class="label">Select Nama Ruas</label>
                    <select id=" category_id" name="category_id" wire:model="ruas"
                        class="block w-full px-2 py-2 mt-1 text-xs border border-gray-300 rounded shadow md:mt-0 focus:border-green-200 focus:outline-none focus:ring-2 focus:ring-green-300">
                        <option value="" selected>Nama Ruas Jalan Tol ... </option>
                        @foreach ($data as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_ruas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label for="" class="label">Sub Kategori Dokumen</label>
                    <select id="category_id" name="category_id" wire:model="kategori"
                        class="block w-full px-2 py-2 mt-1 text-xs border border-gray-300 rounded shadow md:mt-0 focus:border-green-200 focus:outline-none focus:ring-2 focus:ring-green-300">
                        <option value="" selected>Sub Kategori Dokumen ... </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->nama_kategori_dokumen }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-span-2 mt-4 md:mt-0 md:col-span-1">
                <p class="text-sm text-center">
                    Dokumen yang diperbolehkan harus berbentuk <b>PDF</b> <br> dan setiap dokumen memiliki ukuran
                    maksimal 15MB
                </p>
            </div>
        </div>
        @error('nama_dokumen')
            <div
                class="flex items-center justify-center px-2 py-1 mt-4 font-medium text-red-700 bg-red-100 border border-red-300 rounded-md">
                <div slot="avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="w-5 h-5 mx-2 feather feather-alert-octagon">
                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <div class="items-center flex-initial max-w-full text-xl font-normal">
                    <span class="error">{{ $message }}</span>
                </div>
                <div class="flex flex-row-reverse flex-auto">
                    <div wire:click="resetError">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="w-5 h-5 ml-2 rounded-full cursor-pointer feather feather-x hover:text-red-400">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                </div>
            </div>
        @enderror

        <div class="mt-6 overflow-hidden overflow-x-auto border border-gray-200 shadow-md sm:rounded">
            @if ($result)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-green-200">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase">
                                Kode
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase">
                                Nama Dokumen
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase">
                                File
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-medium tracking-wider text-center text-gray-800 uppercase">
                                Action
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-medium tracking-wider text-center text-gray-800 uppercase">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase">
                                Keterangan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-xs bg-white divide-y divide-gray-200" x-data="{ selected: null }">
                        @foreach ($result as $item)
                            @foreach ($item->document as $doc)
                                <tr>
                                    <td class="px-6 py-4 font-semibold">
                                        {{ $doc->kode }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold">
                                        {{ $doc->nama_dokumen }}
                                    </td>
                                    @if ($doc->pivot->nama_dokumen == null)
                                        @php
                                            preg_match("/(?:\w+(?:\W+|$)){0,5}/", $doc->nama_dokumen, $matches);
                                        @endphp
                                        @if ($doc->type == 'file')
                                            <td>
                                                <input type="file" wire:model.lazy="nama_dokumen">
                                            </td>
                                        @else
                                            <td>
                                                <input type="text" class="form-input" placeholder="Url dokumen ..."
                                                    wire:model.lazy="nama_dokumen">
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 text-center">
                                            <button type="button" wire:loading.attr="disabled"
                                                wire:loading.class="animate-pulse"
                                                wire:target="uploadDokumen({{ $doc->id }}), nama_dokumen"
                                                class="flex items-center justify-between px-2 py-1 mx-1 text-xs text-blue-500 bg-transparent border-2 border-blue-500 rounded-md focus:ring-blue-500 hover:bg-blue-500 hover:text-white"
                                                wire:click="uploadDokumen({{ $doc->id }}, '{{ Str::replace(')', '', str_replace('(', '', $matches[0])) }}')">

                                                <span wire:loading
                                                    wire:target="uploadDokumen({{ $doc->id }}), nama_dokumen"
                                                    wire:loading.delay>Loading</span>
                                                <span wire:loading.remove
                                                    wire:target="uploadDokumen({{ $doc->id }}), nama_dokumen">
                                                    Upload
                                                </span>
                                            </button>
                                        </td>
                                    @else
                                        <td class="px-6 py-4 font-semibold text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </td>
                                        <td class="flex flex-col px-6 py-4 space-y-2 font-semibold text-center">
                                            @if ($doc->pivot->status == 1)
                                                <button
                                                    wire:click="$emit('openModal', 'sertifikasi.modal.edit-dokumen', {{ json_encode(['id' => $doc->id, 'data' => $ruas]) }})"
                                                    class="px-2 py-1 text-xs text-white bg-indigo-500 rounded-md hover:bg-indigo-600">
                                                    Edit
                                                </button>
                                                <a href="{{ asset('storage/checklist-dokumen/' . $item->nama_bujt . '/' . $item->nama_ruas . '/' . $doc->pivot->nama_dokumen) }}"
                                                    target="_blank"
                                                    class="px-2 py-1 text-xs text-white bg-green-500 rounded-md hover:bg-green-600">
                                                    Preview
                                                </a>
                                            @endif
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 font-semibold text-center">
                                        @switch($doc->pivot->status)
                                            @case(0)
                                                <p class="px-0 py-0 mx-0 text-xs text-white bg-red-500 rounded-lg">
                                                    kosong</p>
                                            @break

                                            @case(1)
                                                <p class="px-0 py-0 mx-0 text-xs text-white bg-yellow-500 rounded-lg">
                                                    Belum
                                                    diapprove</p>
                                            @break

                                            @case(2)
                                                <p class="px-0 py-0 mx-0 text-xs text-white bg-green-500 rounded-lg">
                                                    Approved</p>
                                            @break

                                            @default
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4 font-semibold whitespace-nowrap">
                                        {{ $doc->pivot->keterangan }}
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
