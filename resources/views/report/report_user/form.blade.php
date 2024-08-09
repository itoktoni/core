<x-layout>
    <x-card>
        <x-form :model="$model" :spa="false" target="_blank"  method="GET" action="{{ moduleRoute('getPrint') }}" :upload="true">
            <x-action form="print" />
            @bind($model)
                <div class="row">
                    <x-form-input col="6" type="date" label="Tanggal Awal" name="start_date" />
                    <x-form-input col="6" type="date" label="Tanggal Akhir" name="end_date" />
                </div>
            @endbind

        </x-form>
    </x-card>
</x-layout>
