<x-app-layout>
    
    <section class="flex flex-col m-10">
        <h1 class="title pb-8">Crea tu Perfil</h1>
        <h2 class="pb-2 text-white text-xl font-serif text-center">
            <span class="beigeAmasoBg my-4  p-1">¿Quieres formar parte del equipo de productores amasó?</span>
        </h2>
    </section>
    <section class="container md:container md:mx-auto p-6 flex justify-center">
    <div class="box-border p-4 bg-white h-128 w-96">
            <form action="{{route('artisanStore')}}" method="POST">
            @method('POST')
                @csrf
                <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="nombre" class="font-serif">{{ __('Nombre o tu Marca Personal') }}</label>
                <input type="text" id="name" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="name" required autocomplete="name" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="imagen" class="font-serif">{{ __('Imagen de Perfil') }}</label>
                <input type="text" id="image" class=" w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="image" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="location" class="font-serif">{{ __('Localidad') }}</label>
                <input type="text" id="location" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="location"  required autocomplete="location" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="description" class="font-serif">{{ __('Cuentanos algo sobre ti') }}</label>
                <textarea type="text" id="description" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-24" name="description" required autocomplete="description" autofocus></textarea>
            </div>
                <div class="flex justify-end">
                    <button type="submit" class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">Enviar</button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>