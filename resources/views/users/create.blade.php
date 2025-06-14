<x-app-layout>
    @section('contenido')
    <div class="container-fluid py-4">
        <div class="centered">
            <div class="top-bar mb-2 col-end-9">
                <div class="card my-4">
                    <div class=" p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">

        <form class="form-login" method="POST" action="{{ route('register') }}">
            @csrf
            <h2 class="text-black text-capitalize ps-3">Registro de Usuario</h2>
            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Mostrar errores de validación -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row mb-3">
                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Nombres y Apellidos')"  />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                <!-- username-->

                    <x-input-label for="username" :value="__('Nombre de Usuario')" />
                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />


                <!-- Email Address -->

                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <x-input-label for="Rol" :value="__('Rol')" />

            <select class="form-select form-select-sm" id="roles" name="roles">
                @foreach ($roles as $rol)
                <div class="inline-block mt-2">
                    <option value="{{ $rol->id }}"> {{ $rol->description }}</option>

                </div>
            @endforeach

            <div class="flex items-center justify-end mt-4">
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('users.index') }}" class="btn btn-danger">Volver</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div></div></div></div></div></div>
    @endsection
</x-app-layout>