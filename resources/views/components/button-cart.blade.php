<div class="space-x-8 sm:-my-px sm:ml-10 sm:flex md:hidden">
    <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
        <div class="rounded-full w-20 h-20 flex items-center justify-center fixed bottom-28 right-6 z-40 shadow-2xl buttomDesktop buttomPhone || transition duration-500 ease-in-out beigeAmasoBg transform hover:-translate-y-1 hover:scale-110">
            @if($productsCount != 0)
            <svg class="beigeLight w-18 h-18 text-center p-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <p class="absolute greenAmaso bottom-8 vollkorn text-2xl" id="amount">{{$productsCount}}</p>
            @else
            <svg class="beigeLight w-14 h-14 text-center p-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            @endif
        </div>
    </x-nav-link>
</div>