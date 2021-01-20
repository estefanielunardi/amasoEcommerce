<x-app-layout>
    <body>
        <section class="block space-y-8 ... p-12 ">

            <article class="flex justify-start">
                <div>
                    <img class="w-174 rounded-xl" src="https://i.ibb.co/tBsVJMH/n-UFXna-Qq-400x400.jpg" alt="foto julian campesino">
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
        <section>
            <article class="p-12">
            <h2 class="block title">productos de {{$artisan->name}}</h2>
            </article>
        </section>
    
        <button></button>
    </body>
</x-app-layout>