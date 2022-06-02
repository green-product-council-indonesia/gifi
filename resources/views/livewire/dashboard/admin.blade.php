<div>
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 p-4 bg-white border-l-4 border-green-500 rounded-md shadow-lg md:col-span-4">
            <div class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-green-500" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                </svg>
                <div>
                    <p class="text-4xl font-bold">{{ count($users) }}</p>
                    <p class="text-xs tracking-wider text-gray-600">
                        User yang belum disetujui
                    </p>
                </div>
            </div>
        </div>
        <div class="col-span-12 p-4 bg-white border-l-4 border-yellow-500 rounded-md shadow-lg md:col-span-4">
            <div class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-yellow-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <div>
                    <p class="text-4xl font-bold">{{ count($data_is_processing) }}</p>
                    <p class="text-xs tracking-wider text-gray-600">
                        Sertifikasi yang sedang dalam Penilaian
                    </p>
                </div>
            </div>
        </div>
        <div class="col-span-12 p-4 bg-white border-l-4 border-blue-500 rounded-md shadow-lg md:col-span-4">
            <div class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-blue-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                <div>
                    <p class="text-4xl font-bold">{{ count($data_is_approved) }}</p>
                    <p class="text-xs tracking-wider text-gray-600">
                        Total Sertifikasi
                    </p>
                </div>
            </div>
        </div>
        <div class="col-span-12 md:col-span-7">
            <div class="p-4 bg-white border-t-4 border-indigo-500 rounded-md shadow-lg">
                <p class="text-xl font-semibold">Konsesi Tersertifikasi</p>
                @forelse ($data_is_approved as $item)
                    @if ($loop->iteration > 5)
                    @break
                @endif
                <div
                    class="grid grid-cols-12 gap-4 p-4 mt-4 border-l-4 border-green-400 rounded-md shadow-lg bg-gray-50">
                    <div class="col-span-12 p-4 bg-gray-200 rounded-lg md:col-span-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-blue-800" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div class="relative col-span-12 p-4 my-auto md:col-span-9">
                        <p class="text-2xl font-bold">
                            {{ $item->nama_ruas }}
                        </p>
                        <p class="mb-4 text-xs font-light tracking-wider text-gray-500">
                            {{ $item->nama_bujt }}
                        </p>
                        <p
                            class="absolute bottom-0 right-0 text-xs font-semibold tracking-wider text-right text-gray-700">
                            {{ \Carbon\Carbon::parse($item->tgl_approve)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        </p>
                    </div>
                </div>
            @empty
                <div
                    class="grid grid-cols-12 gap-4 p-4 mt-4 border-l-4 border-yellow-400 rounded-md shadow-lg bg-gray-50">
                    <div class="col-span-12 p-4 bg-gray-200 rounded-lg md:col-span-3 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-yellow-500"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="col-span-12 my-auto md:col-span-9">
                        <p class="text-2xl font-bold text-center md:text-left">
                            Tidak Ada Data
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="col-span-12 space-y-4 md:col-span-5">
        <div class="p-4 bg-white border-l-4 border-purple-500 rounded-md shadow-lg">
            <div class="justify-between mb-2 space-y-2 md:flex">
                <p class="text-xl font-semibold">Sertifikasi Dalam Penilaian</p>
                <a href="{{ route('approve-sertifikasi') }}"
                    class="float-right px-3 py-1 text-sm tracking-wide text-white bg-indigo-500 rounded-md hover:bg-indigo-600 ">
                    View All
                </a>
            </div>

            @forelse ($data_is_processing as $item)
                @if ($loop->iteration > 3)
                @break
            @endif
            <div class="p-4 mt-4 space-y-2 border-l-4 border-green-400 rounded-lg shadow-lg bg-gray-50">
                <div class="justify-between mb-2 space-y-2 md:flex">
                    <div>
                        <p class="text-2xl font-bold">{{ $item->nama_ruas }}</p>

                    </div>
                    <p class="text-xs text-right text-white md:text-left">
                        <span class="px-1 bg-yellow-500 rounded-lg">
                            dalam penilaian
                        </span>
                    </p>
                </div>
                <p class="text-xs font-light tracking-wider text-gray-700">
                    {{-- {{ Str::limit($item->deskripsi_brand, 100) }} --}}
                </p>
                <p class="text-xs font-light tracking-wider text-gray-700">
                    {{ \Carbon\Carbon::parse($item->tgl_pendaftaran)->locale('id')->diffForHumans() }}
                </p>
            </div>
        @empty
            <div class="p-4 mt-4 border-l-4 border-yellow-400 rounded-lg shadow-lg bg-gray-50">
                <div class="items-center gap-4 space-y-2 md:flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-yellow-500 md:mx-px"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p class="text-2xl font-bold text-center">
                        Tidak Ada Data
                    </p>
                </div>
            </div>
        @endforelse
    </div>
    <div class="p-4 bg-white border-l-4 border-pink-500 rounded-md shadow-lg">
        <div class="justify-between mb-2 space-y-2 md:flex">
            <p class="text-xl font-semibold">Pendaftar Sertifikasi</p>
            @if ($users)
                <a href="{{ route('approve-user') }}"
                    class="float-right px-3 py-1 text-sm tracking-wide text-white bg-indigo-500 rounded-md hover:bg-indigo-600 ">
                    View All
                </a>
            @endif
        </div>

        @forelse ($users as $item)
            @if ($loop->iteration > 3)
            @break
        @endif
        <div class="p-4 mt-4 space-y-2 border-l-4 border-green-400 rounded-lg shadow-lg bg-gray-50">
            <div class="justify-between mb-2 space-y-2 md:flex">
                <div>
                    <p class="text-2xl font-bold">
                        {{ $item->name }}
                    </p>
                </div>
                <p class="text-xs text-right text-white md:text-left">
                    <span class="px-1 bg-yellow-500 rounded-lg">
                        {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->diffForHumans() }}
                    </span>
                </p>
            </div>
            <p class="text-xs font-light tracking-wider text-gray-700">
                {{ $item->email }}
            </p>
            <p class="text-xs font-light tracking-wider text-gray-700">
                {{ $item->phone }}
            </p>
        </div>
    @empty
        <div class="p-4 mt-4 border-l-4 border-yellow-400 rounded-lg shadow-lg bg-gray-50">
            <div class="items-center gap-4 space-y-2 md:flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-yellow-500 md:mx-px"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <p class="text-2xl font-bold text-center">
                    Tidak Ada Data
                </p>
            </div>
        </div>
    @endforelse
</div>
</div>
</div>
</div>
