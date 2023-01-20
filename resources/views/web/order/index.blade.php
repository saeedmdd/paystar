
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @forelse($orders as $order)
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg justify-center">


                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                        @foreach($order->orderItems as $orderItem)
                            <ul class="bg-white mb-6">
                                <li>{{$orderItem->product_title}}</li>
                                <li>{{number_format($orderItem->price)}}</li>
                                <li>{{$orderItem->quantity}}</li>
                                <hr>
                            </ul>
                        @endforeach
                    </div>

                    <p class="dark:text-white">Price: {{number_format($order->final_price)}}</p>
                    <form action="{{route("order.pay", $order->id)}}" method="post">
                        @csrf
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Buy</button>
                    </form>
                </div>
            @empty
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg justify-center">


                    <h1 class="dark:text-white">There are no products</h1>

                </div>
            @endforelse
        </div>
    </div>

</x-app-layout>
