@php
$class = 'form-control';
@endphp

<div class="col-span-{{ $col }}">
    <div class="mb-4">
        <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
            {{ $label }}
        </label>

        <input name="{{ $name }}" type="file" class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="large_size">

    </div>
</div>