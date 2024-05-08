<x-layout>
    <x-card>
        <x-form :model="$model" :upload="true">
            <x-action form="form" />

            @bind($model)
                <x-form-input col="6" value="{{ env('APP_NAME') }}" label="Nama Perusahaan" name="name" />
                <x-form-select col="6" name="telescope_enable" :default="env('TELESCOPE_ENABLE')" label="Telescope Debugger" :options="$active" />
                <x-form-upload col="6" name="logo" />
                <div class="col-md-6">
                    <img class="img-thumbnail img-fluid" src="{{ env('APP_LOGO') ? url('public/storage/'.env('APP_LOGO')) : url('assets/media/image/logo.png') }}" alt="">
                </div>
            @endbind

        </x-form>
    </x-card>
</x-layout>
