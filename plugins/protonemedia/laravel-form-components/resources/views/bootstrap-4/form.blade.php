<form {{ env('APP_SPA') && $spa ? 'hx-boost=true hx-target=#content' : '' }} action="{{ $action }}"
    method="{{ $spoofMethod ? 'POST' : $method }}" {!! $attributes->merge([
        'class' => $hasError() ? 'form-submit needs-validation' : 'form-submit needs-validation',
    ]) !!}
    @if ($upload) enctype="multipart/form-data" @endif>

    <div class="page-action">
        <h5 class="action-container">
            <div class="button">
                @yield('action')
            </div>
        </h5>
    </div>

    {!! $slot !!}

    @once
        @push('footer')
            @stack('javascript')
        @endpush
    @endonce

</form>
