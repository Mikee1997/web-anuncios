<!--resources/views/anuncios_blade.php-->
<!DOCTYPE html>
<html>

<head>
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
    <!-- Scripts -->
    @vite([ 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main >
            @yield ('content')
        </main>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    @stack('js')
</body>

</html>
