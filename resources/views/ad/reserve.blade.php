@extends('layout')

@section('content')
    <h1>{{__('You are about to reserve the product')}}: {{ $anuncio->title }}</h1>
    <p>{{__('Indicate the point where you wish to make the collection')}}</p>
    <form action="{{ route('ad.reserveSave', $anuncio->id) }}" method="POST">
       @csrf
        @foreach ($pickPoints as $pickPoint)
            <div>
                <input type="radio" name="pickpoint" value="{{ $pickPoint->id }}"><label
                    for="pickpoint">{{ $pickPoint->name }} ({{ $pickPoint->direccion }})</label>
            </div>
        @endforeach
        <input class="btn btn-primary" type="submit" value="{{__('Reserve')}}">
    </form>
@endsection
