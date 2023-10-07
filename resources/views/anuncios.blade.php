<!--resources/views/anuncios_blade.php-->
<h1>Listado de Anuncios</h1>
<ul>
    @foreach($anuncios as $anuncio)
    <li>{{$anuncio->titulo}}</li>
    @endforeach
</ul>
