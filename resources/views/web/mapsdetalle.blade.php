@extends('layout.app')
@section('content')
    <div class="container">
        <div class="container">
            <!-- Titulo y encabezado del mapa-->
            <div class="row">
                <div class="col">
                    <h3>
                        Mapa: {{$mapas[0]['titulo']}}
                    </h3>

                    <h5>
                        {{$mapas[0]['subtitulo']}}
                    </h5>
                </div>
            </div>
            <!-- imagen del mapa-->
            <div class="row">
                <div class="col">
                    <img src="{{ $mapas[0]['imagen']}}" class="img-fluid" alt="...">
                </div>
            </div>
            <!-- Detalles-->
              <div class="row">
                <div class="col">
                    Descripci&oacute;n:
                </div>
                <div class="col">
                    <p>
                        {{$mapas[0]['descripcion']}}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Localizaci&oacute;n:
                </div>
                <div class="col">
                    <h6>
                        Continente
                    </h6>
                    <p>
                        <a href="{{$mapas[0]['urlcontinente']}}" target="_blank">
                            {{$mapas[0]['continente']}}
                        </a>
                        
                    </p>
                    <h6>
                        Pa&iacute;s
                    </h6>
                    <p>
                        <a href="{{$mapas[0]['urlpais']}}" target="_blank">
                            {{$mapas[0]['pais']}}
                        </a>
                    </p>
                    <h6>
                        CCAA/Regi&oacute;n
                    </h6>
                    <p>
                        <a href="{{$mapas[0]['urlregion']}}" target="_blank">
                            {{$mapas[0]['region']}}
                        </a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                  Tipo de Juego:
                </div>
                <div class="col">
                    {{$mapas[0]['tipojuego']}}
                </div>
              </div>
            </div>
    </div>
@endsection