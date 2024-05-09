<x-layout>
    <x-form :model="$model">
        <x-card>
            <x-action form="form" />

            <div class="row">
                @bind($model)
                    <x-form-input col="6" name="name" />
                    <x-form-input col="6" name="username" />
                    <x-form-input col="6" name="phone" />
                    <x-form-input col="6" name="email" />
                    <x-form-select col="6" class="search" name="role" :options="$roles" />
                    <x-form-input col="6" name="password" type="password" />
                @endbind
            </div>

        </x-card>
    </x-form>
</x-layout>
