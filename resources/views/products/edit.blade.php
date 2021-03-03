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
                <input type="text" id="nombre" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="name" value="{{$product->name}}" required autocomplete="name" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="imagen" class="font-serif">{{ __('Imagen') }}</label>
                <input type="text" id="image" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" value="{{$product->image}}"name="image" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="precio" class="font-serif">{{ __('Precio') }}</label>
                <div class="flex -mr-px greenAmaso">
                    <span class="flex items-center leading-normal greenAmaso rounded rounded-r-none border-solid border-2 border-r-0 borderGreen px-3 whitespace-no-wrap text-greenAmaso">€</span>
                    <input type="number" onchange="setTwoNumberDecimal()" min="0"step="0.01" class="w-full border-solid border-2 borderGreen rounded shadow-md h-10" name="price" value="{{number_format($product->price / 100,2)}}" required autocomplete="price" autofocus>
                </div>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="typequantity" class="font-serif">{{ __('Unidad de venta') }}</label>
                <select id="typequantity" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="typequantity"  required autocomplete="typequantity" autofocus>
                    <option value="Unidad">Unidad</option>
                    <option value="Media docena">Media Docena</option>
                    <option value="Docena">Docena</option>
                    <option value="Kg">Kg</option>
                    <option value="Li">Litro</option>
                </select> 
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="cantidad" class="font-serif">{{ __('Stock segun unidad de venta') }}</label>
                <input type="number" min="0" id="stock" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="stock" value="{{$product->stock}}" required autocomplete="stock" autofocus>
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="descripcion" class="font-serif">{{ __('Descripción') }}</label>
                <textarea type="text" id="descripcion" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-24" name="description"  required autocomplete="description" autofocus>{{ $product->description }}</textarea> 
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="category" class="font-serif">{{ __('Categoria') }}</label>
                <select id="category" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="category" value="{{$product->category}}" required autocomplete="category" autofocus>
                    <option value="vegetales">Vegetales</option>
                    <option value="bebidas">Bebidas</option>
                    <option value="pasteleria">Pasteleria/Reposteria</option>
                    <option value="otras">Otras</option>
                </select> 
            </div>
            <div class="flex flex-col my-4 text-xl greenAmaso">
                <label for="highlight" class="font-serif">{{ __('¿Destacar producto?') }}</label>
                <select id="highlight" class="focus:ring-indigo-500 bg-gray-100 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent greenAmaso sm:text-sm rounded-md" name="highlight"  value="{{$product->highlight}}" required autocomplete="highlight" autofocus>
                    @if ($product->highlight == 0)
                    <option value="0">No</option>
                    <option value="1">Si</option>
                    @else
                    <option value="1">Si</option>
                    <option value="0">No</option>
                    @endif
                </select>
            </div>
            <label for="allergens" class="font-serif font-bold font-xl greenAmaso">Información de alérgenos:</label>
            <div class="flex flex-col m-auto my-4 text-xl greenAmaso">
            @foreach ($allergensTypes as $allergen)
                <div class="flex flex-row m-2">  
                <input class="hidden"  type="checkbox" name="{{$allergen->type}}" value="{{$allergen->id}}" id="{{$allergen->id}}"> 
                <label for="{{$allergen->id}}" class="w-48 pl-2 greenAmaso rounded border-solid border-2  borderGreen text-greenAmaso hover:bg-green-100" id="allergen-label">{{$allergen->type}}</label>
                </div>
            @endforeach
            <div class="flex justify-center">
                <button type="submit" class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">{{ __('Editar Producto') }}</button>
            </div>
        </form>
    </div>
    </section>
    @push('scripts')
        <script>
        function setTwoNumberDecimal(event) {
            this.value = parseFloat(this.value).toFixed(2);
        }
        </script>
    @endpush
</x-app-layout>