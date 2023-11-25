@extends('layout')
@section('content')
    <!-- Título de la página -->
    <h1>{{ __('You are about to reserve the product') }}: {{ $anuncio->title }}</h1>
    <p>{{ __('Indicate the point where you wish to make the collection') }}</p>
    <form action="{{ route('ad.reserveSave', $anuncio->id) }}" method="POST">
        @csrf
        <!-- Iteración sobre los puntos de recogida -->
        @foreach ($pickPoints as $pickPoint)
            <div>
                <!-- Radio button para seleccionar el punto de recogida -->
                <input type="radio" name="pickpoint" value="{{ $pickPoint->id }}">
                <!-- Etiqueta del punto de recogida con nombre y dirección -->
                <label for="pickpoint">{{ $pickPoint->name }} ({{ $pickPoint->direccion }})</label>
            </div>
        @endforeach
        <!-- Botón de envío del formulario de reserva -->
        <input class="btn btn-primary" type="submit" value="{{ __('Reserve') }}">
    </form>
@endsection
