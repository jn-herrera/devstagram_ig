<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ComentarioController extends Controller
{
    //

    public function store(Request $request, User $user, Post $post)
    {
        $request->validate([
            'comentario' => 'required|max:50',
         ]);

         //save comment
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario

         ]);
         return back()->with('mensaje','Comentario realizado correctamente');
         //return redirect()->route('posts.index', auth()->user()->username);
    }

}
