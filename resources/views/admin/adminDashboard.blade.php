<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

  
    <div class="title m-10 lg:ml-28">
        Dashboard
    </div>
    <!-- <div class="flex flex-col justify-center items-center ">
        <h2 class="font-sans beigeAmaso m-auto font-bold">Perfiles pendientes de aprobar.</h2>
            <div class="flex flex-col w-full mt-10 items-center">
                @foreach ($artisanList as $artisan)
                    @if(!$artisan->aproved)
                    <div class="flex flex-row justify-center m-2 p-4 greenLightBg text-white rounded-md w-5/6 justify-between">
                        <p class="ml-4">{{$artisan->name}}</p> <a href="/artisan/{{$artisan->slug}}" class="greenAmaso mr-12 ">ver perfil</a>    
                    </div>
                    @endif
                @endforeach
            </div>
    </div> -->
    <div class="flex flex-col mt-10 justify-center items-center ">
        <h2 class="font-sans beigeAmaso m-auto font-bold mb-10">Perfiles activos.</h2>
            <div class="flex flex-col w-full items-center">
                @foreach ($artisanList as $artisan)
                    @if($artisan->aproved)
                    <div class="flex flex-row justify-center m-2 p-4 greenLightBg text-white rounded-md w-5/6 justify-between">
                        <p class="ml-4">{{$artisan->name}}</p> <a href="/artisan/{{$artisan->slug}}" class="greenAmaso mr-12 ">ver perfil</a>    
                    </div>
                    @endif
                @endforeach
            </div>
    </div>
        
</x-app-layout>
            


            
                
                            
                        
                        
