<form action="{{ route('cartAddProduct' , $product->id) }}" method="get">
    <button type="submit" class="w-11 h-11 rounded-full beigeAmasoBg relative shadow-xl ||  transition duration-500 ease-in-out transform hover:-translate-1 hover:scale-110">
        <svg class="inset-x-0 absolute top-1 left-1" width="38" height="40" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- <circle cx="19" cy="19" r="19" fill="#81A78C" /> -->
            <path fill-rule="evenodd" clip-rule="evenodd" d="M17 8.5C17.4509 8.5 17.8833 8.67911 18.2021 8.99792C18.5209 9.31673 18.7 9.74913 18.7 10.2V15.3H23.8C24.2509 15.3 24.6833 15.4791 25.0021 15.7979C25.3209 16.1167 25.5 16.5491 25.5 17C25.5 17.4509 25.3209 17.8833 25.0021 18.2021C24.6833 18.5209 24.2509 18.7 23.8 18.7H18.7V23.8C18.7 24.2509 18.5209 24.6833 18.2021 25.0021C17.8833 25.3209 17.4509 25.5 17 25.5C16.5491 25.5 16.1167 25.3209 15.7979 25.0021C15.4791 24.6833 15.3 24.2509 15.3 23.8V18.7H10.2C9.74913 18.7 9.31673 18.5209 8.99792 18.2021C8.67911 17.8833 8.5 17.4509 8.5 17C8.5 16.5491 8.67911 16.1167 8.99792 15.7979C9.31673 15.4791 9.74913 15.3 10.2 15.3H15.3V10.2C15.3 9.74913 15.4791 9.31673 15.7979 8.99792C16.1167 8.67911 16.5491 8.5 17 8.5V8.5Z" fill="white" />
        </svg>
    </button>
</form>