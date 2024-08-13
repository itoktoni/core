@php
$class = 'form-control';
@endphp

<div class="col-span-{{ $col }}">
    <div class="mb-4">
        <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
            {{ $label }}
        </label>
        <input name="{{ $name }}" type="{{ $type }}" value="{{ $type == 'password' ? '' : $value }}" class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100">
    </div>
</div>