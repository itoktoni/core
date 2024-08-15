@php
$class = 'form-control';
@endphp

<div class="mt-2 mb-2 @if($type === 'hidden') d-none @else form-group @endif{{ $col }} {{ $errors->has($name) ? 'has-error' : '' }}">
    <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" />

    <div>
        <input
        name="{{ $name }}"
        type="file"
        {!! $attributes->merge(['class' => $class]) !!}
        >
    </div>


    @if($hasErrorAndShow($name))
        <x-form-errors :name="$name" />
    @endif

{!! $help ?? null !!}

</div>
