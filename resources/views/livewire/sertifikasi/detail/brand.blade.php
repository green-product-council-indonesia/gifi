<div>
    <div class="flex flex-col">
        <span class="mb-2 text-xs font-semibold">
            Pilih Brand :
        </span>
        <select wire:model="selectedBrand"
            class="w-full px-5 text-xs bg-white border border-gray-300 rounded-md shadow-sm appearance-none sm:w-1/4 focus:outline-none focus:ring-green-400 focus:border-green-400 md:text-sm">
            <option>Pilih Brand</option>
            @foreach ($brand as $item)
                @foreach ($item->brand as $item)
                    <option value="{{ $item->id }}">
                        ({{ Carbon\Carbon::parse($item->tgl_pendaftaran)->isoFormat('Y') }})
                        {{ $item->nama_brand }} -
                        {{ $item->jenis_sertifikasi === 1 ? 'Pengajuan Baru' : 'Renewal' }}
                    </option>
                @endforeach
            @endforeach
        </select>
    </div>


    @if ($selected)
        <div class="mt-4">
            <div class="flex justify-end my-2 space-x-4 bg-white">
                @if ($selected->status == 3)
                    <div class="mt-1 text-sm text-gray-900 ">
                        <a href="/pdf/{{ $selected->slug }}" target="_blank"
                            class="px-3 py-2 text-white bg-green-500 rounded-md hover:bg-green-600">
                            Cetak Sertifikat
                        </a>
                    </div>
                @endif
            </div>
            <dl>
                <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Nama Brand
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $selected->nama_brand }}
                    </dd>
                </div>
                <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Deskripsi
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $selected->deskripsi_brand }}
                    </dd>
                </div>
                <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tipe / Model
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $selected->tipe_model }}
                    </dd>
                </div>
                <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Merk Dagang
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $selected->merk_dagang }}
                    </dd>
                </div>
                <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tipe Pengemasan / Ukuran
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $selected->pengemasan_ukuran }}
                    </dd>
                </div>
                <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Dimensi (P x L x T)
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $selected->dimensi }}
                    </dd>
                </div>
                <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Jenis Sertifikasi
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if ($selected->jenis_sertifikasi = 1)
                            Pengajuan Baru
                        @else
                            Perpanjangan
                        @endif
                    </dd>
                </div>
                <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Status
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @switch($selected->status)
                            @case(1)
                                <span class="px-2 py-1 text-xs text-white bg-red-500 rounded-lg">Belum
                                    disertifikasi</span>
                            @break
                            @case(2)
                                <span class="px-2 py-1 text-xs text-white bg-yellow-500 rounded-lg">Sedang
                                    disertifikasi</span>
                            @break
                            @case(3)
                                <span class="px-2 py-0 text-xs text-white bg-green-500 rounded-lg">Sudah
                                    Disertifikasi</span>
                            @break
                            @default
                        @endswitch
                    </dd>
                </div>
                <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tanggal Pendaftaran
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @isset($selected->tgl_pendaftaran)
                            {{ Carbon\Carbon::parse($selected->tgl_pendaftaran)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        @endisset
                    </dd>
                </div>
                <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tanggal Approval
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @isset($selected->tgl_approve)
                            {{ Carbon\Carbon::parse($selected->tgl_approve)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        @endisset
                    </dd>
                </div>
                <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tanggal Masa Berlaku
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @isset($selected->tgl_masa_berlaku)
                            {{ Carbon\Carbon::parse($selected->tgl_masa_berlaku)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        @endisset
                    </dd>
                </div>
                <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Foto Brand
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @php
                            $images = json_decode($selected->foto_brand);
                        @endphp
                        <div class="flex flex-col gap-4 md:flex-wrap md:flex-row">
                            @foreach ($images as $image)
                                <img src="{{ asset('storage/foto_brand/' . $selected->plant->perusahaan->nama_perusahaan . '/' . $image) }}"
                                    alt="{{ $selected->nama_brand }}" width="200px" height="200px"
                                    class="p-4 border-2 border-green-400 rounded-md ">
                            @endforeach
                        </div>
                    </dd>
                </div>
            </dl>
        </div>
    @endif
</div>
