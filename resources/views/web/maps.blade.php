@extends('layout.app')
@section('content')
    <div class="container">
        <h1>Mapas de Didactalia</h1>
        <div class="container">
        @foreach($mapas as $mapa)
          <div class="card">
              <img src="{{$mapa['imagen']}}"width="200" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">{{$mapa['titulo']}}</h5>
                <p class="card-text">{{$mapa['subtitulo']}}</p>
                <a href="{{route('maps.show',$mapa['link'])}}" class="btn btn-primary">Entrar</a>
              </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection