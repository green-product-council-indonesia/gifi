@section('title', 'Checklist Dokumen Sertifikasi')
<div>
    <p class="mb-2 text-3xl font-bold leading-7 text-gray-900 ">
        Checklist Dokumen Sertifikasi
    </p>
    <hr>

    <div class="flex flex-col items-center justify-between mt-4 sm:flex-row">
        <div class="flex flex-col">
            <label class="mb-2 text-sm font-semibold">Select Jenis Sertifikasi</label>
            <div class="flex justify-center p-2 space-x-2 bg-white border border-green-300 rounded-md">
                @foreach ($categories as $item)
                    <div wire:click="changeCategory({{ $item->id }})"
                        class="cursor-pointer flex justify-between px-4 py-1  my-1 {{ $item->id != $category ?: 'bg-green-100 border border-green-300 rounded-md' }} hover:bg-green-100 ">
                        <p class="text-sm font-semibold">
                            {{ $item->nama_kategori }}
                        </p>
                    </div>
                @endforeach
            </div>
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
    <div class="grid grid-cols-12 gap-4 my-4">
        @if ($category)
            <div class="col-span-12 md:col-span-4">
                <ul class="p-4 bg-white border border-green-300 rounded-md">
                    @foreach ($docs as $doc)
                        <li>
                            <div wire:click="changeList({{ $doc->id }})"
                                class="cursor-pointer flex justify-between p-4 my-1 {{ $doc->id != $document_category_id ?: 'bg-green-100 border border-green-300 rounded-md' }} hover:bg-green-100">
                                <p class="text-xs font-semibold">{{ $doc->nama_kategori_dokumen }}</p>
                                <p class="text-xs font-semibold">
                                    @foreach ($doc->kategori as $item)
                                        @if ($item->pivot->total_bobot > 0)
                                            {{ $item->pivot->total_bobot }} %
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-span-12 md:col-span-8">
                <div class="grid grid-cols-2 gap-4">
                    @forelse ($documents as $document)
                        <div class="col-span-2 p-2 bg-white border border-green-300 rounded-md sm:col-span-1">
                            <p class="">
                                <span class="px-2 text-xs text-white bg-green-500 rounded-lg">
                                    {{ $document->kode }}
                                </span>
                            </p>
                            <div class="flex justify-between space-x-2">
                                <div class="my-2">
                                    <p class="text-xs">
                                        {{ $document->nama_dokumen }}
                                    </p>
                                    @if ($item->bobot != 0)
                                        {{ $item->bobot }}
                                    @else
                                        -
                                    @endif
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <button
                                        wire:click="$emit('openModal', 'import.modal.edit-checklist', {{ json_encode(['id' => $item->id]) }})"
                                        class="px-3 py-1 text-xs text-white bg-green-600 rounded-md hover:bg-green-700">
                                        Edit
                                    </button>
                                    <button
                                        wire:click="$emit('openModal', 'import.modal.delete-checklist', {{ json_encode(['id' => $item->id]) }})"
                                        class="px-3 py-1 text-xs text-white bg-red-600 rounded-md hover:bg-red-700">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 p-2 bg-white border border-green-300 rounded-md">
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
                        </div>
                    @endforelse
                </div>
            </div>
        @endif
    </div>
</div>
