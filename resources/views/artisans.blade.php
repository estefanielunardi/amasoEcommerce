<x-app-layout>
    <div>
        <h3 class="greenAmaso text-bold text-2xl p-2 pt-4 text-center">Nuestros productores</h3>
    </div>
    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            @foreach ($artisans as $artisan)           
                    <div class="relative w-60 p-4">
                        <img alt="Placeholder" class="w-full rounded-2xl" src="{{ asset('storage') .'/'. $artisan->image}}"/>
                        <a href="/artisan/{{$artisan->slug}}"> 
                            <p class="textManifiesto p-2">{{$artisan->name}}</p>
                        </a>
                    </div>              
            @endforeach
        </div>
        {!! $artisans->links() !!}
    </div>
</x-app-layout>