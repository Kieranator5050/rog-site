<x-app-layout>
    <div class="p-6">
        <div class="p-6 bg-white">
            <div class="mb-4">
                <a href="{{ URL::previous() }}" class="mr-3 bg-blue-400 p-2 rounded-full hover:bg-red-500"><i class="fa-solid fa-backward"></i> Back</a>
                @can('MissionMaker')
                    <a href="/operations/{{ $operation->id }}/edit" class="bg-blue-400 p-2 rounded-full hover:bg-red-500"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                @endcan
            </div>


            <div class="p-2 border border-gray-300">
                <h1 class="text-2xl font-extrabold text-center mb-4">{{ $operation->name }}</h1>
                <div class="text-base">
                    {!! $operation->description !!}
                </div>
            </div>


            <div class="p-2 border border-gray-300">
                <!--Table-->
                <h1 class="text-2xl font-extrabold text-center">Attendees</h1>
                <table class="min-w-full divide-y divide-gray-200 table-auto border-collapse border border-grey-500">
                    <thead>
                    <tr>
                        @can('Admin')
                            <th></th>
                            <th></th>
                        @endcan
                        <th class="border border-gray-300 text-left">Username</th>
                        <th class="border border-gray-30 text-left">Life Insurance</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)

                        <tr>
                            <!--Edit-->
                            @can('Admin')
                                <td class="px-2 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/admin/users/{{ $user->id }}/edit" class="text-blue-500 hover:text-blue-600">EDIT</a>
                                </td>

                                <!--Delete-->
                                <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <form method="POST" action="/operations/{{ $operation->id }}/user/{{ $user->id }}/unregister">
                                        @csrf
                                        <button class="text-xs text-red-600">UNREGISTER</button>
                                    </form>
                                </td>
                            @endcan

                            <x-tables.table-data-regular :data="$user->username"></x-tables.table-data-regular>
                            @php
                                $tfArray = [
                                    0=>'<i class="fa-solid fa-xmark text-red-500"></i>',
                                    1=>'<i class="fa-solid fa-check text-green-500"></i>'
                                    ];
                            @endphp
                            <x-tables.table-data-escaped :data="$tfArray[$user->pivot->hasLifeInsurance]"></x-tables.table-data-escaped>
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

</x-app-layout>
