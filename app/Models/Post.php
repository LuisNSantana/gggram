<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
//la informacion que se va a llenar en la BD
    protected $fillable= [

        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];
    //funcion para relacionar el modelo User con el modelo Post
    public function user(){
        //se utiliza belongsTo por que un Post solo puede tener un Usuario
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }
    public function comentarios(){
        //Con has many le estamos diciendo que un Post va a tener varios comentarios
        return $this->hasMany(Comentario::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
     public function checkLike(User $user)
     {
       return $this->likes->contains('user_id', $user->id);
     }
}
