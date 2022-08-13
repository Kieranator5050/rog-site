<x-dashboard>
    <h1>WELCOME TO THE ROG WEBSITE</h1>
    <!-- Information Text -->
    <div class="mx-36 p-2 border border-gray-900 bg-gray-700 text-white text-base text-center hover:bg-gray-900 rounded-lg">
        <ul>
            <li><i class="fa-solid fa-circle-info text-2xl"></i></li>
            <li class="text-amber-600 text-sm">This website is still under construction expect some bugs</li>
            <li class="text-green-500 text-sm">Click an operation to view its <strong>details</strong> and <strong>sign up</strong></li>
        </ul>
    </div>


    <!--Upcoming Ops Container-->
    <div class="container mx-auto p-6 border border-gray-300 mt-2 shadow-lg">
        @if(!$operations->isEmpty())
            <h1 class="text-3xl font-extrabold">Upcoming Ops</h1>
            <div class="flex items-stretch -mx-4">
                @foreach($operations as $operation)
                    <div class="flex-1 p-4">
                        <div class="block bg-gray-800 hover:bg-gray-900 overflow-hidden border-2 h-full relative rounded-lg">
                            <a href="/operations/{{ $operation->id }}" class="after:absolute after:inset-0">
                                <div class="p-4">
                                    <a href="/operations/{{ $operation->id }}">
                                        <h2 class="mt-2 mb-2 text-2xl font-bold font-Heading tracking-tight text-gray-900 dark:text-white">{{ $operation->name }}</h2>
                                    </a>
                                    <div class="container p-4 flex flex-wrap items-center">
                                        <div class="mx-auto text-center">
                                            <i class="fa-solid fa-clock text-orange-600 text-2xl"></i>
                                            <p class="text-orange-500 text-sm">{{ $operation->op_date->diffForHumans() }}</p>
                                            <p class="text-orange-500 text-sm">{{ date('g:i a e', strtotime($operation->op_date)) }}</p>
                                        </div>
                                    </div>

                                    <p class="text-orange-400 text-base">Type : {{ $operation->type->name }}</p>

                                    <div class="container flex flex-wrap items-center">
                                        <div class="relative mx-auto p-2 mb-3 mt-2 border border-gray-900 bg-gray-800 text-white text-base text-center hover:bg-gray-900 rounded-lg">
                                            <ul>
                                                @if(!$operation->isCompleted)
                                                    @if($operation_user
                                                        ->where('operation_id','=',$operation->id)
                                                        ->where('user_id','=',auth()->user()->id)
                                                        ->exists())
                                                        @if($operation_user
                                                            ->where('operation_id','=',$operation->id)
                                                            ->where('user_id','=',auth()->user()->id)
                                                            ->where('hasLifeInsurance','=',1)
                                                            ->exists())
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

                                <div class="container mb-4 flex flex-wrap items-center">
                                    <div class="mx-auto">
                                        <a href="/operations/{{ $operation->id }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Click to View Details
                                            <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $operations->links() }}
        @else
            <h1>NO OPERATIONS POSTED</h1>
        @endif
    </div>
</x-dashboard>
