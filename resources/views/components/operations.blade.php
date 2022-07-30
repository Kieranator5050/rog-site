<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mission Maker Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-navbar.nav-base>
                    <x-slot name="image">
                        <a href="{{ route('missions') }}">
                            <i class="fa-solid fa-toolbox text-2xl"></i>
                        </a>
                    </x-slot>
                    <x-slot name="navLinks">
                    </x-slot>
                    <x-slot name="navLinksResponsive">
                    </x-slot>

                </x-navbar.nav-base>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                {{ $slot }}

            </div>
        </div>
    </div>
</x-app-layout>
