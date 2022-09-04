<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class FollowerController extends Controller
{
    //User es la persona que estamos visitando
    //Request es la persona que esta siguiendo el usuario
    public function store(User $user)
    {   //attach se usa cuando relacionas con la misma tabla
        $user->followers()->attach(auth()->user()->id);

        return back();
    }

    public function destroy(User $user)
    {

        $user->followers()->detach(auth()->user()->id);
        return back();
    }
}
