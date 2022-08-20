<!-- sidebar -->
<div class="fixed inset-y-0 left-0 z-10 px-2 space-y-6 text-blue-100 transition duration-200 ease-in-out transform bg-green-600 divide-y divide-green-300 xl:top-0 xl:min-h-screen w-60 py-7 xl:sticky"
    @click.away="isMobileNavOpen"
    :class="{ '': !isMobileNavOpen, 'xl:translate-x-0 -translate-x-full': isMobileNavOpen }"
    x-transition:enter="transition ease-linear duration-400 transform" x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-out duration-400 transform"
    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
    <div class="px-4 text-white">
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <img class="w-12 bg-white rounded-full" src="{{ asset('img/gtri.png') }}" alt="logo-gtri">
            <span class="text-3xl font-extrabold">GTRI</span>
        </a>
        <p class="mt-2 text-sm">Green Toll Road Indonesia</p>
    </div>
    <nav class="">
        <ul>
            <li>
                <a href=" {{ route('home') }}"
                    class="relative flex flex-row items-center px-4 py-1 my-1 text-sm transition duration-200 rounded-md hover:bg-green-300 hover:text-black {{ request()->is('/') ? 'focus: bg-green-300 text-black' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="pr-3 w-9 h-9" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Home</span>
                </a>
            </li>
            @hasanyrole('client|super-admin|admin')
                <li>
                    <div @click.away="open = false" class="relative" x-data="{ open: false }">
                        <a href="#" @click="open = !open"
                            class="flex flex-row items-center justify-between px-4 py-1 my-1 text-sm text-left transition duration-200 rounded-md hover:bg-green-300 focus:bg-green-300 focus:text-black focus:outline-none focus:shadow-outline {{ request()->route()->getPrefix() == '/sertifikasi'
                                ? 'bg-green-300 text-black'
                                : '' }} ">
                            <div class="flex flex-row items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="pr-3 w-9 h-9" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <span>Sertifikasi</span>
                            </div>
                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <div x-show="open" class="relative right-0 w-full my-2 origin-top-right rounded-md shadow-lg"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95">
                            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">

                                <a class="block px-4 py-2 mt-2 text-sm font-semibold text-green-800 bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ Route::is('data-sertifikasi') ? 'focus: bg-green-200 text-black' : '' }}"
                                    href="{{ route('data-sertifikasi') }}">Data Sertifikasi</a>

                                @hasanyrole('client|super-admin')
                                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-green-800 bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ Route::is('pendaftaran-sertifikasi') ? 'focus: bg-green-200 text-black' : '' }}"
                                        href="{{ route('pendaftaran-sertifikasi') }}">Pendaftaran Sertifikasi</a>

                                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-green-800 bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ Route::is('dokumen-sertifikasi') ? 'focus: bg-green-200 text-black' : '' }}"
                                        href="{{ route('dokumen-sertifikasi') }}">Dokumen Sertifikasi</a>
                                @endhasanyrole
                            </div>
                        </div>
                    </div>
                </li>
            @endhasanyrole
            @hasanyrole('verifikator|admin|super-admin')
                <li>
                    <div @click.away="open = false" class="relative" x-data="{ open: false }">
                        <a href="#" @click="open = !open"
                            class="flex flex-row items-center justify-between px-4 py-1 my-1 text-sm text-left transition duration-200 rounded-md hover:bg-green-300 focus:bg-green-300 focus:text-black focus:outline-none focus:shadow-outline {{ request()->route()->getPrefix() == '/penilaian'
                                ? 'bg-green-300 text-black'
                                : '' }}">
                            <div class="flex flex-row items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="pr-3 w-9 h-9" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                </svg>
                                <span>Penilaian</span>
                            </div>
                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <div x-show="open" class="relative right-0 w-full my-2 origin-top-right rounded-md shadow-lg"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95">
                            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                                @hasanyrole('verifikator|super-admin')
                                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-green-800 bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ Route::is('penilaian-sertifikasi') ? 'focus: bg-green-200 text-black' : '' }}"
                                        href="{{ route('penilaian-sertifikasi') }}">Penilaian Sertifikasi</a>
                                @endhasanyrole

                                @hasanyrole('admin|super-admin')
                                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-green-800 bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ Route::is('assign-verifikator ') ? 'focus: bg-green-200 text-black' : '' }}"
                                        href="{{ route('assign-verifikator') }}">Assign Verifikator</a>
                                @endhasanyrole
                            </div>
                        </div>
                    </div>
                </li>
            @endhasanyrole
            @hasanyrole('super-admin|admin')
                <li>
                    <a href="{{ route('approve-sertifikasi') }}"
                        class="relative flex flex-row items-center px-4 py-1 my-1 text-sm transition duration-200 rounded-md hover:bg-green-300 hover:text-black {{ request()->is('approve-sertifikasi') ? 'focus: bg-green-300 text-black' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="pr-3 w-9 h-9" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Approve Sertifikasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('import-checklist-dokumen') }}"
                        class="relative flex flex-row items-center px-4 py-1 my-1 text-sm transition duration-200 rounded-md hover:bg-green-300 hover:text-black {{ request()->is('import-checklist-dokumen') ? 'focus: bg-green-300 text-black' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="pr-3 w-9 h-9" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Import Checklist Dokumen</span>
                    </a>
                </li>
                <li>
                    <div @click.away="open = false" class="relative" x-data="{ open: false }">
                        <a href="#" @click="open = !open"
                            class="flex flex-row items-center justify-between px-4 py-1 my-1 text-sm text-left transition duration-200 rounded-md hover:bg-green-300 focus:bg-green-300 focus:text-black focus:outline-none focus:shadow-outline {{ request()->route()->getPrefix() == '/user'
                                ? 'bg-green-300 text-black'
                                : '' }}">
                            <div class="flex flex-row items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="pr-3 w-9 h-9" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>User Management</span>
                            </div>
                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <div x-show="open" class="relative right-0 w-full my-2 origin-top-right rounded-md shadow-lg"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95">
                            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                                <a class="block px-4 py-2 mt-2 text-sm font-semibold text-green-800 bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ Route::is('approve-user') ? 'focus: bg-green-200 text-black' : '' }}"
                                    href="{{ route('approve-user') }}">Approve User</a>
                                @hasrole('super-admin')
                                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-green-800 bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ Route::is('manage-user') ? 'focus: bg-green-200 text-black' : '' }}"
                                        href="{{ route('manage-user') }}">Manage User</a>
                                @endhasrole
                            </div>
                        </div>
                    </div>
                </li>
            @endhasanyrole
            @hasrole('visitor')
                <li>
                    <div @click.away="open = false" class="relative" x-data="{ open: false }">
                        <a href="#" @click="open = !open"
                            class="flex flex-row items-center justify-between px-4 py-1 my-1 text-sm text-left transition duration-200 rounded-md hover:bg-green-300 focus:bg-green-300 focus:text-black focus:outline-none focus:shadow-outline  {{ Route::is('dokumen-gli') ? 'bg-green-300 text-black' : '' }}">
                            <div class="flex flex-row items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="pr-3 w-9 h-9" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Dokumen</span>
                            </div>
                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <div x-show="open" class="relative right-0 w-full my-2 origin-top-right rounded-md shadow-lg"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95">
                            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                                <a class="block px-4 py-2 mt-2 text-sm font-semibold text-green-800 bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ Route::is('dokumen-gli') ? 'focus: bg-green-200 text-black' : '' }}"
                                    href="{{ route('dokumen-gli') }}">Dokumen Sertifikasi</a>
                            </div>
                        </div>
                    </div>
                </li>
            @endhasanyrole
            <li>
                <a href="{{ route('account') }}"
                    class="relative flex flex-row items-center px-4 py-1 my-1 text-sm transition duration-200 rounded-md hover:bg-green-300 hover:text-black  {{ request()->is('account') ? 'focus: bg-green-300 text-black' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="pr-3 w-9 h-9" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Account</span>
                </a>
            </li>
            @hasrole('super-admin')
                <li>
                    <a href="{{ route('activity-log') }}"
                        class="relative flex flex-row items-center px-4 py-1 my-1 text-sm transition duration-200 rounded-md hover:bg-green-300 hover:text-black  {{ request()->is('activity-log') ? 'focus: bg-green-300 text-black' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="pr-3 w-9 h-9" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span>Activity Log</span>
                    </a>
                </li>
            @endhasrole
        </ul>
    </nav>
</div>
