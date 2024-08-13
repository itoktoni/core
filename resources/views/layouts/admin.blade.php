<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    @include('layouts.meta')
    @yield('head')

    <!-- alertifyjs Css -->
    <link href="{{ url('assets/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet" type="text/css') }}" />

    <!-- alertifyjs default themes  Css -->
    <link href="{{ url('assets/libs/alertifyjs/build/css/themes/default.min.css') }}" rel="stylesheet" type="text/css') }}" />

    <link rel="stylesheet" href="{{ url('assets/css/icons.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/tailwind.css') }}" />

    @yield('css')
    @livewireStyles

</head>

<body data-mode="light" data-sidebar-size="lg">

    @include('layouts.header')
    @include('layouts.right')
    @include('layouts.left')

    <div class="main-content">

        @yield('container')

    </div>

    <script src="assets/libs/@popperjs/core/umd/popper.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <!-- alertifyjs js -->
    <script src="assets/libs/alertifyjs/build/alertify.min.js"></script>

    <!-- notification init -->
    <!-- <script src="assets/js/pages/notification.init.js"></script> -->

    <script src="assets/js/app.js"></script>
</body>

</html>
