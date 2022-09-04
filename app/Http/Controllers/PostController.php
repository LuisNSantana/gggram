<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class PostController extends Controller
{
    //
    public function __construct()
    { //se utiliza middelware para proteger auth. Los usuarios que no estana autenticados solo podran acceder a show e index.
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {   //mostrar los posts del usuario segun su id
        //se utiliza paginate para paginar los post y se encuentre de manera mas organizada
        $posts = Post::where('user_id', $user->id)->latest()->paginate(15);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {

        return view('posts.create');
    }
    //siempre en el store va a tener el request por que es lo que se va almacenar en la BD.
    public function store(Request $request)
    {

        $this->validate($request, [
            'titulo' => ['required', 'max:255'],
            'descripcion' => ['required'],
            'imagen' => 'required'
        ]);

        //llamamos al modelo de post para crear un post
        //Post::create([
        //  'titulo' => $request->titulo,
        //'descripcion' => $request->descripcion,
        //'imagen' => $request->imagen,
        //'user_id' => auth()->user()->id
        //]);


        //Crear un post con una relacion
        $request->user()->posts()->create(
            [

                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'imagen' => $request->imagen,
                'user_id' => auth()->user()->id

            ]

        );

        return redirect()->route('posts.index', auth()->user()->username);
    }
    //funcion para con el metodo show para mostrar cada publicacion individual con sus comentarios y likes
    public function show(User $user, Post $post)
    {
        return view(
            'posts.show',
            [
                'post' => $post,
                'user' => $user
            ]
        );
    }
    //esta funcion esta relacioanda con Policy
    public function destroy(Post $post){

        $this->authorize('delete', $post);
        $post->delete();
        //Eliminar la imagen
        $imagen_path= public_path('uploads/'. $post->imagen);
        
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
