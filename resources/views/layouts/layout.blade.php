@extends(Template::master())

@section('title')
    {{ $label }}
@endsection

@section('container')
    <div class="page-content dark:bg-zinc-700">
        <div class="container-fluid px-[0.625rem]">
            <div id="errormessages"></div>
            @livewire('notification')

            {{ $slot }}
        </div>


    </div>
@endsection
