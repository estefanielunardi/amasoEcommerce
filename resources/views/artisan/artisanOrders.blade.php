<x-app-layout>
    <h2 class="title p-10">Mis pedidos</h2>
    <div class="flex  p-4">
        <table class="border-collapse w-full">
            <thead>
                <tr>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Producto</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Cantidad</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Total</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Email</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Dirección</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Fecha</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Archivar</th>
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
                        <span>{{$order->updated_at}}</span>
                    </td>

                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">

                        <form action="{{ route('archiveOrder', ['id' => $order->id]) }}" method="POST">
                            <x-modal title="¿Archivar orden?" submit-label="Archivar">
                                <x-slot name="trigger">
                                    <button type="button" @click="on = true">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="inset-x-10 bottom-0 h-16 ..." width="38" height="38" viewBox="0 0 38 38" fill="none">
                                            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" stroke="orange" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>                                        
                                    </button>
                                </x-slot>
                                ¿Está seguro de que desea archivar este pedido?
                            </x-modal>
                            @method('POST')
                            {{ csrf_field() }}
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        {!! $orders->links() !!}
    </div>
    <h2 class="title p-10">Mis pedidos archivados</h2>
    <div class="flex  p-4">
        <table class="border-collapse w-full">
            <thead>
                <tr>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Producto</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Cantidad</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Total</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Email</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Dirección</th>
                    <th class="p-3 font-bold vollkorn text-white greenLightBg hidden lg:table-cell">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($archivedOrders as $order)
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
                        <span>{{$order->updated_at}}</span>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        {!! $orders->links() !!}
    </div>
</x-app-layout>