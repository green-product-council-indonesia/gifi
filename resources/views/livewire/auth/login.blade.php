@section('title', 'Sign in to your account')
<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="{{ route('home') }}">
            <img class="w-auto h-24 mx-auto" src="{{ asset('img/gifi.png') }}" alt="logo-gpci">
            {{-- <x-logo class="w-auto h-16 mx-auto text-green-600" /> --}}
        </a>
        <h2
            class="mt-6 font-serif text-4xl font-extrabold leading-9 tracking-widest text-center text-gray-900 uppercase">
            Client Portal
        </h2>
        <p class="text-sm tracking-wider text-center font-gray-700">Green Infrastructure and Facilities Indonesia</p>
    </div>

    <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <form wire:submit.prevent="authenticate">
                <div>
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                        Email address
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="email" id="email" name="email" type="email" required autofocus
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                        Password
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="password" id="password" type="password" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('password')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center">
                        <input wire:model.lazy="remember" id="remember" type="checkbox"
                            class="w-4 h-4 text-indigo-600 transition duration-150 ease-in-out form-checkbox" />
                        <label for="remember" class="block ml-2 text-xs leading-5 text-gray-900">
                            Remember
                        </label>
                    </div>

                    <div class="text-xs leading-5">
                        <a href="{{ route('password.request') }}"
                            class="font-medium text-green-600 transition duration-150 ease-in-out hover:text-green-500 focus:outline-none focus:underline">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit"
                            class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring-green-500 active:bg-green-700">

                            <div wire:loading.remove wire:target="authenticate">
                                Sign in
                            </div>
                            <div wire:loading wire:target="authenticate">
                                Loading
                            </div>
                        </button>
                    </span>
                </div>
                @error('status')
                    <div class="p-2 my-2 bg-red-100 border border-red-400 rounded-md" wire:poll.keep-alive>
                        <p class="text-xs text-center text-red-600 ">{{ $message }}</p>
                    </div>
                @enderror
                @if (session()->has('message'))
                    @livewire('components.alert-success')
                @endif
                @if (Route::has('register'))
                    <p class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">

                        <a href="{{ route('register') }}"
                            class="font-medium text-green-600 transition duration-150 ease-in-out hover:text-green-500 focus:outline-none focus:underline">
                            Pendaftaran Sertifikasi
                        </a>
                    </p>
                @endif
            </form>
        </div>
        {{-- <p class="mt-2 text-sm leading-5 text-right text-gray-600 max-w">
            <button wire:click="download"
                class="text-blue-600 font-semibold transition duration-150 ease-in-out hover:text-blue-400 focus:outline-none focus:underline">
                Pedoman Sertifikasi
            </button>
        </p> --}}
    </div>

    <div class="fixed bottom-0 right-0 m-4">
        <a href="https://wa.me/send/?phone=6281212937770" target="_blank"
            class="flex items-center px-3 py-2 space-x-2 bg-white border-2 border-green-500 rounded-full shadow-lg hover:bg-green-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <p class="text-sm font-semibold">
                Contact Us
            </p>
        </a>
    </div>
</div>
