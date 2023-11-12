@extends('layout')

@section('content')
    <div class="text-center aling-center d-grid justify-content-center">
        <h1>{{__('ad detail')}}</h1>
        <h2>{{ $anuncio->title }}</h2>
        <h3>{{ $anuncio->short_description }}</h3>
        <p>{{ $anuncio->long_description }}</p>
        <p><strong>{{__('Phone')}}: </strong>{{ $anuncio->phone }}</p>
        <p><strong>Email: </strong>{{ $anuncio->email }}</p>
        @foreach ($anuncio->getMedia('imagenes') as $imagen)
            <img class="imageproduct" src="{{ $imagen->getUrl() }}" alt="{{__('Image')}}">
        @endforeach
        @if (auth()->user())
            @if (auth()->user()->id != $anuncio->user_id&&isset($anuncio->pick_points)&&$anuncio->pick_points!="null")
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
