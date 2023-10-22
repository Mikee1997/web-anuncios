@extends('layout')

@section('content')
    <div class="d-flex justify-content-center">

        <a href="{{ route('dashboard') }}">{{ __('Back') }}</a>
        <form action="{{ isset($anuncio) ? route('ad.update', $anuncio) : route('ad.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if (isset($anuncio))
                @method('PATCH')
            @endif
            <label for="title">Titulo:</label>
            <input required type="text" id="title" name="title" value="{{ $anuncio->title ?? '' }}" />
            <label for="short_description">Descripción corta:</label>
            <input required type="text" id="short_description" name="short_description"
                value="{{ $anuncio->short_description ?? '' }}" />
            <label for="long_description">Descripción larga:</label>
            <textarea required id="long_description" name="long_description" value="{{ $anuncio->long_description ?? '' }}">{{ $anuncio->long_description ?? '' }}</textarea>
            <label for="phone">Teléfono:</label>
            <input required type="tel" id="phone" name="phone" value="{{ $anuncio->phone ?? '' }}" />
            <label for="email">Email:</label>
            <input required type="email" id="email" name="email" value="{{ $anuncio->email ?? '' }}" />
            @if (isset($anuncio) && $anuncio->hasMedia('imagenes'))
                @foreach ($anuncio->getMedia('imagenes') as $imagen)
                    <img id="image_preview" src="{{ $imagen->getUrl() }}" alt="Imagen">
                    <label for="image">{{ __('Modificar imagen') }}:</label>
                    <input id="image-input" name="image" type="file" accept="image/png, image/jpeg" />
                @endforeach
            @else
                <img id="image_preview" style="display: none" src="#" alt="Imagen">
                <label for="image">{{ __('Subir imagen') }}:</label>
                <input id="image-input" name="image" type="file" accept="image/png, image/jpeg" />
            @endif
            <div id="div-delete" class="{{ isset($anuncio) && $anuncio->hasMedia('imagenes') ? '' : 'd-none' }}">
                <input id="delete_image" name="delete_image" type="checkbox">
                <label for="delete_image">{{ __('borrar imagen') }}:</label>
            </div>
            <h3>Puntos de recogida:</h3>
            @foreach ($pickPoints as $key=>$pickPoint)
                <div>
                    <input name="pickpoint[{{ $pickPoint->id }}]" type="checkbox" {{isset($anuncio)&&in_array($pickPoint->id,json_decode($anuncio->pick_points),true)?'checked':''}}>
                    <label for="pickpoint[{{ $pickPoint->id }}]">{{ $pickPoint->name }} ({{ $pickPoint->direccion }})</label>
                </div>
            @endforeach
            <input class="btn btn-primary" type="submit"
                value="{{ isset($anuncio) ? __('Edit ad') : __('Create ad') }}" />


        </form>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#image-input').on('change', function() {
                var file = this.files[0];
                // Verificar si se seleccionó un archivo
                if (file) {
                    console.log('test');
                    var reader = new FileReader();

                    // Cuando se carga el archivo
                    reader.onload = function(e) {
                        // Establecer la vista previa de la imagen
                        $('#image_preview').attr('src', e.target.result);
                        $('#image_preview').show();
                        console.log('test');
                        $('#div-delete').removeClass('d-none');

                    };

                    // Leer el archivo como una URL de datos
                    reader.readAsDataURL(file);
                } else {
                    // Borrar la vista previa si no se selecciona un archivo
                    $('#image_preview').attr('src', '');
                    $('#image_preview').hidden();
                }
            });
            $('#delete_image').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#image-input').val('');
                    $('#image-input').hide();
                    $('#image_preview').hide();
                } else {
                    $('#image-input').show();
                    $('#image_preview').show();
                }
            })
        })
    </script>
@endpush
