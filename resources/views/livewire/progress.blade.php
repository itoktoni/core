<div>
    @if (!empty($batch))

    <div wire:poll class="progress">

        <div class="wrap-circles">
            <div class="circle" style="background: conic-gradient(#33B5E5 {{ $progress }}%, #a9def1 0)">
                <div class="inner">{{ $progress }}%</div>
            </div>
        </div>

    </div>

    @endif
</div>
