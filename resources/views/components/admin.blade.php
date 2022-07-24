<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-navbar.nav-base>
                    <x-slot name="image">
                        <a href="{{ route('admin') }}">
                            <i class="fa-solid fa-screwdriver-wrench text-2xl"></i>
                        </a>
                    </x-slot>
                    <x-slot name="navLinks">
                        <x-navbar.nav-item href="/admin/users" :active="request()->routeIs('admin/users')">Users</x-navbar.nav-item>
                        <x-navbar.nav-item href="/admin/operations" :active="request()->routeIs('admin/operations')">Operations</x-navbar.nav-item>
                    </x-slot>
                    <x-slot name="navLinksResponsive">
                        <x-navbar.nav-item href="/admin/users'" :active="request()->routeIs('admin/users')">User</x-navbar.nav-item>
                        <x-navbar.nav-item href="/admin/operations" :active="request()->routeIs('admin/operations')">Operations</x-navbar.nav-item>
                    </x-slot>

                </x-navbar.nav-base>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                {{ $slot }}

            </div>
        </div>
    </div>
</x-app-layout>
