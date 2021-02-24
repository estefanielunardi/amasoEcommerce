<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <div class="mt-8">
                <a href="/">
                    <x-application-logo-redondo />
                </a>
            </div>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <section class="container md:container md:mx-auto p-8 flex justify-center">
            <div class="box-border p-4 bg-white h-128 w-96">
                <p class="title">Iniciar sesión</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email Address -->
                    <div class="flex flex-col my-4 text-xl greenAmaso">
                        <label class="font-serif" for="email" :value="__('Email')">{{ __('Email') }}</label>

                        <input id="email" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10"type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col my-4 text-xl greenAmaso">
                        <label class="font-serif"for="password" :value="__('Password')">{{ __('Password') }}</label>

                        <input id="password" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex flex-col my-4 text-xl greenAmaso">
                        <label class="font-serif"for="remember_me">
                            <input id="remember_me" type="checkbox"  name="remember">
                            <span class="font-serif text-sm">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    <div class="flex justify-center">
                    <button class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">
                        {{ __('Login') }}
                    </button>
                    </div>
                </form>
            </div>
        </section>
    </x-auth-card>
</x-app-layout>
