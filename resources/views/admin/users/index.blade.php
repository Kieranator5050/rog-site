<x-admin>
    <!--Table Container-->
    <div class="flex flex-col text-xs">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-2">
                    <h1 class="text-3xl text-center mb-4 mt-4 font-extrabold">USER TABLE</h1>
                    <!--Table-->
                    <table class="min-w-full divide-y divide-gray-200 table-auto border-collapse border border-grey-500">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
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
                                <!--Edit-->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/admin/users/{{ $user->id }}/edit" class="text-blue-500 hover:text-blue-600">EDIT</a>
                                </td>

                                <!--Delete-->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form method="POST" action="/admin/users/{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-xs text-red-600">Delete</button>
                                    </form>
                                </td>
                                <x-tables.table-data-regular :data="$user->username"></x-tables.table-data-regular>
                                <x-tables.table-data-regular :data="$user->discord_id"></x-tables.table-data-regular>
                                <x-tables.table-data-regular :data="$user->uid"></x-tables.table-data-regular>
                                <x-tables.table-data-regular :data="$user->opCount"></x-tables.table-data-regular>
                                <x-tables.table-data-regular :data="$user->balance"></x-tables.table-data-regular>

                                @php
                                    $tfArray = [
                                        0=>'<i class="fa-solid fa-xmark text-red-500"></i>',
                                        1=>'<i class="fa-solid fa-check text-green-500"></i>'
                                        ]
                                @endphp
                                <x-tables.table-data-escaped :data="$tfArray[$user->isActive]"></x-tables.table-data-escaped>
                                <x-tables.table-data-escaped :data="$tfArray[$user->isLocked]"></x-tables.table-data-escaped>
                                <x-tables.table-data-escaped :data="$tfArray[$user->isAdmin]"></x-tables.table-data-escaped>
                                <x-tables.table-data-escaped :data="$tfArray[$user->isTeamLead]"></x-tables.table-data-escaped>
                                <x-tables.table-data-escaped :data="$tfArray[$user->isQuartermaster]"></x-tables.table-data-escaped>
                                <x-tables.table-data-escaped :data="$tfArray[$user->isMissionMaker]"></x-tables.table-data-escaped>


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
</x-admin>
