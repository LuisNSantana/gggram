<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //hacems el constructor para proteger la ruta
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //nombre de carpeta y archivo.
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        //se utiliza el metodo slug de la clase Str para convertir el username en una url y evitar problemas de tipado
        $request->request->add(['username' => Str::slug($request->username)]);
        //not_in es para prohibir que se registren nombres en una tabla, como filtrar.
        $this->validate($request, [
            'username' => ['required', 'min:4', 'max:20', 'unique:users,username,' . auth()->user()->id, 'not_in:twitter,editar-perfil,instagram']
        ]);

        if ($request->imagen) {

            $imagen = $request->file('imagen');

            //esto lo que hace es generar un codigo unico como una especie de id para cada imagen por eso se utiliza uuid.
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            //esta es la clase que nos permite crear una imagen de intervention image Image::make()
            $imagenServidor = Image::make($imagen);
            //fit es un efecto de intervention image
            $imagenServidor->fit(1000, 1000,);
            //crea la ubicacion de las imagenes subidas
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            //guardar las imagenes que estan en memoria o servidor en la ruta que instanciamos anteriormente con el nombre cuando ya fue procesada.
            $imagenServidor->save($imagenPath);
        }

        //Guardar Cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        //save para almacenar en la bd
        $usuario->save();

        //Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
