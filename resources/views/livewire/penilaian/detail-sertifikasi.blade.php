@section('title', 'Detail Penilaian Sertifikasi')
<div>
    <div class="relative">
        <x-spinner class="w-8 animate-spin absolute top-0 right-0" wire:loading
            wire:target="angketPenilaian, laporanRingkas, rekomendasi">
        </x-spinner>
    </div>
    <p class="mb-2 text-3xl font-bold leading-7 text-gray-900 ">
        Detail Penilaian Sertifikasi
    </p>
    @if (session()->has('message'))
        @livewire('components.alert-success')
    @endif
    @if (session()->has('error'))
        @livewire('components.alert-error')
    @endif
    <ul class="my-4 text-sm list-disc list-inside">
        <li>Untuk memulai penilaian, harap ubah status produk pada tombol dibawah</li>
        <li>Template Form Penilaian bisa diunduh pada list yang ada dibawah ini</li>
    </ul>
    <div class="flex items-center justify-end">
        <button wire:click="generatePdf('{{ $brand->slug }}')"
            class="px-3 py-2 mx-1 rounded-md text-white text-xs bg-indigo-500 hover:bg-indigo-600">Form GLI</button>
        <button type="button"
            class="px-3 py-2 mx-1 rounded-md text-white text-xs  {{ $brand->status === 1 ? 'bg-red-500 hover:bg-red-400' : 'bg-blue-500 hover:bg-blue-400' }} "
            {{ $brand->status === 1 ? '' : 'disabled' }}
            wire:click="$emit('openModal', 'penilaian.modal.ubah-status', {{ json_encode(['brand' => $brand->id]) }})">
            @if ($brand->status === 1)
                Ubah Status Produk
            @elseif($brand->status === 2)
                Produk Sedang Diverifikasi
            @elseif($brand->status === 3)
                Produk Ter-Verifikasi
            @endif
        </button>
    </div>
    @php
        $contactPlant = json_decode($brand->plant->contact);
        $contactPerusahaan = json_decode($brand->plant->perusahaan->contact);
    @endphp
    <div class="grid grid-cols-12 gap-4 my-4">
        <div class="col-span-12 md:col-span-6">
            <div class="border-2 rounded-lg border-grey-200">
                <dl>
                    <div class="px-4 py-5 bg-gray-50 md:grid md:grid-cols-3 md:gap-4 md:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Nama Brand
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                            {{ $brand->nama_brand }}
                        </dd>
                    </div>
                    <div class="px-4 py-5 bg-white md:grid md:grid-cols-3 md:gap-4 md:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Perusahaan
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                            {{ $brand->plant->perusahaan->nama_perusahaan }}
                        </dd>
                    </div>
                    <div class="px-4 py-5 bg-gray-50 md:grid md:grid-cols-3 md:gap-4 md:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Kontak Perusahaan
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                            <ul class="list-disc list-inside">
                                <li>Nama : {{ $contactPerusahaan->cp_1->nama }}</li>
                                <li>Email : {{ $contactPerusahaan->cp_1->email }}</li>
                                <li>No. Telp : {{ $contactPerusahaan->cp_1->no_hp }}</li>
                            </ul>
                        </dd>
                    </div>
                    <div class="px-4 py-5 bg-white md:grid md:grid-cols-3 md:gap-4 md:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Plant
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                            {{ $brand->plant->nama_plant }}
                        </dd>
                    </div>
                    <div class="px-4 py-5 bg-gray-50 md:grid md:grid-cols-3 md:gap-4 md:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Kontak Plant
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                            <ul class="list-disc list-inside">
                                <li>Nama : {{ $contactPlant->nama }}</li>
                                <li>Email : {{ $contactPlant->email }}</li>
                                <li>No. Telp : {{ $contactPlant->no_hp }}</li>
                            </ul>
                        </dd>
                    </div>
                    <div class="px-4 py-5 bg-white md:grid md:grid-cols-3 md:gap-4 md:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Kategori Brand
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                            {{ $brand->kategoriProduk->categories }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
        @if ($brand->status === 2 || $brand->status === 3)
            <div class="col-span-12 md:col-span-6">
                <div class="p-3 bg-white border-2 border-green-200 rounded-md">
                    <div class="brand">
                        <p class="mb-2 text-xl font-bold leading-7 text-gray-900 ">List Upload Dokumen Penilaian</p>
                        @if ($brand->KategoriProduk->kategoriAngket)
                            <button type="button"
                                wire:click="download({{ $brand->KategoriProduk->kategoriAngket->id }})"
                                class="flex justify-end px-4 py-2 m-4 text-xs font-semibold text-white bg-green-500 rounded-md hover:bg-green-700">
                                Download Template Angket Penilaian
                            </button>
                        @else
                            <button type="button"
                                class="flex justify-end px-4 py-2 m-4 text-xs font-semibold text-white bg-green-500 rounded-md hover:bg-green-700"
                                onclick="alert('Belum Ada Dokumen Penilaian')">
                                <i class="mr-2 fas fa-file-pdf"></i>
                                Download Template Angket Penilaian
                            </button>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 ">
                            Angket Penilaian
                        </label>
                        @if ($brand->ratings->angket_penilaian)
                            <div
                                class="flex flex-col justify-between px-5 py-5 mt-2 mb-8 bg-white border border-green-400 rounded-md shadow-sm sm:flex-row hover:border-green-600 hover:bg-green-50">
                                <div class="flex flex-col space-x-2 space-y-4 sm:space-y-0 sm:items-center sm:flex-row">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <p class="font-semibold ">{{ $brand->ratings->angket_penilaian }}</p>
                                </div>
                                <div class="flex items-center justify-end mt-4 space-x-2 sm:mt-0">
                                    <a href="{{ asset('storage/dokumen_audit/' . $brand->slug . '/' . $brand->ratings->angket_penilaian) }}"
                                        target="_blank"
                                        class="px-3 py-2 text-xs text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                                        Preview
                                    </a>
                                    <button type="button"
                                        wire:click="delete({{ $brand->ratings->id }}, '{{ $brand->ratings->angket_penilaian }}', 'angket_penilaian')"
                                        class="px-3 py-2 text-xs text-white bg-red-600 rounded-md hover:bg-red-700">
                                        Delete
                                    </button>
                                </div>

                            </div>
                        @else

                            <div x-data="{ isUploading: false, progress: 0, files: null }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                                class="flex justify-center px-6 pt-5 pb-6 mt-1 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <div class="text-sm text-gray-600">
                                        <label for="angket_penilaian"
                                            class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span
                                                x-text="files ? files.map(file => file.name).join(', ')  : 'Upload a file...'"></span>
                                            <input id="angket_penilaian" name="angket_penilaian" type="file"
                                                class="sr-only" wire:model="angket_penilaian"
                                                x-on:change="files = Object.values($event.target.files)">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PDF, DOCX up to 10MB
                                    </p>
                                    <div x-show="isUploading">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                    @error('angket_penilaian')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                    {{-- <template x-if="files">
                                            <button type="reset" @click="files = null"
                                                class="px-2 py-1 text-xs text-white bg-red-600 rounded-md hover:bg-red-400">
                                                Reset
                                            </button>
                                        </template> --}}
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-3">
                                <button wire:click="angketPenilaian({{ $brand->ratings->id }})"
                                    class="px-3 py-2 mx-1 text-xs text-white bg-blue-600 rounded-md hover:bg-blue-400">
                                    <span wire:loading wire:loading.delay wire:target="angket_penilaian">Loading</span>
                                    <span wire:loading.remove wire:target="angket_penilaian, submit">
                                        Upload
                                    </span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 ">
                            Laporan Ringkas Verifikasi
                        </label>
                        @if ($brand->ratings->laporan_ringkas_verifikasi)
                            <div
                                class="flex flex-col justify-between px-5 py-5 mt-2 mb-8 bg-white border border-green-400 rounded-md shadow-sm sm:flex-row hover:border-green-600 hover:bg-green-50">
                                <div class="flex flex-col space-x-2 space-y-4 sm:space-y-0 sm:items-center sm:flex-row">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <p class="font-semibold">
                                        {{ $brand->ratings->laporan_ringkas_verifikasi }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-end mt-4 space-x-2 sm:mt-0">
                                    <a href="{{ asset('storage/dokumen_audit/' . $brand->nama_brand . '/' . $brand->ratings->laporan_ringkas_verifikasi) }}"
                                        target="_blank"
                                        class="px-3 py-2 text-xs text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                                        Preview
                                    </a>
                                    <button type="button"
                                        wire:click="delete({{ $brand->ratings->id }}, '{{ $brand->ratings->laporan_ringkas_verifikasi }}', 'laporan_ringkas_verifikasi')"
                                        class="px-3 py-2 text-xs text-white bg-red-600 rounded-md hover:bg-red-700">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        @else
                            <form wire:submit.prevent="laporanRingkas({{ $brand->ratings->id }})"
                                x-data="{ files: null }">
                                <div x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                                    class="flex justify-center px-6 pt-5 pb-6 mt-1 border-2 border-gray-300 border-dashed rounded-md">
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
                                        {{-- <template x-if="files">
                                            <button type="reset" @click="files = null"
                                                class="px-2 py-1 text-xs text-white bg-red-600 rounded-md hover:bg-red-400">Reset</button>
                                        </template> --}}
                                    </div>
                                </div>
                                <div class="flex items-center justify-end mt-3">
                                    <button type="submit"
                                        class="px-3 py-2 mx-1 text-xs text-white bg-blue-600 rounded-md hover:bg-blue-400">
                                        <span wire:loading wire:loading.delay
                                            wire:target="laporan_ringkas_verifikasi">Loading</span>
                                        <span wire:loading.remove wire:target="laporan_ringkas_verifikasi">
                                            Upload
                                        </span>
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 ">
                            Recommendation for Improvement
                        </label>
                        @if ($brand->ratings->recommendation_for_improvement)
                            <div
                                class="flex flex-col justify-between px-5 py-5 mt-2 bg-white border border-green-400 rounded-md shadow-sm sm:flex-row hover:border-green-600 hover:bg-green-50">
                                <div class="flex flex-col space-x-2 space-y-4 sm:space-y-0 sm:items-center sm:flex-row">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <p class="font-semibold">
                                        {{ $brand->ratings->recommendation_for_improvement }}</p>
                                </div>
                                <div class="flex items-center justify-end mt-4 space-x-2 sm:mt-0">
                                    <a href="{{ asset('storage/dokumen_audit/' . $brand->nama_brand . '/' . $brand->ratings->recommendation_for_improvement) }}"
                                        target="_blank"
                                        class="px-3 py-2 text-xs text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                                        Preview
                                    </a>
                                    <button type="button"
                                        wire:click="delete({{ $brand->ratings->id }}, '{{ $brand->ratings->recommendation_for_improvement }}', 'recommendation_for_improvement')"
                                        class="px-3 py-2 text-xs text-white bg-red-600 rounded-md hover:bg-red-700">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        @else
                            <form wire:submit.prevent="rekomendasi({{ $brand->ratings->id }})"
                                x-data="{ files: null }">
                                <div x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                                    class="flex justify-center px-6 pt-5 pb-6 mt-1 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <div class="text-sm text-gray-600">
                                            <label for="recommendation"
                                                class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span
                                                    x-text="files ? files.map(file => file.name).join(', ') : 'Upload a file...'"></span>
                                                {{-- <span>Upload a file</span> --}}
                                                <input id="recommendation" name="recommendation" type="file"
                                                    class="sr-only" wire:model="recommendation_for_improvement"
                                                    x-on:change="files = Object.values($event.target.files)">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PDF, DOCX up to 10MB
                                        </p>
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                        @error('recommendation_for_improvement')
                                            <p class="text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                        {{-- <template x-if="files">
                                            <button type="reset" @click="files = null"
                                                class="px-2 py-1 text-xs text-white bg-red-600 rounded-md hover:bg-red-400">Reset</button>
                                        </template> --}}
                                    </div>
                                </div>
                                <div class="flex items-center justify-end mt-3">
                                    <button type="submit"
                                        class="px-3 py-2 mx-1 text-xs text-white bg-blue-600 rounded-md hover:bg-blue-400">
                                        <span wire:loading wire:loading.delay
                                            wire:target="recommendation_for_improvement">Loading</span>
                                        <span wire:loading.remove wire:target="recommendation_for_improvement">
                                            Upload
                                        </span>
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

</div>
