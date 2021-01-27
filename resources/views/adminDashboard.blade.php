<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

  
    <div class="title m-20">
        Dashboard
    </div>
        <div class="flex flex-col git justify-center align-center ">
            <h3 class="font-sans beigeAmaso m-auto">Perfiles pendientes por aprobar.</h3>
            <div class="">
                @foreach ($artisanList as $artisan)
                    <div class="justify-center align-center m-6 p-2 greenLightBg text-white w-3/4 rounded-md  ">
                         {{$artisan->name}}</br>
                    </div>
                @endforeach
            </div>
        </div>
        
</x-app-layout>
            


            
                
                            
                        
                        
