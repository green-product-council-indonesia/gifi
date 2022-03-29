@extends('layouts.base')

@section('body')
    <div class="relative min-h-screen xl:flex" x-data="{ isMobileNavOpen: true }">
        @include('livewire.components.sidebar')
        <!-- Page content -->
        <div class="flex-1 bg-all">
            <div class="sticky top-0">
                @include('livewire.components.navbar')
            </div>
            <div class="p-8">
                @yield('content')
            </div>
        </div>

        @isset($slot)
            {{ $slot }}
        @endisset
    </div>
@endsection
