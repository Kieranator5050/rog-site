<x-operations>
    <div class="p-6">
        <h1 class="text-2xl font-extrabold">{{ $operation->name }}</h1>
        <div>
            {!! $operation->description !!}
        </div>

        @dd($operation->users)

        <div>
            <!--Table-->
            <table class="min-w-full divide-y divide-gray-200 table-auto border-collapse border border-grey-500">
                <thead>
                <tr>
                    @can('Admin')
                        <th></th>
                        <th></th>
                    @endcan
                    <th class="border border-gray-300">Username</th>
                    <th class="border border-gray-300">Life Insurance</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($operations as $user)

                    <tr>
                        <!--Edit-->
                        @can('Admin')
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="/admin/users/{{ $user->id }}/edit" class="text-blue-500 hover:text-blue-600">EDIT</a>
                            </td>

                            <!--Delete-->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form method="POST" action="/operations/{{ $user->id }}/unregister">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-xs text-red-600">UNREGISTER</button>
                                </form>
                            </td>
                        @endcan

                        <x-tables.table-data-regular :data="$user->username"></x-tables.table-data-regular>
                        @php
                            $tfArray = [
                                0=>'<i class="fa-solid fa-xmark text-red-500"></i>',
                                1=>'<i class="fa-solid fa-check text-green-500"></i>'
                                ]
                        @endphp
                        <x-tables.table-data-escaped :data="$op->op_date"></x-tables.table-data-escaped>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="p-6">
                {{ $operations->links() }}
            </div>

        </div>
    </div>
</x-operations>
