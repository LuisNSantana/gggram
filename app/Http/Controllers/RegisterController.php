<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public  function  index()
    {
        return view('auth.register');
    }

    public function store(Request $request){

        //modificar request para que tome username con sus nuevos atributos
        //se utiliza el metodo slug de la clase Str para convertir el username en una url y evitar problemas de tipado
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validacion
        $this->validate($request, [
            'name' => ['required','min:4','max:30'],
            'username' => ['required', 'min:4', 'max:20', 'unique:users'],
            'email' => ['required', 'unique:users', 'email', 'max:30'],
            'password' => ['required', 'min:5','confirmed']
           
        ]);
        
        //dd($request->get('name'));
         //dd($request);

        User::create([
            'name' => $request-> name,
            
            'username'=> $request->username,
            'email'=>$request->email,
            //Llamas a la clase hash para hashear la contraseña por seguridad y que nadie pueda ver la verdadera
            'password'=> Hash::make($request->password)
        ]);

        //Autenticar Usuario
        //auth()->attempt(
          //  [
            //    'email'=> $request->email,
              //  'password'=>$request->password,
            //]
            //);

            //otra forma de autenticar
            auth()->attempt($request->only('email', 'password'));

        //redireccionar
        return redirect()->route('posts.index', auth()->user()->username);


    }


}
