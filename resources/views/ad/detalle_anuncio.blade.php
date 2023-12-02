@extends('layout')
@section('content')
    <div class="text-center aling-center d-grid justify-content-center">
                <!-- Título principal centrado -->
        <h1>{{ __('ad detail') }}</h1>
                <!-- Título del anuncio -->
        <h2>{{ $anuncio->title }}</h2>
                <!-- Descripción corta del anuncio -->
        <h3>{{ $anuncio->short_description }}</h3>
                <!-- Descripción larga del anuncio -->
        <p>{{ $anuncio->long_description }}</p>
        <!-- Precio del anuncio -->
        <p class="price"><strong>{{ $anuncio->price }}€</strong></p>
                <!-- Número de teléfono del anunciante -->
        <p><strong>{{ __('Phone') }}: </strong>{{ $anuncio->phone }}</p>
                <!-- Dirección de correo electrónico del anunciante -->
        <p><strong>Email: </strong>{{ $anuncio->email }}</p>
                <!-- Bucle foreach para mostrar todas las imágenes asociadas al anuncio -->
        @foreach ($anuncio->getMedia('imagenes') as $imagen)
            <img class="imageproduct" src="{{ $imagen->getUrl() }}" alt="{{ __('Image') }}">
        @endforeach

                <!-- SI no estas registrado salra boton que te lleva
                    a hacer login, si estas registrado y no eres el
                    anuunciante salra el boton de reservar -->
        @if (auth()->user())
            @if (auth()->user()->id != $anuncio->user_id && isset($anuncio->pick_points) && $anuncio->pick_points != 'null')
                @if ($anuncio->state == 'publicado')
                    <a class="btn btn-primary" href="{{ route('ad.reserve', $anuncio->id) }}">{{ __('Reserve') }}</a>
                @else
                    <button class="btn btn-primary" disabled>{{ __('This ad has already been reserved.') }}</a>
                @endif
            @endif
        @else
            <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Sign in to reserve') }}</a>
        @endif
    </div>
@endsection
