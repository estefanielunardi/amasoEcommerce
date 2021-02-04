<x-app-layout>
    <h2 class="title p-10">Mis pedidos</h2>
    <div class="flex  p-4" >
        <table class="border-collapse w-full">
            <thead>
                <tr>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Producto</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Cantidad</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Total</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Email</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Direccion</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">C.P</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Fecha</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    <span>{{$order->name}}</span>
                        
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                    <span>{{$order->amount}}</span>
                        
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    <span>{{number_format($order->amount * $order->price/100,2)}} €</span>
                        
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    <span>{{$order->email}}</span>
                    
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                    <span>{{$order->direction}}</span>                    
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                    <span>{{$order->postal}}</span>
                        
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                    <span>{{$order->updated_at}}</span>
            
                    </td>
                </tr>
                
                @endforeach 
            </tbody>
        </table>
        {!! $orders->links() !!}
    </div>
</x-app-layout>