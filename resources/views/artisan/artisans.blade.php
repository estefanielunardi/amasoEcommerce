<x-app-layout>
    <header class="relative">
        <img class="w-full h-64 object-cover lg:h-96" src="./image/coverArtisans.jpg">
        <section class="absolute top-10 left-10 w-52 lg:w-96 lg:top-20 lg:left-52">
            <h2 class="block title text-white pb-5 lg:text-5xl">Nuestros productores</h2>
        </section>
    </header>
    <x-button-cart />

    <div class="flex flex-wrap justify-center md:space-x-20 my-12 mx-auto px-4 md:px-12">
        @foreach ($artisans as $artisan)           
        <a href="/artisan/{{$artisan->slug}}"> 
            <div class="flex flex-col -mx-1 lg:-mx-4 pb-10 items-center">
                <div class="relative w-56 h-56 overflow-hidden rounded-full">
                    <img alt="Placeholder" class="object-fill w-full rounded-2xl" src="{{$artisan->image}}"/>
                </div>              
                    <p class="vollkorn text-xl pt-5">{{$artisan->name}}</p>
                <p class="w-52 exo text-xs italic text-center pt-2">
                    {{$artisan->description}}
                </p>
            </div>
        </a>
        @endforeach
        {!! $artisans->links() !!}
    </div>
</x-app-layout>