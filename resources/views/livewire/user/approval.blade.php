@section('title', 'User Approval')
<div>
    <p class="mb-2 text-3xl font-bold leading-7 text-gray-900 ">
        User Approval
    </p>
    @if (session()->has('message'))
        @livewire('components.alert-success')
    @endif
    <div
        class="p-5 mx-1 mt-10 overflow-hidden overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-md sm:mx-10">
        <div class="grid grid-cols-12 gap-4 my-3">
            <div class="flex flex-col col-span-12 lg:col-span-8 sm:col-span-6">
                <span class="mb-2 text-xs font-semibold sm:text-sm">
                    Cari User :
                </span>
                <input type="text" wire:model="search" placeholder="Cari User ..."
                    class="inset-y-0 right-0 block w-full text-xs border-gray-300 rounded-md shadow-sm md:w-3/4 lg:w-1/2 focus:ring-green-400 focus:border-green-400 sm:text-sm">
            </div>
            <div class="grid grid-cols-12 col-span-12 space-x-4 sm:col-span-6 lg:col-span-4">
                <div class="flex flex-col col-span-6">
                    <span class="mb-2 text-xs font-semibold sm:text-sm">
                        Items Per Page :
                    </span>
                    <select wire:model="paginate"
                        class="w-full px-5 text-xs bg-white border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-green-400 focus:border-green-400 sm:text-sm">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                    </select>
                </div>
                <div class="flex flex-col col-span-6">
                    <span class="mb-2 text-xs font-semibold sm:text-sm">
                        Status :
                    </span>
                    <select wire:model="status"
                        class="w-full px-5 text-xs bg-white border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-green-400 focus:border-green-400 sm:text-sm">
                        <option value="">Status User</option>
                        <option value="0">Belum Disetujui</option>
                        <option value="1">Sudah Disetujui</option>
                    </select>
                </div>
            </div>
        </div>
        <table class="min-w-full mt-5 border border-gray-200 divide-y divide-gray-200 shadow-lg">
            <thead class="bg-green-200">
                <tr>
                    <th scope="col"
                        class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        Nama User
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        Email
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        Status
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        Contact
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-800 uppercase border-r border-gray-100">
                        Tgl Mendaftar
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm bg-white divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr wire:loading.remove wire:target="previousPage, nextPage, gotoPage">
                        <td class="px-6 py-4">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($user->status == 1)
                                <span class="px-2 text-xs text-white bg-green-600 rounded-full">
                                    Sudah Diaktivasi
                                </span>
                            @else
                                <span class="px-2 text-xs text-white bg-red-600 rounded-full">
                                    Belum Diaktivasi
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->phone }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Carbon\Carbon::parse($user->created_at)->locale('id')->diffForHumans() }}
                        </td>
                        <td class="flex justify-center py-4 space-x-4 text-sm font-semibold whitespace-nowrap">
                            @if ($user->status !== 1)
                                <button
                                    wire:click.prevent='$emit("openModal", "user.modal.approve-user", {{ json_encode(['user' => $user->id]) }})'
                                    class="px-2 py-1 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-500">
                                    Approve
                                </button>
                                {{-- <button class="px-2 py-1 text-sm text-white bg-red-600 rounded-lg hover:bg-red-500">
                                    Reject
                                </button> --}}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
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
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
