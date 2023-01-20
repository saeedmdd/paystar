<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Edit Product {$product->title}") }}
        </h2>
    </x-slot>
    <div class="py-12">
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __("Edit Product {$product->title}") }}
                </h2>

            </header>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg justify-center ">
                <form action="{{route('admin.product.update', $product->id)}}" class="w-full max-w-sm mx-auto" enctype="multipart/form-data"  method="POST">
                    @csrf
                    @method('PUT')
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                   for="inline-full-name">
                                Title
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                name="title"
                                placeholder="Product title"
                                id="inline-full-name" type="text" value="{{$product->title ?? old("title")}}">

                            @error('title')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                   for="inline-full-name">
                                Description
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <textarea
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                name="description"
                                placeholder="Product description"
                            >
                                {{$product->description ?? old("description")}}
                            </textarea>

                            @error('description')

                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                   for="inline-full-name">
                                Price
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                name="price"
                                min="100"
                                placeholder="Product Price"
                                id="inline-full-name" type="number" value="{{$product->price ?? old("price")}}">
                            @error('price')

                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                   for="inline-full-name">
                                Image
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                name="image"
                                placeholder="Product title"
                                id="inline-full-name" type="file">

                            @error('image')

                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="md:flex md:items-center">
                        <div class="md:w-1/3"></div>
                        <div class="md:w-2/3">
                            <button
                                class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                type="submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </div>


</x-app-layout>
