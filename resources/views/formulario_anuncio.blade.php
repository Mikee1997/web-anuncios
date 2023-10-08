@extends('layout')

@section('content')
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
    <a href="{{ route('dashboard') }}">{{ __('back') }}</a>
    <form action="{{ isset($anuncio) ? route('ad.update',$anuncio) : route('storeAd') }}" method="POST">
        @csrf
        @if (isset($anuncio))
            @method('PATCH')
        @endif
        <label for="title">Titulo:</label>
        <input required type="text" id="title" name="title" value="{{$anuncio->title??''}}" />
        <label for="short_description">Descripción corta:</label>
        <input required type="text" id="short_description" name="short_description" value="{{$anuncio->short_description??''}}" />
        <label for="long_description">Descripción larga:</label>
        <textarea required id="long_description" name="long_description" value="{{$anuncio->long_description??''}}">{{$anuncio->long_description??''}}</textarea>
        <label for="phone">Teléfono:</label>
        <input required type="tel" id="phone" name="phone" value="{{$anuncio->phone??''}}"/>
        <label for="email">Email:</label>
        <input required type="email" id="email" name="email" value="{{$anuncio->email??''}}" />
        <input type="submit" value="{{isset($anuncio) ?__('edit ad'):__('create ad')}}" />

    </form>
@endsection
