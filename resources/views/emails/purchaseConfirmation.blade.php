<h1>Amasó</h1>
<h2>{{ $name }}, tu pedido ha sido realizado con éxito</h2>
<h3>Gracias por confiar en nosotros.</h3>

@foreach ($products as $product)
<ul>
    <li>{{$product->name}}</li>    
    <li>{{$product->amount}} Ud.</li>
    <li>{{number_format($product->price / 100, 2)}} €</li>
</ul>
@endforeach
<p>Total: {{$total}} €</p>