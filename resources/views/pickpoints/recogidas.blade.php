<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between h-16">
            <div class="flex sm:items-center">

                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Pickups') }}
                </h2>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <label for="pickpoint">{{__('Select pickup point')}}:</label>
                <form action="{{ route('pickPoints.recogidas') }}" method='GET'>
                    @csrf
                    <select name="pickpoint" id="pickpoint">
                        @foreach ($pickPoints as $pickpoint)
                            <option {{ $selectedPickPoint == $pickpoint->id ? 'selected' : '' }}
                                value="{{ $pickpoint->id }}">
                                {{ $pickpoint->name }}</option>
                        @endforeach
                    </select>
                </form>

            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="tab">
                    <button class="tablinks active" onclick="openTab(event, 'reservados')">{{__('Reserved')}}</button>
                    <button class="tablinks" onclick="openTab(event, 'pte-recogida')">{{__('Pending collection')}}</button>
                    <button class="tablinks" onclick="openTab(event, 'delivered')">{{__('Delivery history')}}</button>
                </div>

                <div id="reservados" class="tabcontent" style="display: block">
                    <div class="p-6 text-gray-900">

                            <table id="reserved-table" cellpadding="0" cellspacing="0" border="0"
                                class="table table-striped table-bordered dataTable" width="100%"
                                data-url="{{ route('ad.reservedDatatable', $selectedPickPoint) }}"
                                data-order-column="0" data-order-type="desc">
                                <thead>
                                    <tr>
                                        <th data-name="id">Id</th>
                                        <th data-name="title">{{__('Title')}}</th>
                                        <th data-name="seller">{{__('Seller')}}</th>
                                        <th data-name="buyer">{{__('Buyer')}}</th>
                                        <th data-name="reserved_at">{{__('Reservation date')}}</th>
                                        <th data-name="actions">{{__('Actions')}}</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th data-name="id"></th>
                                        <th data-name="title"></th>
                                        <th data-name="seller"></th>
                                        <th data-name="buyer"></th>
                                        <th data-name="actions"></th>
                                    </tr>
                                </tfoot>
                                <tbody></tbody>

                            </table>

                    </div>
                </div>

                <div id="pte-recogida" class="tabcontent">
                    <div class="p-6 text-gray-900">
                            {{-- <table class="table table-hover">
                                <tr>
                                    <th>
                                        {{ __('Titulo') }}
                                    </th>
                                    <th>
                                        {{ __('vendedor') }}
                                    </th>
                                    <th>
                                        {{ __('comprador') }}
                                    </th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                                @foreach ($anunciosPteRecogida as $anuncio)
                                    <tr>
                                        <td>
                                            {{ $anuncio->title }}
                                        </td>
                                        <td>
                                            {{ $anuncio->user->name }}
                                        </td>
                                        <td>
                                            {{ $anuncio->buyer->name }}
                                        </td>
                                        <td>

                                            <form action="{{ route('pickPoints.delive', $anuncio->id) }}"
                                                method="post">
                                                @csrf
                                                <input class="btn btn-primary btn-confirm"
                                                    confirm-text="¿Esta seguro de entregar {{ $anuncio->title }}?"
                                                    disabled type="submit" value="{{ __('Entregar') }}" />
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table> --}}
                            <table id="pte-recogida-table" cellpadding="0" cellspacing="0" border="0"
                                class="table table-striped table-bordered dataTable" width="100%"
                                data-url="{{ route('ad.pteDatatable', $selectedPickPoint) }}"
                                data-order-column="0" data-order-type="desc">
                                <thead>
                                    <tr>
                                        <th data-name="id">Id</th>
                                        <th data-name="title">{{__('Title')}}</th>
                                        <th data-name="seller">{{__('Seller')}}</th>
                                        <th data-name="buyer">{{__('Buyer')}}</th>
                                        <th data-name="available_at">{{__('Available from')}}</th>
                                        <th data-name="actions">{{__('Actions')}}</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th data-name="id"></th>
                                        <th data-name="title"></th>
                                        <th data-name="seller"></th>
                                        <th data-name="buyer"></th>
                                        <th data-name="actions"></th>
                                    </tr>
                                </tfoot>
                                <tbody></tbody>

                            </table>

                    </div>
                </div>

                <div id="delivered" class="tabcontent">
                    <div class="p-6 text-gray-900">
                            <table id="delivered-table" cellpadding="0" cellspacing="0" border="0"
                                class="table table-striped table-bordered dataTable" width="100%"
                                data-url="{{ route('ad.deliveredDatatable', $selectedPickPoint) }}"
                                data-order-column="0" data-order-type="desc">
                                <thead>
                                    <tr>
                                        <th data-name="id">Id</th>
                                        <th data-name="title">{{__('Title')}}</th>
                                        <th data-name="seller">{{__('Seller')}}</th>
                                        <th data-name="buyer">{{__('Buyer')}}</th>
                                        <th data-name="dalivered_at">{{__('Date of delivery')}}</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th data-name="id"></th>
                                        <th data-name="title"></th>
                                        <th data-name="seller"></th>
                                        <th data-name="buyer"></th>
                                        <th data-name="dalivered_at"></th>
                                    </tr>
                                </tfoot>
                                <tbody></tbody>

                            </table>

                    </div>
                </div>


            </div>
        </div>
    </div>




    </div>
    </div>

    </div>

    </div>

    @push('js')
        <script>
            function openTab(evt, name) {
                // Declare all variables
                var i, tabcontent, tablinks;

                // Get all elements with class="tabcontent" and hide them
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }

                // Get all elements with class="tablinks" and remove the class "active"
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }

                // Show the current tab, and add an "active" class to the button that opened the tab
                document.getElementById(name).style.display = "block";
                evt.currentTarget.className += " active";
            }

            $(document).ready(function() {
                // // Obtén la instancia de la tabla DataTables existente
                // var tabla = $('#delivered-table').DataTable();

                // // Establece el nuevo ancho para la segunda columna (índice 1)
                // tabla.column(1).width('10px').draw();

            });
        </script>
    @endpush

    @push('css')
        <style>
            #delivered-table tbody tr td:nth-child(1) {
                width: 40px;
                /* Ajusta el ancho de la primera columna */
            }

            #delivered-table tbody tr td:nth-child(2) {
                width: 100px;
                /* Ajusta el ancho de la segunda columna */
            }
        </style>
    @endpush

</x-app-layout>
