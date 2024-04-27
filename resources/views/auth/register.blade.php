@extends('layouts.app')

@section('titulo')
    Registrate en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-5/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="img_register" class="shadow-xl">
        </div>

        <div class="md:w-4/12 bg-white p-6 shadow-xl rounded-lg">
            <form action="/register" method="POST" novalidate>
                @csrf <!-- Validar cadena -->
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input id="name" name="name" type="text" placeholder="Tu nombre" class="border p-3 w-full rounded-lg 
                    @error('name') border-red-500 @enderror" value="{{old('name')}}">
                    
                    @error('name') 
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input id="username" name="username" type="text" placeholder="Username" class="border p-3 w-full rounded-lg 
                    @error('username') border-red-500 @enderror" value="{{old('username')}}">
                    
                    @error('username') 
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror


                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input id="email" name="email" type="email" placeholder="Email" class="border p-3 w-full rounded-lg 
                    @error('email') border-red-500 @enderror" value="{{old('email')}}">

                    @error('email') 
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                
                
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                    <input id="password" name="password" type="password" placeholder="Contraseña" class="border p-3 w-full rounded-lg 
                    @error('password') border-red-500 @enderror">

                    @error('password') 
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir contraseña</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirmar contraseña" class="border p-3 w-full rounded-lg">
                </div>

                <input type="submit" value="Crear cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
