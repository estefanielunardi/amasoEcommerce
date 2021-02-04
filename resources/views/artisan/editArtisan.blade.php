<x-app-layout>
    <section class="flex flex-col m-10">
        <h1 class="title pb-8">Editar Perfil</h1>
    </section>
    <section class="container md:container md:mx-auto p-8 flex justify-center">
    <div class="box-border p-4 bg-white h-128 w-96">
        <form method="POST" action="{{ route('updateArtisan', $artisan) }}">
        @method('PUT')
                @csrf
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="nombre" class="font-serif">{{ __('Nombre o tu Marca Personal') }}</label>
                <input type="text" id="name" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="name" value="{{$artisan->name}}" required autocomplete="name" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="imagen" class="font-serif">{{ __('Imagen de Perfil') }}</label>
                <input type="text" id="image" class=" w-100 border-solid border-2 borderGreen rounded shadow-md h-10"value="{{$artisan->image}}" name="image" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="location" class="font-serif">{{ __('Localidad') }}</label>
                <input type="text" id="location" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="location" value="{{$artisan->location}}" required autocomplete="location" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="description" class="font-serif">{{ __('Cuentanos algo sobre ti') }}</label>
                <textarea type="text" id="description" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-24" name="description" required autocomplete="description" autofocus>{{$artisan->description}}</textarea>
            </div>
            <div class="flex justify-center">
                <button type="submit" class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">{{ __('Editar Perfil') }}</button>
            </div>
        </form>
    </div>
    </section>
</x-app-layout>