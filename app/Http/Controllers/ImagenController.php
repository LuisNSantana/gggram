<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {

        $imagen = $request->file('file');

        //esto lo que hace es generar un codigo unico como una especie de id para cada imagen por eso se utiliza uuid.
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //esta es la clase que nos permite crear una imagen de intervention image Image::make()
        $imagenServidor = Image::make($imagen);
        //fit es un efecto de intervention image
        $imagenServidor->fit(1000, 1000,);
        //crea la ubicacion de las imagenes subidas
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        //guardar las imagenes que estan en memoria o servidor en la ruta que instanciamos anteriormente con el nombre cuando ya fue procesada.
        $imagenServidor->save($imagenPath);

        //aca retornamos el nombre de la imagen ese es el nombre que vamos almacenar en la BD. Nunca se deben almacenar las imagenes.
        return response()->json(['imagen' => $nombreImagen]);
    }
}
