<x-app-layout>
    <section class="flex flex-col m-10">
        <h1 class="title pb-8">Editar Producto</h1>
    </section>
    <section class="container md:container md:mx-auto p-8 flex justify-center">
    <div class="box-border p-4 bg-white h-128 w-96">
        <form method="POST" action="{{ route('updateProduct' , $product) }}">
        @method('PUT')
                @csrf
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="nombre" class="font-serif">{{ __('Nombre del Producto') }}</label>
                <input type="text" id="nombre" class="w-100 border-solid border-2 border-green-500 rounded shadow-md h-10" name="name" value="{{$product->name}}" required autocomplete="name" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="imagen" class="font-serif">{{ __('Imagen URL') }}</label>
                <input type="text" id="localidad" class="w-100 border-solid border-2 border-green-500 rounded shadow-md h-10" name="image" value="{{$product->image}}" required autocomplete="image" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="descripcion" class="font-serif">{{ __('Descripción') }}</label>
                <input type="text" id="correo" class="w-100 border-solid border-2 border-green-500 rounded shadow-md h-10" name="description"  value="{{$product->description}}" required autocomplete="description" autofocus> 
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="precio" class="font-serif">{{ __('Precio') }}</label>
                <input type="number" id="contraseña" class="w-100 border-solid border-2 border-green-500 rounded shadow-md h-10" name="price" value="{{$product->price}}" required autocomplete="price" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="cantidad" class="font-serif">{{ __('Cantidad') }}</label>
                <input type="number" id="contraseña" class="w-100 border-solid border-2 border-green-500 rounded shadow-md h-10" name="stock" value="{{$product->stock}}" required autocomplete="stock" autofocus>
            </div>
            <div class="flex justify-center">
                <button type="submit" class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">{{ __('Editar Producto') }}</button>
            </div>
        </form>
    </div>
    </section>
</x-app-layout>