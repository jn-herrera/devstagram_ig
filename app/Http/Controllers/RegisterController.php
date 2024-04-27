<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    public function index ()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);


        //Validar los datos de la solicitud
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:15',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',

            
            // Aquí defines las reglas de validación para los campos de tu formulario
        ]);

        //IS LIKE CREATE INTO USERS (NAME,USERNAME,EMAIL,PASSWORD)
        User::create([

            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);

        //Autenticacion del usuario a travez del email y password
        auth()->attempt($request->only('email','password'));



        return redirect()->route('posts.index', auth()->user()->username);



        //print dd('Creando usuario...'); - Creando usuario puede ser un valor de la tabla de la bd
    
    }
 



}
