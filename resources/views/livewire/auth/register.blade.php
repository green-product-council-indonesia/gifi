@section('title', 'Registration')

<div>
    <div class="grid grid-cols-12 gap-4 md:place-items-stretch ">
        <div class="col-span-12 md:col-span-7 md:place-self-center">
            <div class="mx-auto sm:w-full sm:max-w-md">
                <a href="{{ route('home') }}">
                    <img class="w-auto h-24 mx-auto md:h-48" src="{{ asset('img/gpci.png') }}" alt="logo-gpci">
                </a>

                <h2 class="mt-6 font-serif text-4xl font-extrabold leading-9 text-center text-gray-900 uppercase">
                    Registration
                </h2>
                <p class="text-sm tracking-wider text-center font-gray-700">Green Product Council Indonesia</p>
            </div>
        </div>
        <div class="col-span-12 md:col-span-5">
            <div class="w-full max-w-md mx-auto">
                <div class="px-4 py-8 bg-white rounded-lg shadow sm:px-8">
                    <form wire:submit.prevent="register">
                        <div>
                            <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                                Nama Perusahaan
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.lazy="name" id="name" type="text" required autofocus
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                                Email address
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.lazy="email" id="email" type="email" required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                                No. Telp / Whatsapp
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.lazy="no_telp" id="name" type="text" required autofocus
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('name')
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
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="password_confirmation"
                                class="block text-sm font-medium leading-5 text-gray-700">
                                Confirm Password
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.lazy="passwordConfirmation" id="password_confirmation" type="password"
                                    required
                                    class="block w-full px-3 py-2 placeholder-gray-400 transition duration-150 ease-in-out border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-green-500 focus:border-green-300 sm:text-sm sm:leading-5" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <span class="block w-full rounded-md shadow-sm">
                                <button type="submit"
                                    class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring-indigo active:bg-green-700">
                                    Register
                                </button>
                            </span>
                        </div>
                        <p class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">
                            atau
                            <a href="{{ route('login') }}"
                                class="font-medium text-green-600 transition duration-150 ease-in-out hover:text-green-500 focus:outline-none focus:underline">
                                Login Disini
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed bottom-0 left-0 m-4">
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
