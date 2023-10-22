@extends('layout')

@section('content')
<div class="text-center aling-center d-grid justify-content-center">
    <h1>Detalle anuncio</h1>
    <h2>{{$anuncio->title}}</h2>
    <h3>{{$anuncio->short_description}}</h3>
    <p>{{$anuncio->long_description}}</p>
    <p><strong>Telefono: </strong>{{$anuncio->phone}}</p>
    <p><strong>Email: </strong>{{$anuncio->email}}</p>
    @foreach($anuncio->getMedia('imagenes') as $imagen)
        <img class="imageproduct" src="{{ $imagen->getUrl() }}" alt="Imagen">
    @endforeach
    @if(auth()->user())
        @if(auth()->user()->id!=$anuncio->user_id)
            <a class="btn btn-primary" href="{{route('ad.reserve',$anuncio->id)}}">{{__('Reservar')}}</a>
        @endif
    @else
        <a class="btn btn-primary" href="{{route('login')}}">{{__('Inicia sesión para reservar')}}</a>
    @endif
</div>


@endsection