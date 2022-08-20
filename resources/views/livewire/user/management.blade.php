@section('title', 'User Management')
<div>
    <div class="flex flex-col justify-between md:flex-row">
        <p class="mb-2 text-3xl font-bold leading-7 text-gray-900">
            User Management
        </p>
        <button wire:click.prevent='$emit("openModal", "user.modal.add-user")'
            class="px-3 py-2 mt-2 text-xs text-white bg-blue-600 rounded-md shadow-md md:mt-0 md:text-sm hover:bg-blue-500">
            Tambah User Baru
        </button>
    </div>

    <div class="p-5 mt-10 overflow-hidden overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-md md:mx-10">
        <div class="grid grid-cols-12 gap-4">
            <div class="flex flex-col col-span-12 md:col-span-4 lg:col-span-6">
                <span class="mb-2 text-xs font-semibold">
                    Cari User :
                </span>
                <input type="text" wire:model="search" placeholder="Cari User ..."
                    class="inset-y-0 right-0 block w-full text-xs border-gray-300 rounded-md shadow-sm md:w-4/5 lg:w-1/2 focus:ring-green-400 focus:border-green-400 sm:text-sm">
            </div>
            <div
                class="grid items-center grid-cols-12 col-span-12 space-y-2 sm:space-x-4 md:col-span-8 lg:col-span-6 sm:space-y-0">
                <div class="flex flex-col col-span-12 sm:col-span-4 md:col-span-4">
                    <span class="mb-2 text-xs font-semibold text-right">
                        Items Per Page :
                    </span>
                    <select wire:model="paginate"
                        class="w-full px-5 text-xs bg-white border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-green-400 focus:border-green-400 md:text-sm">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                    </select>
                </div>
                <div class="flex flex-col col-span-12 sm:col-span-4 md:col-span-4">
                    <span class="mb-2 text-xs font-semibold text-right md:text-left">
                        Role :
                    </span>
                    <select wire:model="role"
                        class="w-full px-5 text-xs bg-white border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-green-400 focus:border-green-400 md:text-sm">
                        <option value="">All Role</option>
                        <option value="client">Client</option>
                        <option value="verifikator">Verifikator</option>
                        <option value="admin">Admin</option>
                        <option value="super-admin">Super Admin</option>
                    </select>
                </div>
                <div class="flex flex-col col-span-12 sm:col-span-4 md:col-span-4">
                    <span class="mb-2 text-xs font-semibold text-right md:text-left">
                        Status :
                    </span>
                    <select wire:model="status"
                        class="w-full px-5 text-xs bg-white border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-green-400 focus:border-green-400 md:text-sm">
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
                        Role
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
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr wire:loading.remove wire:target="previousPage, nextPage, gotoPage" class="text-sm">
                        <td class="px-6 py-4">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-2 py-4 whitespace-nowrap">
                            @if ($user->status == 1)
                                <p class="px-2 py-0 text-xs text-center text-white bg-green-600 rounded-full">
                                    Sudah Diaktivasi
                                </p>
                            @else
                                <p class="px-2 py-0 text-xs text-center text-white bg-red-600 rounded-full">
                                    Belum Diaktivasi
                                </p>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->phone }}
                        </td>
                        @foreach ($user->roles as $role)
                            <td class="px-6 py-4">
                                {{ Str::ucfirst($role->name) }}
                            </td>
                        @endforeach
                        <td class="px-6 py-4">
                            {{ Carbon\Carbon::parse($user->created_at)->locale('id')->diffForHumans() }}
                        </td>
                        <td class="flex justify-center p-4 space-x-4 text-sm font-semibold whitespace-nowrap">
                            <button
                                wire:click.prevent='$emit("openModal", "user.modal.delete-user", {{ json_encode(['user' => $user->id]) }})'
                                class="px-2 py-1 text-xs text-white bg-red-600 rounded-lg hover:bg-red-500">
                                Delete
                            </button>
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
                    <td colspan="7" class="text-center bg-gray-50 p-36">
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
