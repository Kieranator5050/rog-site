@props(['value'=>0,'label'])

<label for="{{ $label }}">{{ $label }}</label>
<select id="{{ $label }}" name="{{ $label }}">
    @if($value==0)
        <option value="0" selected="selected">False</option>
        <option value="1">True</option>
    @else
        <option value="0">False</option>
        <option value="1" selected="selected">True</option>
    @endif

</select>
