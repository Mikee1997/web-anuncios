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
                        {{-- <table class="table table-hover">
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
                        </table> --}}
                        <table id="ad-table" cellpadding="0" cellspacing="0" border="0"
                        class="table table-striped table-bordered dataTable" width="100%"
                        data-url="{{ route('ad.myAdsDatatable') }}"
                        data-order-column="0" data-order-type="desc">
                        <thead>
                            <tr>

                                <th data-name="title">
                                    {{ __('Title') }}
                                </th>
                                <th data-name="created_at">
                                    {{ __('created at') }}
                                </th>
                                <th data-name="updated_at">
                                    {{ __('updated at') }}
                                </th>
                                <th data-name="state">{{ __('Estado') }}</th>
                                <th data-name="actions">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th data-name="title"></th>
                                <th data-name="created_at"></th>
                                <th data-name="updated_at"></th>
                                <th data-name="state"></th>
                                <th data-name="actions"></th>
                            </tr>
                        </tfoot>
                        <tbody></tbody>

                    </table>
                </div>
            </div>

        </div>

    </div>





</x-app-layout>
