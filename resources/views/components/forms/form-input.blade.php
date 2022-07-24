@props(['field','label'])

<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="{{ $field }}" value="{{ $label }}" />
    <x-jet-input id="{{ $field }}" type="text" class="mt-1 block w-full" wire:model.defer="state.{{ $field }}" autocomplete="{{ $field }}" />
    <x-jet-input-error for="{{ $field }}" class="mt-2" />
</div>
