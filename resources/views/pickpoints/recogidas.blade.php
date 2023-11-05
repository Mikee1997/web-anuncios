<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between h-16">
            <div class="flex sm:items-center">

                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Recogidas') }}
                </h2>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <label for="pickpoint">Selecciona punto de recogida:</label>
                <form action="{{route('pickPoints.recogidas')}}" method='GET'>
                    @csrf
                    <select name="pickpoint" id="pickpoint">
                        @foreach ($pickPoints as $pickpoint )
                            <option {{$selectedPickPoint==$pickpoint->id?'selected':''}} value="{{$pickpoint->id}}">{{$pickpoint->name}}</option>
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
                    <button class="tablinks active" onclick="openTab(event, 'reservados')">Reservados</button>
                    <button class="tablinks" onclick="openTab(event, 'pte-recogida')">Pendiente recogida</button>
                    <button class="tablinks" onclick="openTab(event, 'delivered')">Historico de entregados</button>
                </div>

                <div id="reservados" class="tabcontent" style="display: block">
                    <div class="p-6 text-gray-900">
                        @if ($anunciosReservados->count() > 0)
                            <table class="table table-hover">
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
                                @foreach ($anunciosReservados as $anuncio)
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

                                            <form action="{{ route('pickPoints.recieve', $anuncio->id) }}"
                                                method="post">
                                                @csrf
                                                <input class="btn btn-primary btn-confirm"
                                                    confirm-text="¿Esta seguro de recepcionar {{ $anuncio->title }}?"
                                                    disabled type="submit" value="{{ __('Recibir') }}" />
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>{{ __('No hay anuncios pendientes de recogida') }}</p>
                        @endif
                    </div>
                </div>

                <div id="pte-recogida" class="tabcontent">
                    <div class="p-6 text-gray-900">
                        @if ($anunciosPteRecogida->count() > 0)
                            <table class="table table-hover">
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
                            </table>
                        @else
                            <p>{{ __('No hay anuncios pendientes de entrega') }}</p>
                        @endif
                    </div>
                </div>

                <div id="delivered" class="tabcontent">
                    <div class="p-6 text-gray-900">
                        @if ($anunciosEntregados->count() > 0)
                            <table class="table table-hover">
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
                                </tr>
                                @foreach ($anunciosEntregados as $anuncio)
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

                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>{{ __('No hay anuncios entregados') }}</p>
                        @endif
                    </div>
                </div>


            </div>
        </div>
    </div>



    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    {{-- @if ($pickPoints->count() > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>
                                    {{ __('Name') }}
                                </th>
                                <th>
                                    {{ __('Address') }}
                                </th>
                                <th>
                                    {{ __('created at') }}
                                </th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                            @foreach ($pickPoints as $pickPoint)
                                <tr>
                                    <td>
                                        {{$pickPoint->name}}
                                    </td>
                                    <td>
                                        {{$pickPoint->direccion}}
                                    </td>
                                    <td>
                                        {{$pickPoint->created_at}}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{route('pickPoints.edit',$pickPoint->id)}}">{{__('Edit')}}</a>
                                        <form action="{{route('pickPoints.delete',$pickPoint->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input class="btn btn-danger" type="submit" value="{{__('Delete')}}"/>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <a href="{{route('pickPoints.create')}}">{{__('Create your first pick up pont')}}</a>
                    @endif --}}
    </div>
    </div>

    </div>

    </div> --}}

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
        </script>
    @endpush

</x-app-layout>
