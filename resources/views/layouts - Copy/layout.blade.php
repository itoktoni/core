@extends(Template::master())

@section('title')
{{ $label }}
@endsection

@section('container')
<div class="container-fluid">
	<div id="errormessages"></div>
    @livewire('notification')

    {{ $slot }}
</div>
@endsection
