@props(['disabled' => false])

<input type="radio" id="{{ $attributes['id'] }}" name="{{ $attributes['name'] }}" value="{{ $attributes['value'] }}"
    {{ $attributes->merge(['class' => 'peer hidden']) }} {{ $disabled ? 'disabled' : '' }} />
