@section('title', 'Account')
<div>
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 md:col-span-6">
            <div class="bg-white rounded-md shadow-lg">
                <div class="flex items-center justify-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-green-600 w-36" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="pb-4 details">
                    <p class="text-3xl font-bold tracking-wide text-center text-black capitalize">{{ $user->name }}</p>
                    <p class="text-sm tracking-widest text-center text-gray-600">{{ $user->email }}</p>
                    @foreach ($user->roles as $role)
                        @if ($role->name !== 'client')
                            <p class="text-xs text-center text-gray-600 ">{{ $role->name }}</p>
                        @endif
                    @endforeach
                </div>
                <div class="">
                    <dl>
                        <div class="px-4 py-5 bg-green-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Full name
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $user->name }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Email
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $user->email }}
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-green-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Phone Number
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                @if ($user->phone)
                                    {{ $user->phone }}
                                @else
                                    -
                                @endif
                            </dd>
                        </div>
                        <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Registration Date
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ \Carbon\Carbon::parse($user->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-span-12 space-y-4 md:col-span-6">
            <div class="flex justify-end mb-4">
                <button type="button"
                    wire:click="$emit('openModal', 'account.modal.change-password', {{ json_encode(['user' => $user->id]) }})"
                    class="px-3 py-2 text-sm text-white bg-green-600 rounded-md hover:bg-green-700">Ubah
                    Password</button>
            </div>
            @hasanyrole('client')
                @livewire('account.client')
            @endhasanyrole
            @hasanyrole('verifikator')
                @livewire('account.verifikator')
            @endhasanyrole
            @hasanyrole('admin|super-admin')
                @livewire('account.admin')
            @endhasanyrole
        </div>
    </div>
    <div class="absolute bottom-0 right-0 p-2 text-xs text-gray-600">Developed by -</div>
</div>
