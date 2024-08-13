<div class="col-span-{{ $col }}">
    <div class="mb-4">
        <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
            {{ $label }}
        </label>

        <select
        name="{{ $name }}"
        @if($multiple)
            multiple
        @endif
        class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
            @forelse($options as $key => $option)
            <option value="{{ $key }}" @if($isSelected($key)) selected="selected" @endif>
                {{ $option }}
            </option>
            @empty
                {!! $slot !!}
            @endforelse
        </select>
    </div>
</div>