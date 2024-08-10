<x-layout>

    <x-card class="table-container">

        <x-form method="GET" x-init x-target="table" role="search" aria-label="Contacts" autocomplete="off" action="{{ moduleRoute('getTable') }}">
            <x-filter toggle="Filter" :fields="$fields" />

            <input type="search" name="search" aria-label="Search Term" placeholder="Type to filter contacts..." @input.debounce="$el.form.requestSubmit()" @search="$el.form.requestSubmit()">

            <button x-show="false">Search</button>

        </x-form>

        <x-form method="POST" action="{{ moduleRoute('getTable') }}">

            <x-action/>

            <div class="container-fluid">
                <div class="table-responsive" id="table_data">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="9" class="center">
                                    <input class="btn-check-d" type="checkbox">
                                </th>
                                <th class="text-center column-action">{{ __('Action') }}</th>
                                @foreach($fields as $value)
                                    <th {{ Template::extractColumn($value) }}>
                                        @if($value->sort)
                                            @sortablelink($value->code, __($value->name))
                                            @else
                                                {{ __($value->name) }}
                                            @endif
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody id="table">
                            @forelse($data as $table)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox" name="code[]"
                                            value="{{ $table->field_primary }}">
                                    </td>
                                    <td class="col-md-2 text-center column-action">
                                        <x-crud :model="$table" />
                                    </td>
                                    <td>{{ $table->field_name }}</td>
                                    <td>{{ $table->field_username }}</td>
                                    <td>{{ $table->field_role_name }}</td>
                                    <td>{{ $table->field_phone }}</td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <x-pagination :data="$data" />
            </div>

        </x-form>

    </x-card>

</x-layout>