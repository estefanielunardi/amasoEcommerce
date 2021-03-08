<div class="flex flex-row justify-around w-28">
    <form action="{{ route('editProduct', ['id' => $product->id]) }}" method="get">
        <button type="submit">
            <svg class="inset-x-0 bottom-0 h-16 ..." width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="19" cy="19" r="19" fill="#81A78C" />
                <path d="M24.3636 10.0204C24.6138 9.75297 24.9131 9.53966 25.2441 9.39291C25.575 9.24617 25.9309 9.16892 26.2911 9.16569C26.6513 9.16246 27.0085 9.23331 27.3418 9.37409C27.6752 9.51488 27.978 9.72279 28.2327 9.98569C28.4874 10.2486 28.6888 10.5612 28.8252 10.9053C28.9616 11.2494 29.0302 11.6181 29.0271 11.9899C29.024 12.3617 28.9491 12.7291 28.807 13.0707C28.6648 13.4123 28.4582 13.7213 28.1991 13.9796L27.1236 15.0898L23.2881 11.1306L24.3636 10.0204V10.0204ZM21.3704 13.1102L10.0063 24.8408V28.8H13.8418L25.2072 17.0694L21.369 13.1102H21.3704Z" fill="white" />
            </svg>
        </button>
    </form>

    <form action="{{ route('deleteProduct', ['id' => $product->id]) }}" method="POST">
        <x-modal title="¿Eliminar producto?" submit-label="Eliminar">
            <x-slot name="trigger">
                <button type="button" @click="on = true">
                    <svg class="inset-x-10 bottom-0 h-16 ..." width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="19" cy="19" r="19" fill="#DAB162" />
                        <path d="M17 19V25M21 19V25M11 15H27M26 15L25.133 27.142C25.0971 27.6466 24.8713 28.1188 24.5011 28.4636C24.1309 28.8083 23.6439 29 23.138 29H14.862C14.3561 29 13.8691 28.8083 13.4989 28.4636C13.1287 28.1188 12.9029 27.6466 12.867 27.142L12 15H26ZM22 15V12C22 11.7348 21.8946 11.4804 21.7071 11.2929C21.5196 11.1054 21.2652 11 21 11H17C16.7348 11 16.4804 11.1054 16.2929 11.2929C16.1054 11.4804 16 11.7348 16 12V15H22Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </x-slot>
            ¿Está seguro de que desea eliminar este producto?
        </x-modal>
        @method('DELETE')
        {{ csrf_field() }}
    </form>

</div>
