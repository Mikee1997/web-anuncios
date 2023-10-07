@extends('layout')
<!--resources/views/anuncios_blade.php-->
@section('content')
    <h1>Listado de Anuncios <a href="{{route('createAd')}}">Crear Anuncio</a></h1>
    <div class="content">
        <div class="row">
            @foreach ($anuncios as $anuncio)
                <div class="col-3 bg-primary m-3">
                    <a href="{{route('detailAd',$anuncio->id)}}">
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
