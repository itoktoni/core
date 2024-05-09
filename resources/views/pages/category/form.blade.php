<x-layout>
    <x-card>
        <x-form :model="$model">
            <x-action form="form" />

            @bind($model)
                <x-form-input col="6" name="category_name" />
                <x-form-select col="6" name="category_active" :options="$status" />
            @endbind

        </x-form>
    </x-card>
</x-layout>