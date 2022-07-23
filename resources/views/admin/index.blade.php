<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-2">
                                <h1 class="text-3xl text-center mb-4 mt-4 font-extrabold">USER TABLE</h1>
                                <table class="min-w-full divide-y divide-gray-200 table-auto border-collapse border border-grey-500">
                                    <thead>
                                        <tr>
                                            <th class="border border-gray-300">Username</th>
                                            <th class="border border-gray-300">Discord ID</th>
                                            <th class="border border-gray-300">UID</th>
                                            <th class="border border-gray-300">Ops</th>
                                            <th class="border border-gray-300">Balance</th>
                                            <th class="border border-gray-300">Active</th>
                                            <th class="border border-gray-300">Locked</th>
                                            <th class="border border-gray-300">Admin</th>
                                            <th class="border border-gray-300">TL</th>
                                            <th class="border border-gray-300">QM</th>
                                            <th class="border border-gray-300">MM</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap ">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <p>{{ $user->username }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap ">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <p>{{ $user->discord_id }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap ">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <p>{{ $user->uid }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap ">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <p>{{ $user->opCount }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap ">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <p>{{ $user->balance }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            @php
                                                $tfArray = [
                                                    0=>'<i class="fa-solid fa-xmark text-red-500"></i>',
                                                    1=>'<i class="fa-solid fa-check text-green-500"></i>'
                                                    ]
                                            @endphp
                                            <td class="px-6 py-4 whitespace-nowrap ">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <p>{!! $tfArray[$user->isActive] !!}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap ">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <p>{!! $tfArray[$user->isLocked] !!}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap ">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <p>{!! $tfArray[$user->isAdmin] !!}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap ">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <p>{!! $tfArray[$user->isTeamLead] !!}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap ">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <p>{!! $tfArray[$user->isQuartermaster] !!}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap ">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <p>{!! $tfArray[$user->isMissionMaker] !!}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="/admin/user/{{ $user->id }}" class="text-blue-500 hover:text-blue-600">Edit</a>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <form method="POST" action="/admin/user/{{ $user->id }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="text-xs text-gray-400">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="p-6">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
