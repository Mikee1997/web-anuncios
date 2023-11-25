<!DOCTYPE html>
<html>

<head>
    <!-- Título de la página utilizando el nombre de la aplicación desde las variables de entorno -->
    <title>{{ env('APP_NAME') }}</title>

    <!-- Enlace a la hoja de estilo de la aplicación -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Enlace a la hoja de estilo de Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <!-- Inclusión de la biblioteca jQuery -->
    <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>

    <!-- Compilación y enlace del archivo JavaScript utilizando Vite -->
    {{-- @vite(['resources/js/app.js']) --}}
    <link rel="modulepreload" href="{{asset('js/app2.js')}}">
    <script type="module" src="{{asset('js/app2.js')}}"></script>
</head>

<body>

    <div class="min-h-screen bg-white-100">
        <!-- Inclusión de la barra de navegación desde la plantilla de navegación -->
        @include('layouts.navigation')
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <!-- Contenido del encabezado  -->
                    {{ $header }}
                </div>
            </header>
        @endif
        <!-- Mensaje de éxito si existe en la sesión, se usara por ejemplo
                para cuando se modifica un anuncio con exito, mostrar el mensaje al usuario -->
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
        <!-- Mensaje de error personalizado si está presente -->
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

        <!-- Contenido principal de la aplicación -->
        <main>
            @yield ('content')
        </main>
    </div>
    <!-- Inclusión de Bootstrap JavaScript con integridad y atributos de crossorigin -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <!-- Inclusión de scripts adicionales apilados -->
    @stack('js')
</body>

</html>
