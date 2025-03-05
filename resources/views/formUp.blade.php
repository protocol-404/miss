@extends('layouts.app')

@section('content')
<header class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-lg">
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold">Edit Product</h1>
                <p class="text-blue-100 mt-1">Update your product information</p>
            </div>
            <div>
                <a href="/" class="bg-white text-indigo-700 hover:bg-indigo-100 px-4 py-2 rounded-lg font-medium transition duration-200">
                    Back to Products
                </a>
            </div>
        </div>
    </div>
</header>

<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Edit Product Information</h2>
        </div>

        <div class="p-6">
            <form method="POST" action="/update/{{ $product->id }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text"
                        class="w-full px-3 py-2 border @error('name') border-red-500 @else border-gray-200 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        id="name"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        required
                        placeholder="Enter product name">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Description</label>
                    <textarea
                        class="w-full px-3 py-2 border @error('description') border-red-500 @else border-gray-200 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-700">Price</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="number"
                            step="0.01"
                            min="0"
                            class="w-full pl-7 px-3 py-2 border @error('price') border-red-500 @else border-gray-200 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            id="price"
                            name="price"
                            value="{{ old('price', $product->price) }}"
                            required
                            placeholder="0.00">
                    </div>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                        </svg>
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
