<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <div class="mt-8">
                <a href="/"  >
                    <x-application-logo-redondo/>
                </a>
            </div>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors  :errors="$errors" />
        <section class="container md:container md:mx-auto p-8 flex justify-center">
            <div class="box-border p-4 bg-white h-128 w-96">
                <p class="title">Registro de usuario</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="flex flex-col my-4 text-xl greenAmaso">
                        <label class="font-serif" for="name" :value="__('Name')">{{ __('Name') }}</label>

                        <input id="name" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10"type="text" name="name" :value="old('name')" required autofocus />
                    </div>

                    <!-- Email Address -->
                    <div class="flex flex-col my-4 text-xl greenAmaso">
                        <label class="font-serif"for="email" :value="__('Email')">{{ __('Email') }}</label>

                        <input id="email" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" type="email" name="email" :value="old('email')" required />
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col my-4 text-xl greenAmaso">
                        <label class="font-serif"for="password" :value="__('Password')">{{ __('Password') }}</label>

                        <input id="password" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="flex flex-col my-4 text-xl greenAmaso">
                        <label class="font-serif"for="password_confirmation" :value="__('Confirm Password')">{{ __('Confirm Password') }}</label>

                        <input id="password_confirmation" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10"
                                        type="password"
                                        name="password_confirmation" required />
                    </div>

                    <div class="flex flex-col my-4 text-xl greenAmaso">
                        <label class="font-serif" for='isArtisan' :value="__('isArtisan')">Registrarse como Artesano</label>
                        <select id="isArtisan" name="isArtisan" class="focus:ring-indigo-500 bg-gray-100 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent greenAmaso sm:text-sm rounded-md">
                            <option value='0'>No</option>                   
                            <option value='1'>Si</option>
                        </select>                    
                    </div>    

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm greenAmaso hover:text-green-900" href="{{ route('login') }}">
                            {{ __('Ya estas registrado?') }}
                        </a>
                    </div>
                    <div class="flex justify-center">
                        <button class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">
                            {{ __('Registarse') }}
                        </button>
                    </div>               
                </form>
            </div>
        </section>
    </x-auth-card>
</x-app-layout>
