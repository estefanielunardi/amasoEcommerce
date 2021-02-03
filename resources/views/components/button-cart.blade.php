<div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
        <div class="beigeAmasoBg rounded-full fixed bottom-20 right-10 z-40 shadow-2xl buttomDesktop buttomPhone">
            <svg class="beigeLight w-full text-center p-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </x-nav-link>
</div>