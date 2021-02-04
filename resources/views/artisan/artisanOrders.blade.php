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
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Dirección</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">C.P</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Fecha</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Eliminar</th>
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

                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                    
                    <form action="{{ route('deleteOrder', ['id' => $order->id]) }}" method="POST">
                                    <x-modal title="¿Eliminar orden?" submit-label="Eliminar">
                                        <x-slot name="trigger">
                                            <button type="button" @click="on = true">
                                                <svg class="inset-x-10 bottom-0 h-16 ..." width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="19" cy="19" r="19" fill="#DAB162" />
                                                    <path d="M17 19V25M21 19V25M11 15H27M26 15L25.133 27.142C25.0971 27.6466 24.8713 28.1188 24.5011 28.4636C24.1309 28.8083 23.6439 29 23.138 29H14.862C14.3561 29 13.8691 28.8083 13.4989 28.4636C13.1287 28.1188 12.9029 27.6466 12.867 27.142L12 15H26ZM22 15V12C22 11.7348 21.8946 11.4804 21.7071 11.2929C21.5196 11.1054 21.2652 11 21 11H17C16.7348 11 16.4804 11.1054 16.2929 11.2929C16.1054 11.4804 16 11.7348 16 12V15H22Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        ¿Está seguro de que desea eliminar este pedido?
                                    </x-modal>
                                    @method('DELETE')
                                    {{ csrf_field() }}
                                </form>
                    </td>
                </tr>
                
                @endforeach 
            </tbody>
        </table>
        {!! $orders->links() !!}
    </div>
</x-app-layout>