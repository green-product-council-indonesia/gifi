@section('title', 'Approve Data Sertifikasi')
<div>
    <p class="mb-2 text-3xl font-bold leading-7 text-gray-900 ">
        Approve Data Sertifikasi
    </p>
    <div class="flex items-center justify-end">
        @if ($brand->status == 2)
            <button
                wire:click="$emit('openModal', 'approve.modal.modal-acc', {{ json_encode(['brand' => $brand->id]) }})"
                class="px-3 py-2 my-2 text-sm font-medium text-white bg-blue-500 border-2 rounded-md hover:bg-blue-400">
                Approve Sertifikasi
            </button>
        @elseif($brand->status == 1)
        @else
            <button class="px-3 py-2 my-2 text-sm text-white bg-green-600 rounded-md hover:bg-green-700" disabled>
                Produk telah disertifikasi
            </button>
        @endif
    </div>
    @php
        $contactPlant = json_decode($brand->plant->contact);
        $contactPerusahaan = json_decode($brand->plant->perusahaan->contact);
    @endphp
    <div class="grid grid-cols-12 gap-4 my-4">
        <div class="col-span-12 md:col-span-6">
            <div class="border-2 border-green-200 rounded-lg">
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
        <div class="col-span-12 md:col-span-6">
            <div class="p-3 bg-white border-2 border-green-200 rounded-md">
                <div class="brand">
                    <p class="mb-2 text-xl font-bold leading-7 text-gray-900 ">Dokumen Penilaian</h5>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 ">
                        Angket Penilaian
                    </label>
                    <div
                        class="flex flex-col justify-between px-5 py-5 mt-2 mb-8 bg-white border border-green-400 rounded-md shadow-sm sm:flex-row hover:border-green-600 hover:bg-green-50">
                        @if ($brand->ratings->angket_penilaian)
                            <div class="flex flex-col space-x-4 space-y-4 sm:space-y-0 sm:items-center sm:flex-row">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="font-semibold ">{{ $brand->ratings->angket_penilaian }}</p>
                            </div>
                            <div class="flex items-center justify-end mt-4 space-x-2 sm:mt-0">
                                <a href="{{ asset('storage/dokumen_audit/' . $brand->slug . '/' . $brand->ratings->angket_penilaian) }}"
                                    target="_blank"
                                    class="px-3 py-2 text-xs text-white bg-yellow-500 rounded-md hover:bg-yellow-400">
                                    Preview
                                </a>
                            </div>
                        @else
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-lg font-semibold">Data Tidak Ada</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 ">
                        Laporan Ringkas Verifikasi
                    </label>
                    <div
                        class="flex flex-col justify-between px-5 py-5 mt-2 mb-8 bg-white border border-green-400 rounded-md shadow-sm sm:flex-row hover:border-green-600 hover:bg-green-50">
                        @if ($brand->ratings->laporan_ringkas_verifikasi)
                            <div class="flex flex-col space-x-4 space-y-4 sm:space-y-0 sm:items-center sm:flex-row">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="font-semibold">
                                    {{ $brand->ratings->laporan_ringkas_verifikasi }}
                                </p>
                            </div>
                            <div class="flex items-center justify-end mt-4 space-x-2 sm:mt-0">
                                <a href="{{ asset('storage/dokumen_audit/' . $brand->slug . '/' . $brand->ratings->laporan_ringkas_verifikasi) }}"
                                    target="_blank"
                                    class="px-3 py-2 text-xs text-white bg-yellow-500 rounded-md hover:bg-yellow-400">
                                    Preview
                                </a>
                            </div>
                        @else
                            <div class="flex items-center justify-end mt-4 space-x-2 sm:mt-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-lg font-semibold">Data Tidak Ada</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 ">
                        Recommendation for Improvement
                    </label>
                    <div
                        class="flex flex-col justify-between px-5 py-5 mt-2 mb-8 bg-white border border-green-400 rounded-md shadow-sm sm:flex-row hover:border-green-600 hover:bg-green-50">
                        @if ($brand->ratings->recommendation_for_improvement)
                            <div class="flex flex-col space-x-4 space-y-4 sm:space-y-0 sm:items-center sm:flex-row">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="font-semibold">
                                    {{ $brand->ratings->recommendation_for_improvement }}</p>
                            </div>
                            <div class="flex items-center justify-end mt-4 space-x-2 sm:mt-0">
                                <a href="{{ asset('storage/dokumen_audit/' . $brand->slug . '/' . $brand->ratings->recommendation_for_improvement) }}"
                                    target="_blank"
                                    class="px-3 py-2 text-xs text-white bg-yellow-500 rounded-md hover:bg-yellow-400">
                                    Preview
                                </a>
                            </div>
                        @else
                            <div class="flex items-center justify-end mt-4 space-x-2 sm:mt-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-lg font-semibold">Data Tidak Ada</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
