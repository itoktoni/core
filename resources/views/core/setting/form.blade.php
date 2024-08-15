<x-layout>
    <x-form :model="$model" :upload="true">
        <x-card>
                @bind($model)
                    <x-form-input col="6" value="{{ env('APP_NAME') }}" label="Nama Perusahaan" name="name" />
                    <x-form-select col="2" name="debug_enable" :default="env('APP_DEBUG')" label="Debug Enable"
                        :options="$active" />
                    <x-form-select col="2" name="telescope_enable" :default="env('TELESCOPE_ENABLED')" label="Telescope"
                        :options="$active" />
                    <x-form-select col="2" name="debugbar_enable" :default="env('BREADCRUMB_ENABLED')" label="Debugbar"
                        :options="$active" />
                    <x-form-input col="4" value="{{ env('APP_URL') }}" label="Website URL" name="url" />
                    <x-form-upload col="4" name="logo" />
                    <div class="col-md-4">
                        <img class="img-thumbnail img-fluid"
                            src="{{ env('APP_LOGO') ? url('public/storage/' . env('APP_LOGO')) : url('assets/media/image/logo.png') }}"
                            alt="">
                    </div>
                @endbind

                <x-action form="form" />

        </x-card>

    </x-form>
</x-layout>
