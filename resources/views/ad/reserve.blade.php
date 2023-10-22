@extends('layout')

@section('content')
    <h1>Estas a punto de reservar el producto: {{ $anuncio->title }}</h1>
    <p>Indica el punto donde desear realizar la recogida</p>
    <form action="{{ route('ad.reserveSave', $anuncio->id) }}" method="POST">
       @csrf
        @foreach ($pickPoints as $pickPoint)
            <div>
                <input type="radio" name="pickpoint" value="{{ $pickPoint->id }}"><label
                    for="pickpoint">{{ $pickPoint->name }} ({{ $pickPoint->direccion }})</label>
            </div>
        @endforeach
        <input class="btn btn-primary" type="submit" value="RESERVAR">
    </form>
@endsection
