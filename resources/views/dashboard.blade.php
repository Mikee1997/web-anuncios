<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Your ads') }} <a class="btn btn-primary"
                        href="{{ route('ad.create') }}">{{ __('Create ad') }}</a>
                </div>
                <div class="p-6 text-gray-900">
                    @if ($anuncios->count() > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>
                                    {{ __('Title') }}
                                </th>
                                <th>
                                    {{ __('created at') }}
                                </th>
                                <th>
                                    {{ __('updated at') }}
                                </th>
                                <th>{{ __('Estado') }}</th>

                                <th>{{ __('Actions') }}</th>
                            </tr>
                            @foreach ($anuncios as $anuncio)
                                <tr>
                                    <td>
                                        {{ $anuncio->title }}
                                    </td>
                                    <td>
                                        {{ $anuncio->created_at }}
                                    </td>
                                    <td>
                                        {{ $anuncio->updated_at }}
                                    </td>
                                    <td>
                                        {{ $anuncio->state == 'delivered' ? 'Entregado' : $anuncio->state }}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ route('ad.edit', $anuncio->id) }}">{{ __('Edit') }}</a>
                                        <form action="{{ route('ad.delete', $anuncio->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input class="btn btn-danger btn-confirm" confirm-text="¿Esta seguro de borrar {{$anuncio->title}}?" disabled type="submit"
                                                value="{{ __('Delete') }}" />
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <a href="{{ route('ad.create') }}">{{ __('Create your first ad') }}</a>
                    @endif
                </div>
            </div>

        </div>

    </div>





</x-app-layout>
