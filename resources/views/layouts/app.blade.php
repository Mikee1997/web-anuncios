<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Configuración de la página -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.25/datatables.min.css" />
    @stack('css')


    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script>
        // Configuración del idioma para DataTables
        var dataTableLang = {!! json_encode(trans('datatables')) !!};
    </script>
    <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>

    <!-- Integración con Vite para el desarrollo de JavaScript -->
    {{-- @vite(['resources/js/app.js']) --}}
    <link rel="modulepreload" href="{{asset('js/app2.js')}}">
    <script type="module" src="{{asset('js/app2.js')}}"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Inclusión de la barra de navegación -->
        @include('layouts.navigation')

        <!-- Encabezado de la página -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Mensajes de éxito y error -->
        @if (session()->has('success'))
            <div class="alert alert-success">
                @if (is_array(session('success')))
                    <ul>
                        @foreach (session('success') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @else
                    {{ session('success') }}
                @endif
            </div>
        @endif
        @if (isset($errores))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Contenido principal de la página -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Modal de confirmación para eliminar -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
        id="confirmation-modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel">{{ __('Are you sure to delete?') }}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="modal-btn-si">{{ __('Yes') }}</button>
                    <button type="button" class="btn btn-primary" id="modal-btn-no">{{ __('No') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.25/datatables.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Scripts adicionales definidos en las vistas -->
    @stack('js')
</body>

</html>
