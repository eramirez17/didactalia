<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\MapController;
use Illuminate\Http\Request;
use \App\Models\Map;
require '../vendor/autoload.php';
class PageController extends Controller
{
    public function Mapa($id){
	}

    public function Error(){
        $wsdl = 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/MapasDidactalia?rdf';
        $sioc = \EasyRdf\Graph::newAndLoad($wsdl);
        $file = $sioc->toRdfPhp();
        echo "<a href='inicio'><button type='button' class='btn btn-primary'>Listar Mapas</button></a>";
        echo "<pre>";
        print_r($sioc);
        echo "</pre>";
        return view('web.maps', compact('file'));
    }

    public function Mapas(){
    }
}