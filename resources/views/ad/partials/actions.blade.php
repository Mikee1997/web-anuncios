<a class="btn btn-primary" href="{{ route('ad.edit', $anuncio->id) }}">{{ __('Edit') }}</a>
<form action="{{ route('ad.delete', $anuncio->id) }}" method="post">
    @csrf
    @method('delete')
    <input class="btn btn-danger btn-confirm" confirm-text="{{__('Are you sure you want to delete')}} {{ $anuncio->title }}?"
        type="submit" value="{{ __('Delete') }}" />
</form>
