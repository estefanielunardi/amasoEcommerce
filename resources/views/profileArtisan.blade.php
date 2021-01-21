<x-app-layout>
    <body>
        <section class="block space-y-8 ... p-12 ">

            <article class="flex justify-start">
                <div>
                    <img class=" max-w-xs w-174 rounded-xl" src="{{$artisan->image}}" alt="foto julian campesino">
                </div>
                <div>
                    <p class="mx-3 my-2 rounded-full text-white font-bold beigeAmasoBg text-xs p-2">#agriculura ecológica</p>
                    <p class="mx-3 my-2 rounded-full text-white font-bold beigeAmasoBg text-xs p-2">#slow food</p>
                </div>
            </article>
            <article class= "space-y-3">
                <h2 class="block title text-2xl	"> {{$artisan->name}} </h2>
                <p class="block beigeAmaso text-sm"> {{$artisan->location}} </p>
                <p class="block greenAmaso text-sm font-light"> {{$artisan->description}} </p>
            </article>
        </section>  

        <article class="p-12">
        <h2 class="block title">productos de {{$artisan->name}}</h2>
        </article>
        

        <div class="container my-12 mx-auto px-4 md:px-12">
            <div class="flex flex-wrap -mx-1 lg:-mx-4">

                <div class="beigeAmasoBg rounded-full fixed bottom-20 right-10 z-40 shadow-2xl buttomDesktop buttomPhone">
                    <svg class="beigeLight w-full text-center p-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                @foreach ($products as $product)
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                    <article class="overflow-hidden rounded-lg">
                 
                        <div class="relative">
                            <img alt="Placeholder" class="w-full" src="{{$product->image}}">
                            @if ($product->stock < $product->sold)
                                <div class="custom-number-input h-10 w-32 absolute bottom-2 right-1">
                                    <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                        <button data-action="decrement" class="counter greenLightBg beigeLight h-full w-20 rounded-l-2xl cursor-pointer outline-none">
                                            <span class="m-auto text-2xl font-thin">−</span>
                                        </button>
                                        <input type="number" class="counter border-transparent outline-none focus:outline-none text-center w-12 greenAmasoBg font-semibold text-md   md:text-basecursor-default flex items-center text-white  outline-none" name="custom-input-number" value="0"></input>
                                        <button data-action="increment" class="counter  greenLightBg  beigeLight  h-full w-20 rounded-r-2xl cursor-pointer outline-none">
                                            <span class="m-auto text-2xl font-thin">+</span>
                                        </button>
                                    </div>
                                </div>
                                @else
                                <p class="text-green-600">Sold Out</p>
                                @endif
                        </div>

                        <header class="font-bold text-xl mb-2">
                            <div class="px-6 py-4">
                                {{$product->name}}
                            </div>
                            <div class="px-6 py-4 text-sm">
                                <a href="#">Productor: {{$product->artisan}} </a>
                            </div>
                            <div class="ml-2 text-grey-darker text-base">
                                {{$product->description}}
                            </div>
                        </header>
                        <div class="px-4 py-4 md:px-10">
                            <p class="py-4"> {{$product->price}} €</p>
                            <div class="flex flex-wrap pt-8 justify-around">

                            </div>
                        </div>
                        @auth
                        <div class="relative h-0 w-32 ..."> 
                            <form action="{{ route('editProduct', ['id' => $product->id]) }}" method="get">
                                <button type="submit">                      
                                    <svg class="absolute left-60	 inset-x-0 bottom-0 h-16 ..."  width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="19" cy="19" r="19" fill="#81A78C"/>
                                    <path d="M24.3636 10.0204C24.6138 9.75297 24.9131 9.53966 25.2441 9.39291C25.575 9.24617 25.9309 9.16892 26.2911 9.16569C26.6513 9.16246 27.0085 9.23331 27.3418 9.37409C27.6752 9.51488 27.978 9.72279 28.2327 9.98569C28.4874 10.2486 28.6888 10.5612 28.8252 10.9053C28.9616 11.2494 29.0302 11.6181 29.0271 11.9899C29.024 12.3617 28.9491 12.7291 28.807 13.0707C28.6648 13.4123 28.4582 13.7213 28.1991 13.9796L27.1236 15.0898L23.2881 11.1306L24.3636 10.0204V10.0204ZM21.3704 13.1102L10.0063 24.8408V28.8H13.8418L25.2072 17.0694L21.369 13.1102H21.3704Z" fill="white"/>
                                    </svg>
                                </button>
                            </form> 
                            <form action="{{ route('deleteProduct', ['id' => $product->id]) }}" method="POST">
                                <button type="submit">
                                    <svg class="absolute left-72 inset-x-10 bottom-0 h-16 ..." width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="19" cy="19" r="19" fill="#DAB162"/>
                                    <path d="M17 19V25M21 19V25M11 15H27M26 15L25.133 27.142C25.0971 27.6466 24.8713 28.1188 24.5011 28.4636C24.1309 28.8083 23.6439 29 23.138 29H14.862C14.3561 29 13.8691 28.8083 13.4989 28.4636C13.1287 28.1188 12.9029 27.6466 12.867 27.142L12 15H26ZM22 15V12C22 11.7348 21.8946 11.4804 21.7071 11.2929C21.5196 11.1054 21.2652 11 21 11H17C16.7348 11 16.4804 11.1054 16.2929 11.2929C16.1054 11.4804 16 11.7348 16 12V15H22Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                @method('DELETE')
                                {{ csrf_field() }} 
                            </form>                           
                        </div>
                        <div class="relative h-32 w-32 ...">
                            
                        </div>

                        @endauth

                        

                    </article>
                </div>
                @endforeach
            </div>
        {!! $products->links() !!}
    </div>

    </body>
</x-app-layout>