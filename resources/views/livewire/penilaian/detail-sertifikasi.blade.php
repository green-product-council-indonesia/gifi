@section('title', 'Dokumen Sertifikasi')
<div>
    <p class="mb-2 text-3xl font-bold leading-7 text-gray-900 ">
        Penilaian Sertifikasi
    </p>
    <hr>
    <div class="p-6 mt-5 bg-white border-2 border-green-200 rounded-lg shadow-lg">

        <div class="grid grid-cols-2 gap-2 ">
            <div class="col-span-2 md:col-span-1">
                <dl>
                    <div class="px-4 py-5  sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-xs font-semibold text-gray-500">
                            Nama Badan Usaha Jalan Tol
                        </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $data->nama_bujt }}
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="col-span-2 md:col-span-1">
                <dl>
                    <div class="px-4 py-5  sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-xs font-semibold text-gray-500">
                            Nama Ruas
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $data->nama_ruas }}
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="col-span-2 md:col-span-1 mx-4">
                <label class="block text-xs m-1 font-medium text-gray-700 ">
                    Laporan Ringkas Verifikasi
                </label>
                <dl>
                    @if ($data->reports->laporan_ringkas_verifikasi)
                        <div
                            class="flex flex-col justify-between px-5 py-5 mt-2 mb-8 bg-white border border-green-400 rounded-md shadow-sm sm:flex-row hover:border-green-600 hover:bg-green-50">
                            <div class="flex flex-col space-x-2 space-y-4 sm:space-y-0 sm:items-center sm:flex-row">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                <p class="font-semibold text-sm">
                                    {{ $data->reports->laporan_ringkas_verifikasi }}
                                </p>
                            </div>
                            <div class="flex items-center justify-end mt-4 space-x-2 sm:mt-0">
                                <a href="{{ asset('storage/dokumen_audit/' . $data->slug . '/' . \Str::slug($data->nama_ruas) . '/' . $data->reports->laporan_ringkas_verifikasi) }}"
                                    target="_blank"
                                    class="px-3 py-2 text-xs text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                                    Preview
                                </a>
                                <button type="button"
                                    wire:click="delete({{ $data->reports->id }}, '{{ $data->reports->laporan_ringkas_verifikasi }}', 'laporan_ringkas_verifikasi')"
                                    class="px-3 py-2 text-xs text-white bg-red-600 rounded-md hover:bg-red-700">
                                    Delete
                                </button>
                            </div>
                        </div>
                    @else
                        <form wire:submit.prevent="uploadLaporan({{ $data->id }})" x-data="{ files: null }">
                            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                                class="flex justify-center px-6 py-2 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <div class="text-sm text-gray-600">
                                        <label for="laporan_verifikasi"
                                            class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span
                                                x-text="files ? files.map(file => file.name).join(', ') : 'Upload a file...'"></span>
                                            <input id="laporan_verifikasi" name="laporan_verifikasi" type="file"
                                                class="sr-only" wire:model="laporan_ringkas_verifikasi"
                                                x-on:change="files = Object.values($event.target.files)">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PDF, DOCX up to 10MB
                                    </p>
                                    <div x-show="isUploading">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                    @error('laporan_ringkas_verifikasi')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-2">
                                <button type="submit"
                                    class="px-2 py-1 mx-1 text-xs text-white bg-blue-600 rounded-md hover:bg-blue-400">
                                    <span wire:loading wire:loading.delay
                                        wire:target="laporan_ringkas_verifikasi">Loading</span>
                                    <span wire:loading.remove wire:target="laporan_ringkas_verifikasi">
                                        Upload
                                    </span>
                                </button>
                            </div>
                        </form>
                    @endif
                </dl>
            </div>
            <div class="col-span-2 md:col-span-1 mx-4">
                <label class="block text-xs m-1 font-medium text-gray-700 ">
                    Rekomendasi
                </label>
                <dl>
                    @if ($data->reports->rekomendasi)
                        <div
                            class="flex flex-col justify-between px-5 py-5 mt-2 mb-8 bg-white border border-green-400 rounded-md shadow-sm sm:flex-row hover:border-green-600 hover:bg-green-50">
                            <div class="flex flex-col space-x-2 space-y-4 sm:space-y-0 sm:items-center sm:flex-row">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                <p class="font-semibold text-sm">
                                    {{ $data->reports->rekomendasi }}
                                </p>
                            </div>
                            <div class="flex items-center justify-end mt-4 space-x-2 sm:mt-0">
                                <a href="{{ asset('storage/dokumen_audit/' . $data->slug . '/' . \Str::slug($data->nama_ruas) . '/' . $data->reports->rekomendasi) }}"
                                    target="_blank"
                                    class="px-3 py-2 text-xs text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                                    Preview
                                </a>
                                <button type="button"
                                    wire:click="delete({{ $data->reports->id }}, '{{ $data->reports->rekomendasi }}', 'rekomendasi')"
                                    class="px-3 py-2 text-xs text-white bg-red-600 rounded-md hover:bg-red-700">
                                    Delete
                                </button>
                            </div>
                        </div>
                    @else
                        <form wire:submit.prevent="uploadRekomendasi({{ $data->id }})" x-data="{ files: null }">
                            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                                class="flex justify-center px-6 py-2 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <div class="text-sm text-gray-600">
                                        <label for="rekomendasi"
                                            class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span
                                                x-text="files ? files.map(file => file.name).join(', ') : 'Upload a file...'"></span>
                                            <input id="rekomendasi" name="rekomendasi" type="file"
                                                class="sr-only" wire:model="rekomendasi"
                                                x-on:change="files = Object.values($event.target.files)">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PDF, DOCX up to 10MB
                                    </p>
                                    <div x-show="isUploading">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                    @error('rekomendasi')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-2">
                                <button type="submit"
                                    class="px-2 py-1 mx-1 text-xs text-white bg-blue-600 rounded-md hover:bg-blue-400">
                                    <span wire:loading wire:loading.delay wire:target="rekomendasi">Loading</span>
                                    <span wire:loading.remove wire:target="rekomendasi">
                                        Upload
                                    </span>
                                </button>
                            </div>
                        </form>
                    @endif
                </dl>
            </div>
        </div>

        @if ($data->status == 1)
            <div
                class="flex items-center justify-center gap-4 py-20 font-semibold text-center border-2 border-dashed border-green-500 rounded-lg mt-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-yellow-500" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <a href="#" wire:click.prevent="ubahStatus" class="text-2xl hover:text-green-500">
                    Klik Disini untuk Memulai Penilaian
                </a>
            </div>
        @else
            <div class="flex flex-col items-center mt-8 justify-between md:flex-row">
                <div class="">
                    <label for="" class="label">Sub Kategori Dokumen</label>
                    <select id="category_id" name="category_id" wire:model="kategori"
                        class="block w-full px-2 py-2 mt-1 text-xs border border-gray-300 rounded shadow md:mt-0 focus:border-green-200 focus:outline-none focus:ring-2 focus:ring-green-300">
                        <option value="" selected>Sub Kategori Dokumen ... </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->nama_kategori_dokumen }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <button wire:click="generatePdf({{ $data->id }}, '{{ $data->slug }}')"
                        class="flex items-center gap-2 px-3 py-2 text-xs text-white bg-indigo-600 rounded-md shadow-lg hover:bg-indigo-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Form Pendaftaran
                    </button>
                </div>
            </div>

            <div class="mt-4 overflow-hidden overflow-x-auto border border-gray-200 rounded-md shadow-md">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-green-200">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                                Nama Dokumen
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                                File
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                                Score
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                                Target
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                                Catatan
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-xs bg-white divide-y divide-gray-200">
                        @if (!is_null($kategori))
                            @php
                                $sum_score = 0;
                                $sum_target = 0;
                            @endphp
                            @foreach ($data->document as $item)
                                <tr>
                                    <td class="px-6 py-4 font-semibold">
                                        {{ $item->nama_dokumen }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold">
                                        @if (!is_null($item->pivot->nama_dokumen))
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @switch($item->pivot->status)
                                            @case(0)
                                                <span class="px-2 text-xs text-white bg-red-500 rounded-lg">
                                                    Kosong
                                                </span>
                                            @break

                                            @case(1)
                                                <span class="px-2 text-xs text-white bg-yellow-500 rounded-lg">
                                                    Belum Disetujui
                                                </span>
                                            @break

                                            @case(2)
                                                <span class="px-2 text-xs text-white bg-green-500 rounded-lg">
                                                    Sudah Disetujui
                                                </span>
                                            @break

                                            @default
                                        @endswitch
                                    </td>
                                    <td class="py-4 font-semibold {{ $item->pivot->score ? 'px-6' : 'px-2' }} ">
                                        @if ($item->pivot->score === null)
                                            <div class="flex gap-2">
                                                <input type="text" class="form-input" placeholder="Score ..."
                                                    wire:model.lazy="score">
                                                <button type="button" wire:loading.attr="disabled"
                                                    class="mx-1 text-xs"
                                                    wire:click="assignScore({{ $item->id }}, '{{ $data->id }}')">
                                                    <div wire:loading.class="animate-pulse"
                                                        wire:target="assignScore({{ $item->id }}, '{{ $data->id }}')"
                                                        class="rounded-full border-2 border-blue-500 focus:ring-blue-500 text-blue-500 bg-transparent  hover:bg-blue-600 hover:text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                </button>
                                            </div>
                                        @else
                                            {{ $item->pivot->score }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-semibold">
                                        {{ $item->bobot }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold">
                                        {{ $item->pivot->keterangan }}
                                    </td>
                                    <td class="px-2 py-4 space-y-2 font-semibold">
                                        @if (!is_null($item->pivot->nama_dokumen))
                                            <a href="{{ asset('storage/checklist-dokumen/' . $data->nama_bujt . '/' . $data->nama_ruas . '/' . $item->pivot->nama_dokumen) }}"
                                                target="_blank"
                                                class="px-2 py-1 text-xs text-white bg-indigo-500 rounded-md shadow-lg hover:bg-indigo-600">
                                                Preview
                                            </a>
                                        @endif
                                        @hasanyrole('verifikator|super-admin')
                                            @if ($item->pivot->status !== 2)
                                                @if (!is_null($item->pivot->nama_dokumen))
                                                    <button
                                                        wire:click="$emit('openModal', 'penilaian.modal.modal-approve', {{ json_encode(['id' => $item->id, 'data_id' => $data->id]) }})"
                                                        class="px-2 py-1 text-xs text-white bg-blue-600 rounded-md shadow-lg hover:bg-blue-700">
                                                        Approve Dokumen
                                                    </button>
                                                @endif
                                            @endif
                                            @if (!$item->pivot->keterangan)
                                                <button
                                                    wire:click="$emit('openModal', 'penilaian.modal.tambah-catatan', {{ json_encode(['id' => $item->id, 'data_id' => $data->id]) }})"
                                                    class="px-2 py-1 text-xs text-white bg-green-600 rounded-md shadow-lg hover:bg-green-700">
                                                    Tambah Catatan
                                                </button>
                                            @else
                                                <button
                                                    wire:click="$emit('openModal', 'penilaian.modal.edit-catatan', {{ json_encode(['id' => $item->id, 'data_id' => $data->id, 'data' => $item->pivot->keterangan]) }})"
                                                    class="px-2 py-1 text-xs text-white bg-green-600 rounded-md shadow-lg hover:bg-green-700">
                                                    Edit Catatan
                                                </button>
                                            @endif
                                            @if ($item->pivot->score)
                                                <button
                                                    wire:click="$emit('openModal', 'penilaian.modal.edit-score', {{ json_encode(['id' => $item->id, 'data_id' => $data->id, 'data' => $item->pivot->score]) }})"
                                                    class="px-2 py-1 text-xs text-white bg-blue-500 rounded-md shadow-lg hover:bg-blue-600">
                                                    Edit Score
                                                </button>
                                            @endif
                                        @endhasanyrole
                                    </td>
                                </tr>
                                @php
                                    $sum_score += $item->pivot->score;
                                    $sum_target += $item->bobot;
                                @endphp
                            @endforeach
                            <tr>
                                <td colspan="3" class="px-6 py-4 border-r border-gray-200">
                                    <p class="text-lg font-semibold">Total</p>
                                </td>
                                <td colspan="1" class="px-6 py-4 border-r border-gray-200">
                                    <p class="text-xs font-semibold">{{ $sum_score }}</p>
                                </td>
                                <td colspan="1" class="px-6 py-4 border-r border-gray-200">
                                    <p class="text-xs font-semibold">{{ $sum_target }}</p>
                                </td>
                                <td colspan="1" class="px-6 py-4 border-r border-gray-200">
                                    <p class="text-xs font-semibold">
                                        @if ($sum_score && $sum_target != 0)
                                            {{ round(($sum_score / $sum_target) * $scoring->kategori[0]->pivot->total_bobot, 2) }}
                                            %
                                        @endif
                                    </p>
                                </td>
                                <td colspan="1" class="px-6 py-4 text-center">
                                    @if ($data)
                                        <button
                                            wire:click="$emit('openModal', 'penilaian.modal.detail-skor', {{ json_encode(['data' => $data->id]) }})"
                                            class="px-2 py-2 text-xs text-white bg-indigo-600 rounded-md shadow-lg hover:bg-indigo-700">
                                            Detail Skor
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="7">
                                    <div
                                        class="flex items-center justify-center gap-4 py-20 font-semibold text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-blue-600"
                                            viewBox="0 0 20 20" fill="currentColor">
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
                        <tr wire:loading.class="table-row " wire:loading.remove.class="hidden"
                            wire:target="previousPage, nextPage, gotoPage" class="hidden">
                            <td colspan="7" class="text-center bg-gray-50 p-36">
                                <div class="flex justify-center">
                                    {{-- Loading --}}
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-24 h-24 text-green-500 animate-spin" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
