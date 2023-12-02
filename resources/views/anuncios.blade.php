@extends('layout')
@section('content')
    <div class="content">
        <div class="row d-flex justify-content-center">
            <h1 class="text-center">{{ __('Ad List') }}
            </h1>
        </div>
        <div class="row d-flex justify-content-center">
            <!-- Bucle foreach para iterar sobre cada anuncio -->
            @foreach ($anuncios as $anuncio)
                <div class="col-3 bg-primary m-3 anuncio">
                    <!-- Enlace a la página de detalle del anuncio -->
                    <a href="{{ route('detailAd', $anuncio->id) }}">
                        <!-- Verificación y muestra de la imagen del anuncio si está presente -->
                        @if (isset($anuncio->imagen))
                            <img src="{{ $anuncio->imagen }}" alt="Imagen">
                        @endif
                        <!-- Título del anuncio en texto claro -->
                        <h2 class="text-light">{{ $anuncio->title }}</h2>
                        <!-- Descripción corta del anuncio en texto blanco -->
                        <p class="text-white">{{ $anuncio->short_description }}</p>
                        <p class="text-white price"><strong>{{ $anuncio->price }}€</strong></p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
