@section('title', 'Assign Verifikator')
<div>
    <div class="flex flex-col justify-between md:flex-row">
        <p class="mb-2 text-3xl font-bold leading-7 text-gray-900">
            Assign Verifikator
        </p>
        <button wire:click.prevent='$emit("openModal", "penilaian.modal.modal-assign")'
            class="px-3 py-2 mt-2 text-xs text-white bg-blue-600 rounded-md shadow-md md:mt-0 md:text-sm hover:bg-blue-500">
            Penugasan Sertifikasi
        </button>
    </div>

    <div class="grid grid-cols-12 gap-4 mt-6">
        <div class="flex flex-col col-span-12 col lg:col-span-8 sm:col-span-6">
            <span class="mb-2 text-xs font-semibold">
                Search :
            </span>
            <input type="text" wire:model="search" placeholder="Search..."
                class="inset-y-0 right-0 block w-full text-xs border-gray-300 rounded-md shadow-sm md:w-3/4 lg:w-1/2 focus:ring-green-400 focus:border-green-400">
        </div>
        <div class="grid grid-cols-12 col-span-12 space-x-4 sm:col-span-6 lg:col-span-4">
            <div class="flex flex-col col-span-6">
                <span class="mb-2 text-xs font-semibold md:text-right">
                    Items Per Page :
                </span>
                <select wire:model="paginate"
                    class="w-full px-5 text-xs bg-white border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-green-400 focus:border-green-400">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                </select>
            </div>
            <div class="flex flex-col col-span-6">
                <span class="mb-2 text-xs font-semibold md:text-right">
                    Status Sertifikasi :
                </span>
                <select wire:model="status"
                    class="w-full px-5 text-xs bg-white border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-green-400 focus:border-green-400">
                    <option value="">Status Brand</option>
                    <option value="1">Belum Disertifikasi</option>
                    <option value="2">Sedang Disertifikasi</option>
                    <option value="3">Sudah Tersertifikasi</option>
                </select>
            </div>
        </div>
    </div>
    <div class="mt-4 overflow-hidden overflow-x-auto border border-gray-200 rounded-md shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-green-200">
                <tr>
                    <th scope="col"
                        class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        <div class="flex justify-between">
                            Nama Ruas
                        </div>

                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        Nama Badan Usaha Jalan Tol
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        Verifikator
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        <span>Status</span>
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        <span>Jenis Sertifikasi</span>
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        <span>Tahun Sertifikasi</span>
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm bg-white divide-y divide-gray-200">
                @forelse ($data as $item)
                    <tr wire:loading.remove wire:target="previousPage, nextPage, gotoPage">
                        <td class="px-6 py-3 text-xs font-semibold">
                            {{ $item->nama_ruas }}
                        </td>
                        <td class="px-6 py-3 text-xs font-semibold">
                            {{ $item->nama_bujt }}
                        </td>
                        <td class="px-6 py-3 text-xs font-semibold">
                            {{ $item->verifikator }}
                        </td>
                        <td class="px-2 py-3 text-xs text-center whitespace-nowrap">
                            @switch($item->status)
                                @case(1)
                                    <span class="px-2 py-0 text-xs text-white bg-red-500 rounded-lg">Belum
                                        disertifikasi</span>
                                @break

                                @case(2)
                                    <span class="px-2 py-0 text-xs text-white bg-yellow-500 rounded-lg">Sedang
                                        disertifikasi</span>
                                @break

                                @case(3)
                                    <span class="px-2 py-0 text-xs text-white bg-green-500 rounded-lg">Sudah
                                        Disertifikasi</span>
                                @break

                                @default
                            @endswitch
                        </td>
                        <td class="px-6 py-3 text-xs font-semibold text-center">
                            @switch($item->category_id)
                                @case(1)
                                    <span class="px-2 py-0 text-xs text-white bg-blue-500 rounded-lg">New</span>
                                @break

                                @case(2)
                                    <span class="px-2 py-0 text-xs text-white bg-indigo-500 rounded-lg">Existing</span>
                                @break

                                @default
                            @endswitch
                        </td>
                        <td class="px-6 py-3 text-xs font-semibold text-center whitespace-nowrap">
                            {{ Carbon\Carbon::parse($item->tgl_mulai_operasional)->locale('id')->isoFormat('MMMM Y') }}
                        </td>
                        <td class="text-center align-middle">
                            @isset($item->verifikator)
                                <button
                                    wire:click="$emit('openModal', 'penilaian.modal.remove-assignment', {{ json_encode(['id' => $item->id]) }})"
                                    type="button" class="p-1 bg-red-600 rounded-lg hover:bg-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @endisset
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="flex items-center justify-center gap-4 py-20 font-semibold text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-yellow-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-2xl">
                                        Tidak Ada Data
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    <tr wire:loading.class="table-row" wire:loading.remove.class="hidden"
                        wire:target="previousPage, nextPage, gotoPage" class="hidden">
                        <td colspan="8" class="text-center bg-gray-50 p-36">
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
        <div class="mt-4">
            {{ $data->links() }}
        </div>
    </div>
