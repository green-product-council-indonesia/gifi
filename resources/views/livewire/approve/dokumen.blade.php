@section('title', 'Dokumen Sertifikasi GLI')
<div>
    <p class="mb-2 text-3xl font-bold leading-7 text-gray-900 ">
        @hasrole('visitor')
            Dokumen Sertifikasi GLI
        @else
            Approve Dokumen Sertifikasi
        @endhasrole
    </p>
    <hr>
    {{-- The whole world belongs to you. --}}
    <div class="grid grid-cols-12 gap-4 mt-4">
        <div class="flex flex-col col-span-12 sm:col-span-4">
            <label class="mb-2 text-xs font-semibold sm:text-sm">Perusahaan</label>
            <select wire:model="selectedCompany"
                class="w-full px-5 mt-2 text-xs bg-white border border-gray-300 rounded-md shadow-sm appearance-none md:w-10/12 focus:outline-none focus:ring-green-400 focus:border-green-400 sm:text-sm">
                <option value="">Select Perusahaan</option>
                @foreach ($perusahaan as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_perusahaan }}</option>
                @endforeach
            </select>
        </div>
        @if (!is_null($selectedCompany))
            <div class="flex flex-col col-span-12 sm:col-span-4">
                <label class="mb-2 text-xs font-semibold sm:text-sm">Plant</label>
                <select wire:model="selectedPlant"
                    class="w-full px-5 mt-2 text-xs bg-white border border-gray-300 rounded-md shadow-sm appearance-none md:w-10/12 focus:outline-none focus:ring-green-400 focus:border-green-400 sm:text-sm">
                    <option value="">Select Plant</option>
                    @foreach ($plant as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_plant }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        @if (!is_null($selectedPlant))
            <div class="flex flex-col col-span-12 sm:col-span-4">
                <label class="mb-2 text-xs font-semibold sm:text-sm">Brand</label>
                <select wire:model="selectedBrand"
                    class="w-full px-5 mt-2 text-xs bg-white border border-gray-300 rounded-md shadow-sm appearance-none md:w-10/12 focus:outline-none focus:ring-green-400 focus:border-green-400 sm:text-sm">
                    <option value="">Select Brand</option>
                    @foreach ($brand as $item)
                        <option value="{{ $item->id }}">
                            ({{ Carbon\Carbon::parse($item->tgl_pendaftaran)->isoFormat('Y') }})
                            {{ $item->nama_brand }} -
                            {{ $item->jenis_sertifikasi === 1 ? 'Pengajuan Baru' : 'Renewal' }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
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
                        Catatan
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm bg-white divide-y divide-gray-200">
                @if (!is_null($selectedBrand))
                    @foreach ($document->document as $item)
                        <tr wire:loading.remove wire:target="previousPage, nextPage, gotoPage">
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
                            <td class="px-6 py-4 font-semibold">
                                {{ $item->pivot->keterangan }}
                            </td>
                            <td class="px-2 py-4 space-y-2 font-semibold">
                                @if (!is_null($item->pivot->nama_dokumen))
                                    <a href="{{ asset('storage/checklist-dokumen/' . $document->plant->perusahaan->nama_perusahaan . '/' . $item->pivot->nama_dokumen) }}"
                                        target="_blank"
                                        class="px-2 py-1 text-xs text-white bg-yellow-500 rounded-md shadow-lg hover:bg-yellow-600">
                                        Preview
                                    </a>
                                @endif
                                @hasanyrole('verifikator|super-admin')
                                    @if ($item->pivot->status !== 2)
                                        @if (!is_null($item->pivot->nama_dokumen))
                                            <button
                                                wire:click="$emit('openModal', 'approve.modal.modal-approve', {{ json_encode(['id' => $item->id, 'selectedBrand' => $selectedBrand]) }})"
                                                class="px-2 py-1 text-xs text-white bg-blue-600 rounded-md shadow-lg hover:bg-blue-700">
                                                Approve Dokumen
                                            </button>
                                        @endif
                                    @endif
                                    @if (is_null($item->pivot->keterangan))
                                        <button
                                            wire:click="$emit('openModal', 'approve.modal.tambah-catatan', {{ json_encode(['id' => $item->id, 'selectedBrand' => $selectedBrand]) }})"
                                            class="px-2 py-1 text-xs text-white bg-green-600 rounded-md shadow-lg hover:bg-green-700">
                                            Tambah Catatan
                                        </button>
                                    @else
                                        <button
                                            wire:click="$emit('openModal', 'approve.modal.edit-catatan', {{ json_encode(['id' => $item->id, 'selectedBrand' => $selectedBrand, 'data' => $item->pivot->keterangan]) }})"
                                            class="px-2 py-1 text-xs text-white bg-green-600 rounded-md shadow-lg hover:bg-green-700">
                                            Edit Catatan
                                        </button>
                                    @endif
                                @endhasanyrole
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">
                            <div class="flex items-center justify-center gap-4 py-20 font-semibold text-center">
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
                    <td colspan="5" class="text-center bg-gray-50 p-36">
                        <div class="flex justify-center">
                            {{-- Loading --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-green-500 animate-spin"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    {{-- <div class="mt-4">
        {{ $brand->links() }}
    </div> --}}
</div>
