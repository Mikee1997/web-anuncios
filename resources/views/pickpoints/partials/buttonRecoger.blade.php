<form action="{{ route('pickPoints.recieve', $anuncio->id) }}"
    method="post">
    @csrf
    <input class="btn btn-primary btn-confirm"
        confirm-text="¿Esta seguro de recepcionar {{ $anuncio->title }}?"
         type="submit" value="{{ __('Recibir') }}" />
</form>
