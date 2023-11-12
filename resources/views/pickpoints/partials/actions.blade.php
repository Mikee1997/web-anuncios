<a class="btn btn-primary" href="{{ route('pickPoints.edit', $pickPoint->id) }}">{{ __('Edit') }}</a>
<form action="{{ route('pickPoints.delete', $pickPoint->id) }}" method="post">
    @csrf
    @method('delete')
    <input class="btn btn-danger btn-confirm" confirm-text="¿Esta seguro de eliminar {{ $pickPoint->name }}?" 
        type="submit" value="{{ __('Delete') }}" />
</form>
