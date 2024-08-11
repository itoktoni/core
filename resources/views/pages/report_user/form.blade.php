<x-layout>
    <x-card>
        <x-form :model="$model" :spa="false" method="GET" action="{{ moduleRoute('getPrint') }}" :upload="true">
            <x-action form="print" />
            @bind($model)
                <div class="row">
                    <x-form-input col="6" type="date" label="Tanggal Awal" name="start_date" />
                    <x-form-input col="6" type="date" label="Tanggal Akhir" name="end_date" />
                    <input type="hidden" name="queue" value="batch" />
                </div>
            @endbind

        </x-form>
    </x-card>
</x-layout>
