<form action="{{ route('pickPoints.recieve', $anuncio->id) }}"
    method="post">
    @csrf
    <input class="btn btn-primary btn-confirm"
        confirm-text="{{__('Are you sure you are receiving')}} {{ $anuncio->title }}?"
         type="submit" value="{{ __('Receive') }}" />
</form>
