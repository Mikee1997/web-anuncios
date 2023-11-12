<form action="{{ route('pickPoints.delive', $anuncio->id) }}"
    method="post">
    @csrf
    <input class="btn btn-primary btn-confirm"
        confirm-text="{{__('Are you sure you are deliving')}} {{ $anuncio->title }}?"
         type="submit" value="{{ __('Deliver') }}" />
</form>
