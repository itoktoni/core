@props([
    'col' => null,
    'label' => null,
])

@php

    $col = $attributes->get('col', $col ? 'col-md-' . $col : '');
    $label = $attributes->get('label', moduleName($label));

    $attributes = $attributes->class(['card'])->merge([]);
@endphp

<div class="grid grid-cols-1">
    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
        <div class="p-4 px-6 border-b border-gray-100 dark:border-zinc-600">
            <div class="flex items-center">
                <div class="flex-grow-1">
                    <h5 class="text-sm">{{ $label }}</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-12 gap-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
