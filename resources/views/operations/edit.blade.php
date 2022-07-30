<x-operations>
    <div class="p-6">
        <form method="POST" action="/operations/{{ $op->id }}">
            @csrf
            @method('PATCH')
            <h1>Editing {{ $op->name }}</h1>
            <div class="flex flex-col mt-6 mb-6 text-center">

                <h1 class="font-semibold">Operation Information</h1>
                <!--Name & Date -->
                <div class="grid grid-cols-2">
                    <x-forms.container-block>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$op->name" required autofocus autocomplete="name" />
                        <x-jet-input-error for="name" class="mt-2" />
                    </x-forms.container-block>
                    <x-forms.container-block>
                        <x-jet-label for="op_date" value="{{ __('Op Date') }}" />
                        <x-jet-input id="op_date" class="block mt-1 w-full" type="datetime-local" name="op_date" value="{{ $op->op_date->format('Y-m-d\TH:i') }}" required autofocus autocomplete="op_date" />
                        <x-jet-input-error for="op_date" class="mt-2" />
                    </x-forms.container-block>
                </div>

                <!-- Type $ isCompleted -->
                <div class="grid grid-cols-2">
                    <x-forms.container-block>
                        <label for="operation_type_id">Op Type</label>
                        <select id="operation_type_id" name="operation_type_id">
                            @foreach($types as $type)
                                @if($op->type->id == $type->id)
                                    <option value="{{ $type->id }}" selected="selected">{{ $type->name }}</option>
                                @else
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <x-jet-input-error for="operation_type_id" class="mt-2" />
                    </x-forms.container-block>
                    <x-forms.container-block>
                        <x-forms.dropdown-tf-item :value="$op->isCompleted" label="isCompleted"></x-forms.dropdown-tf-item>
                        <x-jet-input-error for="isCompleted" class="mt-2" />
                    </x-forms.container-block>
                </div>

                <!-- Description-->
                <h1 class="mt-4 font-semibold">Description</h1>
                <x-forms.container-block>
                    <textarea name="description" id="description">{!! $op->description !!}</textarea>
                    <x-jet-input-error for="description" class="mt-2" />
                </x-forms.container-block>
                <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"> </script>
                <script>
                    CKEDITOR.replace( 'description' );
                </script>

            </div>


            <div>
                <x-jet-button>
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</x-operations>
