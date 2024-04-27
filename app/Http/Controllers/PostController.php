<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth')->except(['show', 'index']);

   }
   //
   public function index(User $user)
   {

      //dd(auth()->user());
      $posts = Post::where('user_id', $user->id)->latest()->paginate(20);


      return view('dashboard', [

         'user' => $user,
         'posts' => $posts


      ]);
   }

   public function create()
   {
      return view('posts.create');
   }

   public function store(Request $request)
   {
      $request->validate([

         'titulo' => 'required|max:25',
         'descripcion' => 'required',
         'imagen' => 'required'

      ]);

      Post::create([
         'titulo' => $request->titulo,
         'descripcion' => $request->descripcion,
         'imagen' => $request->imagen,
         'user_id' => auth()->user()->id
      ]);
      return redirect()->route('posts.index', auth()->user()->username);
   }

   public function show(User $user, Post $post)
   {
      return view('posts.show', [
         'user' => $user,
         'post' => $post
      ]);
   }


   public function destroy(Post $post)
{
    // Eliminar los comentarios relacionados
    $post->comentarios()->delete();

    // Verificar si el usuario tiene permiso para eliminar el post
    if (Gate::allows('delete', $post)) {
        // Ruta de la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);
        
        // Verificar si la imagen existe y eliminarla
        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        // Eliminar el post
        $post->delete();

        // Redireccionar al índice de posts del usuario actual
        return redirect()->route('posts.index', auth()->user()->username);
    } else {
        // Si el usuario no está autorizado, devolver un error 403
        abort(403, 'No tienes permiso para eliminar este post.');
    }
}

   
   
   
}
