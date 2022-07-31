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
            </x-slot>
            <x-slot name="navLinksResponsive">
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
                                <h1>WELCOME TO THE ROG WEBSITE</h1>
                                <!-- Information Text -->
                                <div class="mx-36 p-2 border border-gray-900 bg-gray-700 text-white text-base text-center hover:bg-gray-900 rounded-lg">
                                    <ul>
                                        <li><i class="fa-solid fa-circle-info text-2xl"></i></li>
                                        <li class="text-amber-600 text-sm">This website is still under construction expect some bugs</li>
                                        <li class="text-green-500 text-sm">Click an operation to view its <strong>details</strong> and <strong>sign up</strong></li>
                                    </ul>
                                </div>

                                <div class="mt-3">
                                    @if(!$operations->isEmpty())
                                        <h1>Upcoming Ops</h1>
                                        <div class="flex items-center flex-col mx-24 p-2">
                                            @foreach($operations as $operation)
                                                <div class="p-6 mx-2 my-2 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                                    <a href="/operations/{{ $operation->id }}">
                                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $operation->name }}</h5>
                                                    </a>
                                                    <p class="text-orange-600">{{ $operation->op_date->diffForHumans() }}</p>
                                                    <p class="text-orange-400 my-2">Type : {{ $operation->type->name }}</p>
                                                    <a href="/operations/{{ $operation->id }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                        View Details
                                                        <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    </a>
                                                </div>
                                            @endforeach
                                            {{ $operations->links() }}
                                        </div>
                                    @else

                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
