@isset($highlightProducts)
<section class="w-72 h-80 m-5 shadowHighlighted rounded-xl transform duration-500 ease-in-out hover:scale-105">
@endisset
@isset($bestSellers)
<section class="w-72 h-80 m-5 shadowBestSeller rounded-xl transform duration-500 ease-in-out hover:scale-105">
@endisset
@empty($highlightProducts || $bestSellers)
<section class="w-72 h-80 m-5 shadow-lg rounded-xl transform duration-500 ease-in-out hover:scale-105">
@endempty
    <a href="/product/{{$product->id}}">
        <x-product.card.header :product="$product" />
        <x-product.card.body :product="$product" :artisan="$artisan"/>
    </a>
</section>