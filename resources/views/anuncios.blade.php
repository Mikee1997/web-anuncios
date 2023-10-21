@extends('layout')
<!--resources/views/anuncios_blade.php-->
@section('content')

    <div class="content">
        <div class="row d-flex justify-content-center">
            <h1 class="text-center">Listado de Anuncios
            </h1>
        </div>
        <div class="row d-flex justify-content-center">
            @foreach ($anuncios as $anuncio)
                <div class="col-3 bg-primary m-3 anuncio">
                    <a href="{{ route('detailAd', $anuncio->id) }}">
                        @if (isset($anuncio->imagen))
                            <img src="{{ $anuncio->imagen }}" alt="Imagen">
                        @endif
                        <h2 class="text-light">{{ $anuncio->title }}</h2>
                        <p class="text-body-secondary">{{ $anuncio->short_description }}</p>
                    </a>

                </div>
            @endforeach
        </div>
    </div>
    {{-- <ul>
    @foreach ($anuncios as $anuncio)
    <li>{{$anuncio->title}}</li>
    @endforeach
</ul> --}}
@endsection
