@extends('layout')

@section('content')
    <h1>GRACIAS POR RESERVAR</h1>
    <p>Recibiras un email a {{auth()->user()->email}} cuando puedas pasar a recogerlo</p>
@endsection
