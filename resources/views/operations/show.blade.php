<x-app-layout>
    <div class="p-6">
        <div class="p-6 bg-white">
            <div class="mb-4">
                <a href="{{ URL::previous() }}" class="mr-3 bg-blue-400 p-2 rounded-full hover:bg-red-500"><i class="fa-solid fa-backward"></i> Back</a>
                @can('MissionMaker')
                    <a href="/operations/{{ $operation->id }}/edit" class="bg-blue-400 p-2 rounded-full hover:bg-red-500"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                @endcan
            </div>

            <div>
                <div class="text-center">
                    <div class="mx-36 p-2 mb-3 mt-2 border border-gray-900 bg-gray-800 text-white text-base text-center hover:bg-gray-900 rounded-lg">
                        <div class="mx-auto text-center mb-4">
                            <i class="fa-solid fa-clock text-orange-600 text-2xl"></i>
                            <p class="text-orange-500 text-sm">{{ $operation->op_date->diffForHumans() }}</p>
                            <p class="text-orange-500 text-sm">{{ date('g:i a e', strtotime($operation->op_date)) }}</p>
                        </div>
                        <ul>
                            @if(!$operation->isCompleted)
                                @if($isRegistered)
                                    @if($hasLifeInsurance)
                                        <li><i class="fa-solid fa-check-to-slot text-4xl text-green-500"></i></li>
                                        <li class="text-green-400">Already Registered!</li>
                                        <li class="text-green-400">Life Insurance Equipped!</li>
                                        <form method="POST" action="/operations/{{ $operation->id }}/user/{{ auth()->user()->id }}/unregister">
                                            @csrf
                                            <x-jet-button class="bg-red-800 hover:bg-red-700 my-1">
                                                {{ __("Unregister") }}
                                            </x-jet-button>
                                        </form>
                                    @else
                                        <li><i class="fa-solid fa-triangle-exclamation text-4xl text-amber-600"></i></li>
                                        <li class="text-green-400">Already Registered!</li>
                                        <li class="text-xs text-amber-400">No Life Insurance Equipped!</li>
                                        <li class="text-xs text-amber-400">Buy some now or risk losing your gear after a death!</li>
                                        <form method="POST" action="/operations/{{ $operation->id }}/user/{{ auth()->user()->id }}">
                                            @csrf
                                            <input type="hidden" id="updateLifeInsurance" name="updateLifeInsurance" value="1">
                                            <x-jet-button class="bg-green-800 hover:bg-green-700 my-1">
                                                {{ __("\$1000") }}
                                            </x-jet-button>
                                        </form>
                                        <form method="POST" action="/operations/{{ $operation->id }}/user/{{ auth()->user()->id }}/unregister">
                                            @csrf
                                            <x-jet-button class="bg-red-800 hover:bg-red-700 my-1">
                                                {{ __("Unregister") }}
                                            </x-jet-button>
                                        </form>
                                    @endif
                                @else
                                    <li><i class="fa-solid fa-circle-info text-2xl"></i></li>
                                    <form method="POST" action="/operations/{{ $operation->id }}/user/{{ auth()->user()->id }}">
                                        @csrf
                                        <x-jet-button class="bg-green-800 hover:bg-green-700 my-1">
                                            {{ __("Register") }}
                                        </x-jet-button>
                                        <div class="">
                                            <p class="inline font-extrabold">Life Insurance</p>
                                            <x-jet-checkbox class="border border-red-500 p-2 ml-2" name="hasLifeInsurance"></x-jet-checkbox>
                                        </div>
                                    </form>
                                @endif
                            @else
                                <li><i class="fa-solid fa-ban text-4xl text-red-500"></i></li>
                                <li class="text-sm text-amber-400">Operation is Cancelled\Completed</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mx-24 my-8">
                <div class="p-2 border border-gray-300">
                    <div><h1 class="text-2xl font-extrabold text-left mb-4">{{ $operation->name }}</h1></div>
                    <div class="text-base">
                        {!! $operation->description !!}
                    </div>
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
                        <th class="border border-gray-300 text-left">Life Insurance</th>
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
