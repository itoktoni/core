@php
$class = 'form-control';
@endphp

<div class="col-span-12 lg:col-span-{{ $col }}">
    <div class="mb-4">
        <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
            {{ $label }}
        </label>
        <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text">
    </div>
</div>

<div class="@if($type === 'hidden') d-none @else form-group @endif{{ $col }} {{ $errors->has($name) ? 'has-error' : '' }}">
    <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" />

    @if(!empty($prepend) or !empty($append) or !empty($button) or !empty($icon) or !empty($toggle))
        <div class="input-group">
    @endif

    @if(!empty($prepend))
        <div class="input-group-prepend">
            <div class="input-group-text">
                {!! $prepend !!}
            </div>
        </div>
    @endif

    @if(!empty($toggle))
        <div class="input-group-prepend">
            <button class="btn btn-default filter" type="button">{{ __($toggle) }}</button>
        </div>
    @endif

    <input

    {!! $attributes->merge(['class' => $class]) !!}

    type="{{ $type }}"

    @if($isWired())
        wire:model{!! $wireModifier() !!}="{{ $name }}"
    @else
        value="{{ $type == 'password' ? '' : $value }}"
    @endif

    name="{{ $name }}"

    @if(!empty($placeholder))
        placeholder="{{ $placeholder }}"
    @endif

    @if($label && !$attributes->get('id'))
        id="{{ $id() }}"
    @endif
    />

    @if(!empty($append))
        <div class="input-group-append">
            <div class="input-group-text">
                {!! $append !!}
            </div>
        </div>
    @endif

    @if(!empty($button))
    <div class="input-group-append">
        <button class="btn btn-default" type="submit">{{ __($button) }}</button>
    </div>
    @endif

    @if(!empty($icon))
    <div class="input-group-append">
        <button class="btn btn-default" type="submit">
            <i class="bi bi-{{ $icon }}"></i>
        </button>
    </div>
    @endif

    @if($hasErrorAndShow($name))
        <x-form-errors :name="$name" />
    @endif

    @if(!empty($prepend) or !empty($append) or !empty($button) or !empty($icon))
        </div>
    @endif

{!! $help ?? null !!}

</div>
