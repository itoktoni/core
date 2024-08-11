<div>
    @if (!empty($batch) && $progress < $max)
    <div wire:poll class="progress">
        <progress value="{{ $progress }}" max="{{ $max }}"></progress>
    </div>
    @endif
</div>