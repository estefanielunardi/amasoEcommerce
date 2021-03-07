<x-app-layout>
    <section class="container md:container md:mx-auto p-8 flex justify-center">
        <div class="box-border p-4 bg-white h-128 w-96">
            <p class="title">Editar Perfil</p>
            <form>
                @csrf
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label class="font-serif" for="name" :value="__('Name')">{{ __('Name') }}</label>
                    <input id="name" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" type="text" name="name" value={{$name}} required autofocus />
                </div>
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label class="font-serif" for="password" :value="__('Password')">{{ __('New Password') }}</label>
                    <input id="password" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" type="password" name="password" required autocomplete="new-password" />
                </div>
                <div class="flex justify-center">
                        <button class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">
                            {{ __('Enviar') }}
                        </button>
                    </div>    
            </form>
        </div>
    </section>
</x-app-layout>