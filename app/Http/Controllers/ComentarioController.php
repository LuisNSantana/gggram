<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{   //solo se esta colocando User para mantener la url uniforme con la que creamos
    public function store(Request $request, User $user, Post $post){
        //validar
        $this->validate($request,[
            'comentario' => 'required|max:55'

        ]);


        //almacenar el resultado
        Comentario::create([
            //asi podemos tener el usuario el que comenta, no sobre donde estamos comentando.
            'user_id'=> auth()->user()->id,
            'post_id'=> $post->id,
            'comentario'=>$request->comentario

        ]);


        //imprimir un mensaje
        return back()->with('mensaje', 'Comentario realizado correctamente');
    }
}
