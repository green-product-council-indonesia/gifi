<div>
    <p class="mb-2 text-3xl font-bold leading-7 text-gray-900 ">
        Master Data
    </p>
    <hr>

    <div class="flex flex-col items-center justify-end mt-4 sm:flex-row">
        <div class="flex flex-col mt-4 sm:mt-0">
            <button wire:click="$emit('openModal', 'import.modal.tambah-bobot')"
                class="flex items-center gap-2 px-3 py-2 text-xs text-white bg-green-600 rounded-md shadow hover:bg-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Tambah Total Bobot
            </button>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-4">

        @foreach ($category as $data)
            <div class="col-span-12 md:col-span-6">
                <div class="p-6 mt-5 bg-white border-2 border-green-200 rounded-lg shadow-lg">
                    <p class="text-xl font-semibold">
                        {{ $data->nama_kategori }}
                    </p>
                    <hr>

                    <div class="mt-4 overflow-hidden overflow-x-auto border border-gray-200 rounded-md shadow-md">
                        <table class="min-w-full divide-y divide-gray-200 md:table-fixed">
                            <thead class="bg-green-200">
                                <tr>
                                    <th scope="col"
                                        class="w-2/5 px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                                        Nama Kategori Dokumen
                                    </th>
                                    <th scope="col"
                                        class="w-1/5 px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                                        Total Bobot
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sum = 0;
                                @endphp
                                @foreach ($data->kategoriDokumen as $doc)
                                    <tr>
                                        <td class="px-6 py-4 text-xs">{{ $doc->nama_kategori_dokumen }}</td>
                                        <td class="px-6 py-4 text-xs">{{ $doc->pivot->total_bobot }} </td>
                                    </tr>
                                    @php
                                        $sum += $doc->pivot->total_bobot;
                                    @endphp
                                @endforeach
                                <tr>
                                    <td class="px-6 py-4 text-sm font-semibold">Total</td>
                                    <td class="px-6 py-4 text-xs font-semibold">{{ $sum }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
