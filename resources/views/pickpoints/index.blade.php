<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('pick up point') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Pick up point') }} <a class="btn btn-primary" href="{{route('pickPoints.create')}}">{{__('Create pick up point')}}</a>
                </div>
                <div class="p-6 text-gray-900">
                        <table id="pickpoints-table" cellpadding="0" cellspacing="0" border="0"
                                class="table table-striped table-bordered dataTable" width="100%"
                                data-url="{{ route('pickPoints.datatable') }}"
                                data-order-column="0" data-order-type="desc">
                                <thead>
                                    <tr>
                                        <th data-name="name">
                                            {{ __('Name') }}
                                        </th>
                                        <th data-name="direccion">
                                            {{ __('Address') }}
                                        </th>
                                        <th data-name="created_at">
                                            {{ __('created at') }}
                                        </th>
                                        <th data-name="actions">{{ __('Actions') }}</th>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th data-name="name"></th>
                                        <th data-name="direccion"></th>
                                        <th data-name="created_at"></th>
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
