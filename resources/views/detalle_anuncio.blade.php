@extends('layout')

@section('content')
<h1>Detalle anuncio</h1>
<h2>{{$anuncio->title}}</h2>
<h3>{{$anuncio->short_description}}</h3>
<p>{{$anuncio->long_description}}</p>
<p><strong>Telefono: </strong>{{$anuncio->phone}}</p>
<p><strong>Email: </strong>{{$anuncio->email}}</p>

@endsection
