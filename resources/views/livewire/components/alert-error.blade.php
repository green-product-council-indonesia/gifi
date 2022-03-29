<div class="flex items-center justify-center px-4 py-2 my-4 font-medium text-red-700 bg-red-100 border border-red-300 rounded-md"
    x-data="{ show: false }" x-init="() => {
            setTimeout(() => show = true, 500);
            setTimeout(() => show = false, 5000);
          }" x-show="show" x-description="Notification panel, show/hide based on alert state."
    @click.away="show = false" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90">
    <div slot="avatar">
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="w-5 h-5 mx-2 feather feather-alert-octagon">
            <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
            </polygon>
            <line x1="12" y1="8" x2="12" y2="12"></line>
            <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
    </div>
    <div class="items-center flex-initial max-w-full text-xl font-normal">
        <p class="text-xl font-semibold">{{ session('message') }}</p>
    </div>
    <div class="flex flex-row-reverse flex-auto">

    </div>
</div>
