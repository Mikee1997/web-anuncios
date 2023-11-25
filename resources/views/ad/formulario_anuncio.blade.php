@extends('layout')
@section('content')
    <div class="d-flex justify-content-center">
        <!-- Enlace para regresar al panel de control -->
        <a href="{{ route('dashboard') }}">{{ __('Back') }}</a>
        <!-- Formulario para crear o editar un anuncio -->
        <form action="{{ isset($anuncio) ? route('ad.update', $anuncio) : route('ad.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <!-- Verificación de edición para usar el método PATCH -->
            @if (isset($anuncio))
                @method('PATCH')
            @endif

            <!-- Campos del formulario -->
            <label for="title">{{ __('Title') }}:</label>
            <input required type="text" id="title" name="title" value="{{ $anuncio->title ?? '' }}" />
            <label for="short_description">{{ __('Short description') }}:</label>
            <input required type="text" id="short_description" name="short_description"
                value="{{ $anuncio->short_description ?? '' }}" />
            <label for="long_description">{{ __('Large description') }}:</label>
            <textarea required id="long_description" name="long_description" value="{{ $anuncio->long_description ?? '' }}">{{ $anuncio->long_description ?? '' }}</textarea>
            <label for="phone">{{ __('Phone') }}:</label>
            <input required type="tel" id="phone" name="phone" value="{{ $anuncio->phone ?? '' }}" />
            <label for="email">Email:</label>
            <input required type="email" id="email" name="email" value="{{ $anuncio->email ?? '' }}" />

            <!-- Edición de imágenes -->
            @if (isset($anuncio) && $anuncio->hasMedia('imagenes'))
                @foreach ($anuncio->getMedia('imagenes') as $imagen)
                    <img id="image_preview" src="{{ $imagen->getUrl() }}" alt="{{ __('Image') }}">
                    <label for="image">{{ __('Edit image') }}:</label>
                    <label class="btn btn-primary" for="image-input" id="custom-file-label">
                        {{ __('Select file') }}
                    </label>
                    <input id="image-input" name="image" type="file" accept="image/png, image/jpeg"
                        style="display: none;" onchange="updateFileName()" />
                    <div id="file-name"></div>
                @endforeach
            @else
                <img id="image_preview" style="display: none" src="#" alt="Imagen">
                <label for="image">{{ __('Upload image') }}:</label>
                <label class="btn btn-primary" for="image-input" id="custom-file-label">
                    {{ __('Select file') }}
                </label>
                <input id="image-input" name="image" type="file" accept="image/png, image/jpeg" style="display: none;"
                    onchange="updateFileName()" />
                <div id="file-name"></div>
            @endif

            <!-- Opción para eliminar la imagen -->
            <div id="div-delete" class="{{ isset($anuncio) && $anuncio->hasMedia('imagenes') ? '' : 'd-none' }}">
                <input id="delete_image" name="delete_image" type="checkbox">
                <label for="delete_image">{{ __('delete image') }}:</label>
            </div>

            <!-- Selección del punto de recogida -->
            <h3>{{ __('Pick up point') }}:</h3>
            @foreach ($pickPoints as $key => $pickPoint)
                <div>
                    <input name="pickpoint[{{ $pickPoint->id }}]" type="checkbox"
                        {{ isset($anuncio) && in_array($pickPoint->id, json_decode($anuncio->pick_points), true) ? 'checked' : '' }}>
                    <label for="pickpoint[{{ $pickPoint->id }}]">{{ $pickPoint->name }}
                        ({{ $pickPoint->direccion }})
                    </label>
                </div>
            @endforeach

            <!-- Botón para enviar el formulario -->
            <input class="btn btn-primary" type="submit"
                value="{{ isset($anuncio) ? __('Edit ad') : __('Create ad') }}" />
        </form>
    </div>
@endsection

<!-- Scripts adicionales para la vista -->
@push('js')
    <script>
        // Función que se ejecuta al cargar el documento
        $(document).ready(function() {
            // Manejo de cambios en la selección de imagen
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
            // Manejo de cambios en la opción de eliminar imagen
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
    <script>
        // Función para actualizar el nombre del archivo seleccionado
        function updateFileName() {
            const input = document.getElementById('image-input');
            const fileName = document.getElementById('file-name');
            const customFileLabel = document.getElementById('custom-file-label');
            // Verificar si se seleccionó un archivo
            if (input.files.length > 0) {
                const name = input.files[0].name;
                fileName.textContent = '{{ __('Selected file') }}: ' + name;
            } else {
                fileName.textContent = '';
            }
        }
    </script>
@endpush
