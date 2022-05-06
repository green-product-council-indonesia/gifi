@section('title', 'Data Sertifikasi')
<div>
    <p class="mb-2 text-3xl font-bold leading-7 text-gray-900 ">
        Data Sertifikasi
    </p>
    @if (session()->has('message'))
        @livewire('components.alert-success')
    @endif
    @if (session()->has('error'))
        @livewire('components.alert-error')
    @endif
    <div class="p-4 mt-4 bg-white border border-green-200 rounded-md shadow-md" x-data="{ openTab: 1, active: 'bg-blue-600 shadow-md hover:bg-blue-800', inactive: 'bg-transparent', teks: 'Informasi' }">
        <div id="tabs"
            class="flex flex-col w-full px-4 py-4 border border-green-300 rounded-md shadow-md sm:space-x-4 sm:flex-row">
            <div :class="openTab === 1 ? active : inactive" class="px-4 py-2 text-xs text-gray-800 rounded-md ">
                <button @click="openTab = 1"
                    :class="openTab === 1 ? 'font-semibold text-white' : 'hover:text-blue-800'">Informasi Umum</button>
            </div>
            <div :class="openTab === 2 ? active : inactive" class="px-4 py-2 text-xs text-gray-800 rounded-md">
                <button @click="openTab = 2"
                    :class="openTab === 2 ? 'font-semibold text-white' : 'hover:text-blue-800'">
                    Informasi Sertifikasi
                </button>
            </div>
            <div :class="openTab === 3 ? active : inactive" class="px-4 py-2 text-xs text-gray-800 rounded-md">
                <button @click="openTab = 3"
                    :class="openTab === 3 ? 'font-semibold text-white' : 'hover:text-blue-800'">
                    Contact
                </button>
            </div>
        </div>

        @if ($data)
            <div id="tab-contents" class="mt-4">
                <div x-show="openTab === 1" class="p-4">
                    <dl>
                        <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Nama Badan Usaha Jalan Tol
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $data->nama_bujt }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Alamat Operasional
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $data->alamat_operasional }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Email
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $data->email_operasional }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                No Telp.
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $data->noTelp_operasional }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Kodepos
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $data->kodePos_operasional }}
                            </dd>
                        </div>
                    </dl>
                </div>
                <div x-show="openTab === 2" class="p-4">
                    <dl>
                        <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Nama Ruas Jalan Tol
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $data->nama_ruas }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Panjang Ruas
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $data->panjang_ruas }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Tanggal Mulai Operasional
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ Carbon\Carbon::parse($data->tgl_mulai_operasional)->locale('id')->isoFormat('DD MMMM Y') }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Kategori Sertifikasi
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $data->kategoriSertifikasi->nama_kategori }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Jumlah Rest Area
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $data->jumlah_rest_area }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Jumlah Gerbang Tol
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $data->jumlah_gerbang_tol }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Status Sertifikasi
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $data->status }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Tipe Sertifikasi
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $data->kategoriSertifikasi->tipe_sertifikasi }}
                            </dd>
                        </div>
                    </dl>
                </div>
                <div x-show="openTab === 3" class="p-4">
                    <dl>
                        <span class="py-4 text-sm font-semibold text-gray-900">Contact</span>
                        @php
                            $contact = json_decode($data->contact);
                        @endphp
                        <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Nama
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $contact->cp_1->nama }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Jabatan
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $contact->cp_1->jabatan }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Email
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $contact->cp_1->email }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                No. HP
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $contact->cp_1->no_hp }}
                            </dd>
                        </div>
                        @if ($contact->cp_2->nama2)
                            <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Nama
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $contact->cp_2->nama2 }}
                                </dd>
                            </div>
                            <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Jabatan
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $contact->cp_2->jabatan2 }}
                                </dd>
                            </div>
                            <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Email
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $contact->cp_2->email2 }}
                                </dd>
                            </div>
                            <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    No. HP
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $contact->cp_2->no_hp2 }}
                                </dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center gap-4 py-20 mt-4 md:py-32 md:flex-row">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-yellow-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <p class="text-2xl font-semibold">Tidak Ada Data</p>
            </div>
        @endif
    </div>


</div>
