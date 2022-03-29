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
    <div class="p-4 mt-4 bg-white border border-green-200 rounded-md shadow-md"
        x-data="{openTab: 1, active: 'bg-blue-600 shadow-md hover:bg-blue-800', inactive: 'bg-transparent', teks:'Informasi'}">
        <div id="tabs"
            class="flex flex-col w-full px-4 py-4 border border-green-300 rounded-md shadow-md sm:space-x-4 sm:flex-row">
            <div :class="openTab === 1 ? active : inactive" class="px-4 py-2 text-gray-800 rounded-md ">
                <button @click="openTab = 1"
                    :class="openTab === 1 ? 'font-semibold text-white' : 'hover:text-blue-800'">Perusahaan</button>
            </div>
            <div :class="openTab === 2 ? active : inactive" class="px-4 py-2 text-gray-800 rounded-md">
                <button @click="openTab = 2"
                    :class="openTab === 2 ? 'font-semibold text-white' : 'hover:text-blue-800'">Plant</button>
            </div>
            <div :class="openTab === 3 ? active : inactive" class="px-4 py-2 text-gray-800 rounded-md">
                <button @click="openTab = 3"
                    :class="openTab === 3 ? 'font-semibold text-white' : 'hover:text-blue-800'">
                    Brand
                </button>
            </div>
        </div>

        @if ($perusahaan)
            <div id="tab-contents" class="mt-4">
                <div x-show="openTab === 1" class="p-4">

                    @livewire('sertifikasi.detail.perusahaan', ['perusahaan' => $perusahaan])
                </div>
                <div x-show="openTab === 2" class="p-4">
                    @livewire('sertifikasi.detail.plant', ['plant' => $perusahaan->plant])
                </div>
                <div x-show="openTab === 3" class="p-4">
                    @livewire('sertifikasi.detail.brand', ['brand' => $perusahaan->plant])
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
