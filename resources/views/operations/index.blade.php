<x-operations>
    <!--Table Container-->
    <div class="flex flex-col text-xs">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-2">
                    <h1 class="text-3xl text-center mb-4 mt-4 font-extrabold">OPERATION TABLE</h1>
                    <div class="mx-36 p-2 border border-gray-900 bg-gray-700 text-white text-base text-center hover:bg-gray-900">
                        <ul>
                            <li><i class="fa-solid fa-circle-info text-2xl"></i></li>
                            <li>Click the <strong>icon( <i class="fa-solid fa-xmark text-red-500"></i> | <i class="fa-solid fa-check text-green-500"></i> )</strong> under completed to change the completed status</li>
                            <li>Click the operation <strong>name</strong> to view its details</li>
                        </ul>
                    </div>
                    <div class="text-center m-6">
                        <a class="text-xl bg-gray-500 text-white p-2 rounded-full" href="/operation/create">CREATE</a>
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-500 text-xs mt-2">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <!--Table-->
                    <table class="min-w-full divide-y divide-gray-200 table-auto border-collapse border border-grey-500">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th class="border border-gray-300">Name</th>
                            <th class="border border-gray-300">Op Date\Time</th>
                            <th class="border border-gray-300">Op Type</th>
                            <th class="border border-gray-300">isCompleted</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($operations as $op)

                            <tr>
                                <!--Edit-->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/operations/{{ $op->id }}/edit" class="text-blue-500 hover:text-blue-600">EDIT</a>
                                </td>

                                <!--Delete-->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form method="POST" action="/operations/{{ $op->id }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-xs text-red-600">DELETE</button>
                                    </form>
                                </td>
                                <x-tables.table-data-escaped data='<a href="/operations/{{ $op->id }}" class="text-blue-800">{{ $op->name }}</a>'></x-tables.table-data-escaped>
                                <x-tables.table-data-regular :data="$op->op_date"></x-tables.table-data-regular>
                                <x-tables.table-data-regular :data="$op->type->name"></x-tables.table-data-regular>
                                @php
                                    $tfArray = [
                                        0=>'<i class="fa-solid fa-xmark text-red-500"></i>',
                                        1=>'<i class="fa-solid fa-check text-green-500"></i>'
                                        ]
                                @endphp
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <form method="POST" action="/operations/{{ $op->id }}/complete">
                                        @csrf
                                        <input type="hidden" id="isCompleted" name="isCompleted" value="{{ $op->isCompleted }}">
                                        <button>{!! $tfArray[$op->isCompleted] !!}</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="p-6">
                        {{ $operations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-operations>

