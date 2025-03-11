<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form class="form-login" method="POST" action="{{ route('login') }}">
        @csrf
        <h2 class="form-login-heading centered">Inicio de Sesión</h2><br>
        <!-- username -->
        <div>
            <x-input-label for="username" :value="__('Nombre de Usuario')" /><br>
            <x-text-input id="username" class="block w-full mt-1" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <i class="icon_key_alt"><x-input-label for="password" :value="__('Contraseña')" /><br>

            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 centered">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                <span class="text-sm text-gray-600 ms-2">{{ __('Recuerdame') }}</span>
            </label>
        </div>
        <div class="block mt-4 centered">
            <x-primary-button class="ms-3 centered">
                {{ __('Acceder') }}
            </x-primary-button>
        </div>
        <br> <hr>
        <div class="login-social-link centered">
            <p>o puedes iniciar sesión a través de tu red social</p>
                <button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
                <button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
        </div>
        <div class="centered">
            <div class="centered">
                ¿Aún no tienes una cuenta?<br/>
                <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"  href="{{ route('register') }}">
                    {{ __('Crea una cuenta ') }}
                </a>
            </div>
            <div class="mt-4 centered">
                @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __(' Olvido su contraseña?') }}
                </a>
                @endif
            </div>
        </div>
    </form>
</x-guest-layout>
