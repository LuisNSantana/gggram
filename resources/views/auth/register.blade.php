@extends('layouts.app')

@section('titulo')
    Registrate en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg')}}" alt="Imagen registro usuarios">
        </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">

        <form action="{{ route('register') }}" method="POST" novalidate>
            @csrf
            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold"> Nombre </label>
                <!-- atributo name es muy importante por que es lo que se envia a los servidores de laravel para validar la info  !-->
                <input type="text" name="name" id="name" placeholder="Ingresa tu nombre" class="border p-3 w-full rounded-lg @error('name')
                    border-red-500
                @enderror" value="{{old('name')}}" >

                @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm text-center">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold"> Username </label>
                <input type="text" name="username" id="username" placeholder="Ingresa tu Username" class="border p-3 w-full rounded-lg @error('username')
                border-red-500
            @enderror" value="{{old('username')}} ">
                @error('username')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm text-center">{{$message}}</p>
            @enderror
            </div>
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold"> Email </label>
                <input type="email" name="email" id="email" placeholder="Ingresa tu email" class="border p-3 w-full rounded-lg @error('email')
                border-red-500
            @enderror" value="{{old('email')}}">
            @error('email')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm text-center">{{$message}}</p>
        @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold"> Contraseña </label>
                <input type="password" name="password" id="password" placeholder="Ingresa tu contraseña" class="border p-3 w-full rounded-lg @error('password')
                border-red-500
            @enderror">
                @error('password')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm text-center">{{$message}}</p>
            @enderror
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold"> Repetir Contraseña </label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repetir contraseña" class="border p-3 w-full rounded-lg">
            </div>
            <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white rounded-lg"/>
        </form>

    </div>
    </div>
    
@endsection