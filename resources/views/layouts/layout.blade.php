<!doctype html>
<html lang="en">
@include('layouts.meta')

<head>
    <link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" type="text/css">
    @livewireStyles
</head>

<body class="fixed">

    @include('layouts.header')

    <div id="main">

        <div class="navigation">

            @include('layouts.left')

        </div>

        <div class="main-content" id="content">
            <div class="container-fluid">
                {{ $slot }}
            </div>
        </div>

    </div>

    @include('layouts.alert')

    <script src="{{ url('assets/js/app.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/js/vite.js'])

    @stack('footer')

    @livewireScriptConfig
    @livewire('notification')
    <x-livewire-alert::scripts />
</body>

</html>

