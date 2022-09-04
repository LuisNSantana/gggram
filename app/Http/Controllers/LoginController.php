<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Termwind\Components\Raw;

class LoginController extends Controller
{
    //
    public function index(){
        
        return view('auth.login');

    }

    public function store(Request $request){

        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
           
        ]);


        //comprobar si las credenciales del usuario son correctas
        //request->remember es para mantener la sesion abierta si el usuario quiere
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            //with es una forma de llenar los mensajes que tenemos en la sesion
            //back sirve para volver a la pagina anterior por si no se valido la informacion
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        return redirect()->route('posts.index', ['user' => auth()->user()->username]);

    }
}
