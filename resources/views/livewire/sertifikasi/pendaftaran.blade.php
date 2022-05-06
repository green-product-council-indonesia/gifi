@section('title', 'Pendaftaran Sertifikasi')
<div class="flex flex-col justify-center min-h-screen sm:px-6 lg:px-8">
    <div class="relative">
        <x-spinner class="absolute top-0 right-0 w-8 animate-spin" wire:loading wire:target="submit"></x-spinner>
    </div>
    <div class="mb-10 space-y-6">
        <div class="p-6 mx-1 mt-10 bg-white border-2 border-green-200 rounded-lg shadow-lg md:mx-10">
            <ul class="grid grid-cols-1 sm:grid-cols-2">
                <li class="col-span-1">
                    <div class="flex flex-col items-center justify-center">
                        <p
                            class="flex items-center justify-center w-12 h-12 mb-3 text-xl rounded-full  hover:bg-red-200 focus:ring-4 {{ $currentStep != 1 ? 'bg-green-200' : 'bg-red-200 ring ring-red-400' }}">
                            1
                        </p>
                        <p class="text-sm text-center title">Registrasi</p>
                    </div>
                </li>
                <li class="col-span-1">
                    <div class="flex flex-col items-center justify-center mt-4 md:mt-0">
                        <p
                            class="flex items-center justify-center w-12 h-12 mb-3 text-xl rounded-full hover:bg-red-200 focus:ring-4 {{ $currentStep != 2 ? 'bg-green-200' : 'bg-red-200 ring ring-red-400' }}">
                            2
                        </p>
                        <p class="text-sm text-center title">Submission</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="p-6 mx-1 bg-white border-2 border-green-200 rounded-lg shadow-lg md:mx-10">
            @if ($currentStep == 1)
                <div>
                    <span class="text-2xl font-medium tracking-wide">Form Registrasi</span>
                    <div class="grid grid-cols-12 gap-4 my-4 ">
                        <!-- Nama Badan Usaha Jalan Tol -->
                        <div class="col-span-12 sm:col-span-6">
                            <label class="label">Nama Badan Usaha Jalan Tol</label>
                            <input type="text" placeholder="Nama Badan Usaha Jalan Tol" class="form-input"
                                wire:model="nama_bujt">
                            @error('nama_bujt')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Operasional -->
                        <div class="col-span-12 md:col-span-6">
                            <label class="label">Email Operasional</label>
                            <input type="text" placeholder="Email Operasional" class="form-input"
                                wire:model="email_operasional">
                            @error('email_operasional')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="col-span-12 sm:col-span-6">
                            <label class="label">Alamat Operasional</label>
                            <textarea rows="4" class="block w-full px-2 py-3 mt-1 border border-gray-300 rounded-md shadow focus:ring-green-300 focus:ring-2 focus:border-green-200 focus:outline-none sm:text-sm"
                                placeholder="Alamat Operasional" wire:model="alamat_operasional"></textarea>
                            @error('alamat_operasional')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-6 col-span-12 gap-4 sm:col-span-6">
                            <!-- Kode Pos -->
                            <div class="col-span-12 sm:col-span-6 md:col-span-3">
                                <label class="label">Kode Pos</label>
                                <input type="text" placeholder="Kode Pos" class="form-input"
                                    wire:model="kodePos_operasional">
                                @error('kodePos_operasional')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- No Telp -->
                            <div class="col-span-12 sm:col-span-6 md:col-span-3">
                                <label class="label">No Telp</label>
                                <input type="text" placeholder="No. Telp" class="form-input"
                                    wire:model="noTelp_operasional">
                                @error('noTelp_operasional')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Jenis Sertifikasi -->
                            <div class="col-span-12 sm:col-span-6 md:col-span-3">
                                <label for="category_id" class="label">Jenis Sertifikasi</label>
                                <select id="category_id" name="category_id" class="form-input"
                                    wire:model="category_id">
                                    <option value="" selected>Jenis Sertifikasi ... </option>
                                    <option value="1">New</option>
                                    <option value="2">Existing</option>
                                </select>
                                @error('category_id')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Tipe Sertifikasi -->
                            <div class="col-span-12 sm:col-span-6 md:col-span-3">
                                <label class="label">Tipe Pengajuan</label>
                                <select id="tipe_sertifikasi" name="tipe_sertifikasi" class="form-input"
                                    wire:model="tipe_sertifikasi">
                                    <option value="" selected>Tipe Pengajuan Sertifikasi ... </option>
                                    <option value="1">Pengajuan Baru</option>
                                    <option value="2">Perpanjangan</option>
                                </select>
                                @error('tipe_sertifikasi')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Nama Ruas Jalan Tol --}}
                        <div class="col-span-12 sm:col-span-6 md:col-span-6">
                            <label class="label">Nama Ruas Jalan Tol</label>
                            <input type="text" placeholder="Nama Ruas Jalan Tol" class="form-input"
                                wire:model="nama_ruas">
                            @error('nama_ruas')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Panjang Ruas Jalan Tol --}}
                        <div class="col-span-12 sm:col-span-6 md:col-span-3">
                            <label class="label">Panjang Ruas Jalan Tol</label>
                            <input type="text" placeholder="Panjang Ruas Jalan Tol" class="form-input"
                                wire:model="panjang_ruas">
                            @error('panjang_ruas')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tgl Mulai Operasional -->
                        <div class="col-span-12 sm:col-span-6 md:col-span-3">
                            <label for="date" class="label">Tgl Mulai Operasional</label>
                            <input type="date" wire:model="tgl_mulai_operasional" class="form-input">
                            @error('tgl_mulai_operasional')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Jumlah Rest Area --}}
                        <div class="col-span-12 sm:col-span-6 md:col-span-3">
                            <label class="label">Jumlah Rest Area</label>
                            <input type="text" placeholder="Jumlah Rest Area" class="form-input"
                                wire:model="jumlah_rest_area">
                            @error('jumlah_rest_area')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- Jumlah Gerbang Tol --}}
                        <div class="col-span-12 sm:col-span-6 md:col-span-3">
                            <label class="label">Jumlah Gerbang Tol</label>
                            <input type="text" placeholder="Jumlah Gerbang Tol" class="form-input"
                                wire:model="jumlah_gerbang_tol">
                            @error('jumlah_gerbang_tol')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-12">
                            <span class="text-lg font-medium">Contact Person:</span>
                        </div>

                        <div class="col-span-12 sm:col-span-6 md:col-span-3">
                            <!-- Nama -->
                            <label class="label">Nama</label>
                            <input type="text" placeholder="Nama" class="form-input" wire:model="nama">
                            @error('nama')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-12 sm:col-span-6 md:col-span-3">
                            <!-- Jabatan -->
                            <label class="label">Jabatan</label>
                            <input type="text" placeholder="Jabatan" class="form-input" wire:model="jabatan">
                            @error('jabatan')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6 md:col-span-3">
                            <!-- No. Handphone / WA -->
                            <label class="label">No. Handphone / WA</label>
                            <input type="text" placeholder="No. Handphone / WA" class="form-input"
                                wire:model="no_hp">
                            @error('no_hp')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6 md:col-span-3">
                            <!-- Email -->
                            <label class="label">Email</label>
                            <input type="text" placeholder="Email" class="form-input" wire:model="email">
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- Contact Person 2 --}}
                        <div class="col-span-12 sm:col-span-6 md:col-span-3">
                            <!-- Nama -->
                            <label class="label">Nama</label>
                            <input type="text" placeholder="Nama" class="form-input" wire:model="nama2">
                            @error('nama2')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-12 sm:col-span-6 md:col-span-3">
                            <!-- Jabatan -->
                            <label class="label">Jabatan</label>
                            <input type="text" placeholder="Jabatan" class="form-input" wire:model="jabatan2">
                            @error('jabatan2')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6 md:col-span-3">
                            <!-- No. Handphone / WA -->
                            <label class="label">No. Handphone / WA</label>
                            <input type="text" placeholder="No. Handphone / WA" class="form-input"
                                wire:model="no_hp2">
                            @error('no_hp2')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6 md:col-span-3">
                            <!-- Email -->
                            <label class="label">Email</label>
                            <input type="text" placeholder="Email" class="form-input" wire:model="email2">
                            @error('email2')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-12 mt-6">
                        <div class="flex justify-end">
                            <button
                                class="flex items-center justify-between px-4 py-2 text-white bg-green-500 rounded-md shadow hover:bg-green-400"
                                wire:click.prevent="firstStep" x-on:click="scrollTo({top: 0, behavior: 'smooth'})">
                                Next
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            @elseif($currentStep == 2)
                <div>
                    <span class="text-2xl font-medium tracking-wide">Summary</span>
                    <div class="grid grid-cols-12 gap-4 my-4">
                        <div class="col-span-12">
                            <div class="brand">
                                <div class="px-4 py-5 md:px-6">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        Ringkasan Form
                                    </h3>
                                </div>
                                <div class="border-t border-gray-200 ">
                                    <dl>
                                        <div class="px-4 py-5 bg-gray-50 md:grid md:grid-cols-3 md:gap-4 md:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Nama Badan Usaha Jalan Tol
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                                                {{ $nama_bujt }}
                                            </dd>
                                        </div>
                                        <div class="px-4 py-5 bg-white md:grid md:grid-cols-3 md:gap-4 md:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Alamat Operasinal
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                                                {{ $alamat_operasional }}
                                            </dd>
                                        </div>
                                        <div class="px-4 py-5 bg-gray-50 md:grid md:grid-cols-3 md:gap-4 md:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Email Operasional
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                                                {{ $email_operasional }}
                                            </dd>
                                        </div>
                                        <div class="px-4 py-5 bg-white md:grid md:grid-cols-3 md:gap-4 md:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                No Telp
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                                                {{ $noTelp_operasional }}
                                            </dd>
                                        </div>
                                        <div class="px-4 py-5 bg-gray-50 md:grid md:grid-cols-3 md:gap-4 md:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Kode Pos
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                                                {{ $kodePos_operasional }}
                                            </dd>
                                        </div>
                                        <div class="px-4 py-5 bg-white md:grid md:grid-cols-3 md:gap-4 md:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Nama Ruas Jalan Tol
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                                                {{ $nama_ruas }}
                                            </dd>
                                        </div>
                                        <div class="px-4 py-5 bg-gray-50 md:grid md:grid-cols-3 md:gap-4 md:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Panjang Ruas Jalan Tol
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                                                {{ $panjang_ruas }}
                                            </dd>
                                        </div>
                                        <div class="px-4 py-5 bg-white md:grid md:grid-cols-3 md:gap-4 md:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Tgl Mulai Operasional
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                                                {{ $tgl_mulai_operasional }}
                                            </dd>
                                        </div>
                                        <div class="px-4 py-5 bg-white md:grid md:grid-cols-3 md:gap-4 md:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Jenis Sertifikasi
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                                                {{ $category_id }}
                                            </dd>
                                        </div>
                                        <div class="px-4 py-5 bg-white md:grid md:grid-cols-3 md:gap-4 md:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Tipe Sertifikasi
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                                                {{ $tipe_sertifikasi }}
                                            </dd>
                                        </div>
                                        <div class="px-4 py-5 bg-white md:grid md:grid-cols-3 md:gap-4 md:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Jumlah Gerbang Tol
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                                                {{ $jumlah_gerbang_tol }}
                                            </dd>
                                        </div>
                                        <div class="px-4 py-5 bg-white md:grid md:grid-cols-3 md:gap-4 md:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Jumlah Rest Area
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 md:mt-0 md:col-span-2">
                                                {{ $jumlah_rest_area }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-span-12 mt-6">
                        <div class="flex justify-between">
                            <button
                                class="flex items-center justify-between px-4 py-2 text-white bg-blue-500 rounded-md shadow hover:bg-blue-400"
                                wire:click.prevent="prevStep" x-on:click="scrollTo({top: 0, behavior: 'smooth'})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back
                            </button>
                            <button class="px-4 py-2 text-white bg-green-500 rounded-md shadow hover:bg-green-400"
                                wire:loading.attr="disabled" wire:loading.class="bg-green-200"
                                x-on:click="scrollTo({top: 0, behavior: 'smooth'})"
                                wire:loading.class.remove="hover:bg-green-400 bg-green-500" wire:click="submit">
                                <div wire:loading>
                                    Loading...
                                </div>
                                <div wire:loading.remove>
                                    Submit
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
