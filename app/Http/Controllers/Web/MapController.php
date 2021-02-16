<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

use App\Models\Map;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i = 0;
        unset($file);
        $linksMap = $this->getArray(2);
        foreach ($linksMap as $mapa) {
            $wsdl = $mapa.'?rdf';
            $sioc = \EasyRdf\Graph::newAndLoad($wsdl);
            $file[$i]['graph'] = $sioc->toRdfPhp();
            $file[$i]['url'] = $linksMap[$i];
            $i++;
        }
        $mapas = $this->cards($file);
        return view('web.maps', compact('mapas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $i = 0;
        unset($file);
        $linksMap = $this->getArray(2);
        foreach ($linksMap as $mapa) {
            $wsdl = $mapa.'?rdf';
            $sioc = \EasyRdf\Graph::newAndLoad($wsdl);
            $file[$i]['graph'] = $sioc->toRdfPhp();
            $file[$i]['url'] = $linksMap[$i];
            $i++;
        }
        $mapas = $this->cards($file);
        $u = 0;
        foreach ($mapas as $linea) {
            $xls[$u]['url'] = 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/'.$linea['link'];
            $xls[$u]['titulo'] = $linea['titulo'];
            $xls[$u]['descripcion'] = $linea['descripcion'];
            $xls[$u]['continente'] = $linea['continente'];
            $xls[$u]['urlcontinente'] = $linea['urlcontinente'];
            $xls[$u]['pais'] = $linea['pais'];

            $xls[$u]['urlpais'] = $linea['urlpais'];
            $xls[$u]['region'] = $linea['region'];
            $xls[$u]['urlregion'] = $linea['urlregion'];
            $xls[$u]['tipojuego'] = $linea['tipojuego'];
            $u++;

        }

        $fp = fopen('../storage/app/public/lista-de-mapas.csv', 'w');

        foreach ($xls as $campos) {
            fputcsv($fp, $campos);
        }

        fclose($fp);
        $path = "../../storage/app/public/lista-de-mapas.csv";

        return view('web.descarga',compact('path'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = str_replace('_','/',$id);
        $url = 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/'.$id.'?rdf';
        $sioc = \EasyRdf\Graph::newAndLoad($url);
        $file[0]['graph'] = $sioc->toRdfPhp();
        $file[0]['url'] = 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/'.$id;
        $mapas = $this->cards($file);
        return view('web.mapsdetalle', compact('mapas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function cards($file){
        unset($mapas);
        $f = 0;
        foreach ($file as $mapa) {
            $link = explode('/', $mapa['url']);
            $code = sizeof($link)-1;
            $caption = sizeof($link)-2;
            $link = $link[$caption].'_'.$link[$code];
            $index = $mapa['graph'][$mapa['url']]['gnoss:has_docSem'][0]['value'];
            $mapas[$f]['imagen'] = $mapa['graph'][$index]['didmap:image'][0]['value'];
            $mapas[$f]['titulo'] = $mapa['graph'][$index]['http://purl.org/dc/terms/title'][0]['value'];
            $mapas[$f]['subtitulo'] = $mapa['graph'][$index]['didmap:subtitle'][0]['value'];
            $mapas[$f]['link'] = $link;

            $mapas[$f]['descripcion'] = $mapa['graph'][$index]['http://purl.org/dc/terms/description'][0]['value'];

             if (array_key_exists('didmap:continent',$mapa['graph'])) {
                $mapas[$f]['continente'] = $mapa['graph'][$index]['didmap:continent'][0]['value'];
                $mapas[$f]['urlcontinente'] = $mapa['graph']['http://geonames.org/6255148']['http://www.geonames.org/ontology#name'][0]['value'];
            } else {
                $mapas[$f]['continente'] = "";
                $mapas[$f]['urlcontinente'] = "";
            }
            if (array_key_exists('didmap:country',$mapa['graph'])) {
                $mapas[$f]['pais'] = $mapa['graph'][$index]['didmap:country'][0]['value'];
                $mapas[$f]['urlpais'] = $mapa['graph']['http://geonames.org/2510769']['http://www.geonames.org/ontology#name'][0]['value'];
            } else {
                $mapas[$f]['pais'] = "";
                $mapas[$f]['urlpais'] = "";
            }
            if (array_key_exists('didmap:region',$mapa['graph'])) {
                $mapas[$f]['region'] = $mapa['graph'][$index]['didmap:region'][0]['value'];
                $mapas[$f]['urlregion'] = $mapa['graph']['http://geonames.org/3336897']['http://www.geonames.org/ontology#name'][0]['value'];
            } else {
                $mapas[$f]['region'] = "";
                $mapas[$f]['urlregion'] = "";
            }
            for ($n=1; $n < 10; $n++) { 
                $gametype = 'http://didactalia.net/items/gameType_'.$n;
                if (array_key_exists($gametype,$mapa['graph'])){
                    $mapas[$f]['tipojuego'] = $mapa['graph'][$gametype]['aux201403241:textValue'][0]['value'];
                    $n = 10;
                }else{
                    $mapas[$f]['tipojuego'] = "";
                }
            }
            $f++;
        }
        return $mapas;
    }
    public function getArray($cant=1){
        $linksMap = array('0' => 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/provincias-de-espaa/108fb9ee-6654-465a-a9ed-e84be977a27a',
            '1' => 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/relieve-de-espaa/b08c36e5-ed54-46e1-995f-354b59d8dd08',
            '2' => 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/comunidades-autonomas-de-espaa/9d65ad7b-1679-44ad-951f-e0a275288cde',
            '3' => 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/rios-de-espaa/6b90cb5d-8084-4d44-9cc6-990fe7068e38',
            '4' => 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/rios-de-espaa/baf5ae9b-b0f9-4476-a05e-8465d60b21a1',
            '5' => 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/relieve-de-europa/a62b3ad4-afed-4e56-ad45-2c3ac42c0a81',
            '6' => 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/mapa-de-europa-paises/4d575284-caef-4352-a22a-1a64e6c93337',
            '7' => 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/estados-de-mexico/23c9a9ce-1070-4c34-8bc1-034f0906a433',
            '8' => 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/paises-de-asia/bc63038f-2f18-4d0c-9580-ce82c37d8015',
            '9' => 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/paises-de-africa/1ec30038-fd1a-4dcb-9a91-01217efdd8c2',
            '10' => 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/rios-de-europa/0973d01b-60b4-403d-9954-1963fa5f8cc5',
            '11' => 'https://mapasinteractivos.didactalia.net/comunidad/mapasflashinteractivos/recurso/paises-de-america-del-sur/55343e4e-621e-4bba-8f37-ba956a6fd5ca',
         );
        $cant = ($cant>12) ? 12 : $cant ;
        for ($i=0; $i < $cant; $i++) { 
            $enlace[$i] = $linksMap[$i];
        }
        return $enlace;
    }
}
