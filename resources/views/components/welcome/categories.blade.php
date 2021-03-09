<div class="flex justify-center py-2">
    <div x-data="{ dropdownOpen: false }" class="relative">
        <button @click="dropdownOpen = !dropdownOpen" class=" flex flex-row py-2 px-4 tracking-wide greenLightBg text-white font-medium focus:outline-none rounded-xl">
            <p class="pr-2">Categorias</p>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>
        <div x-show="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-20">
            <a href="{{ url('/') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Todas</a>
            <a href="{{ url('/categorias/bebidas') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Bebidas</a>
            <a href="{{ url('/categorias/pasteleria') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Pasteleria</a>
            <a href="{{ url('/categorias/vegetales') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Vegetales</a>
            <a href="{{ url('/categorias/otras') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Otras</a>
        </div>
    </div>
</div>