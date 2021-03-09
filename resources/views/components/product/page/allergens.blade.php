<p class=" greenAmaso mb-4 ">Información de alérgenos:</p>
<ul class="italic list-disc">
    @foreach ($product->allergens as $allergen)
    <li class="productDescription vollkorn text-bold text-lg greenAmaso ml-10">{{$allergen->type}}</li>
    @endforeach
</ul>