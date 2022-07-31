<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <x-navbar.nav-base>
            <x-slot name="image">
                <a href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-house text-2xl"></i>
                </a>
            </x-slot>
            <x-slot name="navLinks">
                <x-navbar.nav-item href="/dashboard/rules" :active="request()->routeIs('dashboard/rules')">Rules</x-navbar.nav-item>
            </x-slot>
            <x-slot name="navLinksResponsive">
                <x-navbar.nav-item href="/dashboard/rules" :active="request()->routeIs('dashboard/rules')">Rules</x-navbar.nav-item>
            </x-slot>

        </x-navbar.nav-base>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col text-xl items-center text-center">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="pt-8 pb-8 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-2 items-center">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
