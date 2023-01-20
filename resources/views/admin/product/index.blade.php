<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <a href="{{route('admin.product.create')}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Create Product
            </a>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg justify-center">


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Product name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$product->title}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$product->price}}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{route('admin.product.edit', $product->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <form class="font-medium text-blue-600 dark:text-blue-500 hover:underline ml-3" method="post" action="{{route('admin.product.destroy', $product->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('are you sure u want to delete {{$product->title}}?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                        @empty
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    empty
                                </td>
                            </tr>

                        @endforelse

                        </tbody>
                    </table>
                    <div class="mt-3 dark:bg-gray-200">

                        {{$products->render()}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
