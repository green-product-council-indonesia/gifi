<div class="flex flex-row-reverse justify-between text-green-500 bg-white shadow-md xl:flex-row xl:justify-end">

    <button class="p-4 focus:outline-none focus:bg-green-400 xl:hidden"
        x-on:click.prevent="isMobileNavOpen = !isMobileNavOpen" x-bind:aria-label="isMobileNavOpen"
        x-bind:aria-expanded="isMobileNavOpen">
        {{-- Logo Hamburger Menu --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" x-show="isMobileNavOpen" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        {{-- Logo X --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" x-show="!isMobileNavOpen" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <div class="p-2" x-data="{ dropdown : false }">
        <div class="flex items-center justify-center w-8 h-8 ml-2 text-center bg-green-200 rounded-full"
            @click="dropdown = !dropdown">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 " fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="absolute w-48 p-4 mt-2 ml-2 text-black origin-top-left bg-white rounded-md shadow-lg xl:mr-2 xl:right-0 xl:object-top-right hover:text-gray-500 ring-1 ring-black ring-opacity-5 focus:outline-none"
            tabindex="-1" x-show="dropdown" @click.away="dropdown = false">
            <ul>
                <li>
                    <a href="{{ route('account') }}"
                        class="block px-4 py-2 mt-2 text-sm font-semibold text-indigo-800 bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">Profile</a>
                </li>
                <li>
                    <hr class="my-2">
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="flex flex-row items-center justify-between px-4 py-2 mt-2 text-sm font-semibold text-indigo-800 bg-transparent rounded-lg xl:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                        Logout
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
