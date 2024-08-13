<form action="{{ $action }}"
    method="{{ $spoofMethod ? 'POST' : $method }}" {!! $attributes->merge([
        'class' => $hasError() ? 'form-submit needs-validation' : 'form-submit needs-validation',
    ]) !!} @if ($upload) enctype="multipart/form-data" @endif>

    @unless(in_array($method, ['HEAD', 'GET', 'OPTIONS']))
    @csrf
    @endunless

    @if($spoofMethod)
    @method($method)
    @endif

        <footer
            class="footer fixed bottom-0 right-0 left-0 border-t border-gray-50 py-5 px-5 bg-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-200">
            <div class="grid grid-cols-2">
                <div class="grow">

                </div>
                <div class="hidden md:inline-block text-end">
                    <div class="button">
                        @yield('action')
                    </div>
                </div>

            </div>
        </footer>

    {!! $slot !!}

    @once
        @push('footer')
            @stack('javascript')
        @endpush
    @endonce

</form>
