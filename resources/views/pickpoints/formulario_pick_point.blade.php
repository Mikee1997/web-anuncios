@extends('layout')

@section('content')

    <div class="d-flex justify-content-center">

        <a href="{{ route('pickPoints.index') }}">{{ __('Back') }}</a>
        <form action="{{ isset($pickPoint) ? route('pickPoints.update', $pickPoint) : route('pickPoints.store') }}"
            method="POST">
            @csrf
            @if (isset($pickPoint))
                @method('PATCH')
            @endif
            <label for="name">Nombre:</label>
            <input required type="text" id="name" name="name" value="{{ $pickPoint->name ?? '' }}" />
            <label for="direccion">Dirección:</label>
            <input required type="text" id="direccion" name="direccion" value="{{ $pickPoint->direccion ?? '' }}" />
            <input class="btn btn-primary" type="submit"
                value="{{ isset($pickPoint) ? __('Edit pick up point') : __('Create pick up point') }}" />
        </form>
    </div>
@endsection
