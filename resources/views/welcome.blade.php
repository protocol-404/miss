<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products Database</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <header class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">
                        Welcome, {{Auth::user()->name}}!
                    </h1>
                    <p class="text-blue-100 mt-1">Manage your product inventory</p>
                </div>

                <div>
                    <a href="#"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="bg-white text-indigo-700 hover:bg-indigo-100 px-4 py-2 rounded-lg font-medium transition duration-200">
                        Logout
                    </a>
                    <form id="logout-form" action="/logout" method="POST" class="hidden">
                        @csrf
                        <button type="submit"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="bg-white text-indigo-700 hover:bg-indigo-100 px-4 py-2 rounded-lg font-medium transition duration-200">
                        Logout
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="/form" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 shadow-md">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New Product
                </div>
            </a>
        </div>
        <div x-data="{ showDeleteModal: false, productToDelete: null }" class="space-y-6">
            @if(isset($products) && count($products) > 0)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h1 class="text-2xl font-bold text-gray-800">Products Inventory</h1>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Name</th>
                                    <th class="py-3 px-6 text-left">Description</th>
                                    <th class="py-3 px-6 text-right">Price</th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach($products as $product)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-200">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center font-medium">
                                                {{ $product->name }}
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <div class="max-w-xs truncate">
                                                {{ Str::limit($product->description, 50) }}
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-right">
                                            <div class="font-medium text-green-600">
                                                ${{ number_format($product->price, 2) }}
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center space-x-2">
                                                <a href="/edit/{{ $product->id }}"
                                                    class="text-blue-500 hover:text-blue-700 transition duration-200 bg-blue-100 hover:bg-blue-200 p-2 rounded-full"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                </a>
                                                <button
                                                    @click="showDeleteModal = true; productToDelete = {{ $product->id }}"
                                                    class="text-red-500 hover:text-red-700 transition duration-200 bg-red-100 hover:bg-red-200 p-2 rounded-full"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($products->hasPages())
                        <div class="px-6 py-4 bg-white border-t border-gray-200">
                            <div class="flex justify-center">
                                {{ $products->links('pagination::tailwind') }}
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center py-12 bg-white shadow-md rounded-lg">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    <p class="mt-2 text-xl text-gray-500">No products found in the database</p>
                    <p class="mt-1 text-sm text-gray-400">Add some products to get started</p>
                </div>
            @endif

            <!-- Delete Confirmation Modal -->
            <div
                x-show="showDeleteModal"
                x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            >
                <div class="bg-white rounded-lg shadow-xl p-6 max-w-sm w-full">
                    <div class="text-center">
                        <svg class="mx-auto mb-4 w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Confirm Deletion</h3>
                        <p class="text-sm text-gray-500 mb-6">Are you sure you want to delete this product? This action cannot be undone.</p>

                        <div class="flex justify-center space-x-4">
                            <button
                                @click="showDeleteModal = false"
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition duration-200"
                            >
                                Cancel
                            </button>
                            <button
                                @click="showDeleteModal = false; deleteProduct(productToDelete)"
                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200"
                            >
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteProduct(productId) {
            fetch(`http://localhost:8000/delete/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    alert('Failed to delete the product');
                }
            })
        }
    </script>
</body>
</html>
