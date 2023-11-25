<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between h-16">
            <!-- Encabezado personalizado de la página -->
            <div class="flex sm:items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Pickups') }}
                </h2>
            </div>
            <!-- Etiqueta y formulario para seleccionar el punto de recogida -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <label for="pickpoint">{{ __('Select pickup point') }}:</label>
                <form action="{{ route('pickPoints.recogidas') }}" method='GET'>
                    @csrf
                    <!-- Menú desplegable con los puntos de recogida -->
                    <select name="pickpoint" id="pickpoint">
                        @foreach ($pickPoints as $pickpoint)
                            <!-- Opción seleccionada si coincide con el punto actual -->
                            <option {{ $selectedPickPoint == $pickpoint->id ? 'selected' : '' }}
                                value="{{ $pickpoint->id }}">
                                {{ $pickpoint->name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </x-slot>
    <!-- Contenido principal de la página -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Pestañas para cambiar entre secciones -->
                <div class="tab">
                    <button class="tablinks active" onclick="openTab(event, 'reservados')">{{ __('Reserved') }}</button>
                    <button class="tablinks"
                        onclick="openTab(event, 'pte-recogida')">{{ __('Pending collection') }}</button>
                    <button class="tablinks" onclick="openTab(event, 'delivered')">{{ __('Delivery history') }}</button>
                </div>
                <!-- Sección de anuncios reservados -->
                <div id="reservados" class="tabcontent" style="display: block">
                    <div class="p-6 text-gray-900">
                        <!-- Tabla para mostrar anuncios reservados -->
                        <table id="reserved-table" cellpadding="0" cellspacing="0" border="0"
                            class="table table-striped table-bordered dataTable" width="100%"
                            data-url="{{ route('ad.reservedDatatable', $selectedPickPoint) }}" data-order-column="0"
                            data-order-type="desc">
                            <thead>
                                <tr>
                                    <th data-name="id">Id</th>
                                    <th data-name="title">{{ __('Title') }}</th>
                                    <th data-name="seller">{{ __('Seller') }}</th>
                                    <th data-name="buyer">{{ __('Buyer') }}</th>
                                    <th data-name="reserved_at">{{ __('Reservation date') }}</th>
                                    <th data-name="actions">{{ __('Actions') }}</th>
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
                            </table>

                        </table>

                    </div>
                </div>
                <!-- Sección de anuncios pendientes de recogida -->
                <div id="pte-recogida" class="tabcontent">
                    <div class="p-6 text-gray-900">
                        <!-- Tabla para mostrar anuncios pendientes de recogida -->
                        <table id="pte-recogida-table" cellpadding="0" cellspacing="0" border="0"
                            class="table table-striped table-bordered dataTable" width="100%"
                            data-url="{{ route('ad.pteDatatable', $selectedPickPoint) }}" data-order-column="0"
                            data-order-type="desc">
                            <thead>
                                <tr>
                                    <th data-name="id">Id</th>
                                    <th data-name="title">{{ __('Title') }}</th>
                                    <th data-name="seller">{{ __('Seller') }}</th>
                                    <th data-name="buyer">{{ __('Buyer') }}</th>
                                    <th data-name="available_at">{{ __('Available from') }}</th>
                                    <th data-name="actions">{{ __('Actions') }}</th>
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
                            </table>

                        </table>

                    </div>
                </div>
                <!-- Sección de historial de entregas -->
                <div id="delivered" class="tabcontent">
                    <div class="p-6 text-gray-900">
                        <!-- Tabla para mostrar historial de entregas -->
                        <table id="delivered-table" cellpadding="0" cellspacing="0" border="0"
                            class="table table-striped table-bordered dataTable" width="100%"
                            data-url="{{ route('ad.deliveredDatatable', $selectedPickPoint) }}" data-order-column="0"
                            data-order-type="desc">
                            <thead>
                                <tr>
                                    <th data-name="id">Id</th>
                                    <th data-name="title">{{ __('Title') }}</th>
                                    <th data-name="seller">{{ __('Seller') }}</th>
                                    <th data-name="buyer">{{ __('Buyer') }}</th>
                                    <th data-name="dalivered_at">{{ __('Date of delivery') }}</th>
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
                            </table>

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
            // Función para cambiar entre pestañas
            function openTab(evt, name) {
                // Declarar todas las variables
                var i, tabcontent, tablinks;

                // Obtener todos los elementos con clase "tabcontent" y ocultarlos                tabcontent = document.getElementsByClassName("tabcontent");
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }

                // Obtener todos los elementos con clase "tablinks" y quitar la clase "active"                tablinks = document.getElementsByClassName("tablinks");
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                // Mostrar la pestaña actual y agregar una clase "active" al botón que abrió la pestaña
                document.getElementById(name).style.display = "block";
                evt.currentTarget.className += " active";
            }
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
