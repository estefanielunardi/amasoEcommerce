<x-app-layout>
    <section class="flex flex-col m-10">
        <h1 class="title pb-8">Nuevo Producto</h1>
    </section>
    <section class="container md:container md:mx-auto p-8 flex justify-center">
    <div class="box-border p-4 bg-white h-128 w-96">
        <form method="POST" action="{{ route('storeProduct') }}" enctype="multipart/form-data">
        @method('POST')
                @csrf
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="nombre" class="font-serif">{{ __('Nombre del Producto') }}</label>
                <input type="text" id="nombre" class="w-100 border-solid border-2 border-green-500 rounded shadow-md h-10" name="name"  required autocomplete="name" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="imagen" class="font-serif">{{ __('Imagen URL') }}</label>
                <input accept="image/*" type="file" id="image" class="w-100 border-solid border-2 border-green-500 rounded shadow-md h-10" name="image"  required autocomplete="image" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="precio" class="font-serif">{{ __('Precio') }}</label>
                <div class="flex -mr-px greenAmaso">
                    <span class="flex items-center leading-normal greenAmaso rounded rounded-r-none border-solid border-2 border-r-0 border-green-500 px-3 whitespace-no-wrap text-greenAmaso">€</span>
                    <input type="number" id="precio" class="w-full border-solid border-2 border-green-500 rounded shadow-md h-10" name="price" required autocomplete="price" autofocus>
			    </div>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="cantidad" class="font-serif">{{ __('Cantidad') }}</label>
                <input type="number" id="cantidad" class="w-100 border-solid border-2 border-green-500 rounded shadow-md h-10" name="stock" required autocomplete="stock" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="descripcion" class="font-serif">{{ __('Descripción') }}</label>
                <textarea type="text" id="descripcion" class="w-100 border-solid border-2 border-green-500 rounded shadow-md h-24" name="description"  required autocomplete="description" autofocus ></textarea> 
            </div>
            <div class="flex justify-center">
                <button type="submit" class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">{{ __('Publicar Producto') }}</button>
            </div>
        </form>
    </div>
    </section>
</x-app-layout>