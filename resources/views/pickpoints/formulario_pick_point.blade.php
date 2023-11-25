@extends('layout')
@section('content')
    <div class="d-flex justify-content-center">
        <a href="{{ route('pickPoints.index') }}">{{ __('Back') }}</a>

        <!-- Formulario para la creación o edición de puntos de recogida -->
        <form action="{{ isset($pickPoint) ? route('pickPoints.update', $pickPoint) : route('pickPoints.store') }}"
            method="POST">
            @csrf
            <!-- Método PATCH para la actualización de un punto de recogida existente -->
            @if (isset($pickPoint))
                @method('PATCH')
            @endif

            <!-- Campos para el nombre y la dirección del punto de recogida -->
            <label for="name">{{ __('Name') }}:</label>
            <input required type="text" id="name" name="name" value="{{ $pickPoint->name ?? '' }}" />
            <label for="direccion">{{ __('Address') }}:</label>
            <input required type="text" id="direccion" name="direccion" value="{{ $pickPoint->direccion ?? '' }}" />

            <!-- Botón de envío del formulario, con etiqueta dinámica según la acción -->
            <input class="btn btn-primary" type="submit"
                value="{{ isset($pickPoint) ? __('Edit pick up point') : __('Create pick up point') }}" />
        </form>
    </div>
@endsection
