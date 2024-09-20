<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Search</title>
        <link rel="icon" href="{{ asset('images/niche_logo.jpg') }}" type="image/jpeg">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <style>
            body {
                padding-bottom: 0.75rem; /* Add padding to the bottom of the body */
            }
            .content-wrapper {
                min-height: calc(100vh - 0.75rem); /* Subtract the height of the nav bar */
            }
        </style>
    </head>
    
    <body class="bg-gray-100 min-h-screen flex flex-col">
        <!-- Header with the Product Search title -->
        <header class="bg-white shadow-md p-4 flex justify-center items-center">
            <h1 class="text-2xl font-bold text-purple-600">NicheCue Malaysia</h1>
        </header>

        <div class="content-wrapper flex-grow flex flex-col">
            <main class="flex-grow flex flex-col items-center justify-center px-4 py-8">
                <div class="bg-white shadow-lg rounded-lg p-8 max-w-2xl w-full mb-16"> <!-- Added mb-16 for bottom margin -->
                    <!-- Search Product Title -->
                    <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Search Product</h2>

                    <form action="{{ url('/Buyer/BuyerSearchProducts/handle_search_products_function') }}" method="GET" class="mb-8" id="searchForm">
                        @csrf
                        <div class="flex items-center">
                            <input type="text" name="search_input" id="searchInput" placeholder="Enter Category Type-Serial ID" class="flex-grow px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                            <input type="hidden" name="category_prefix" id="categoryType">
                            <input type="hidden" name="serial_id" id="serialId">
                            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-r-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600">Search</button>
                        </div>
                    </form>

                    @if(isset($searchPerformed) && $searchPerformed)
                        @if($product)
                            <h2 class="text-2xl font-bold mb-4">Product Specifications</h2>
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div><strong>Serial ID:</strong> {{ $product->categories->category_prefix }}-{{ $product->serial_id }}</div>
                                <div><strong>Category:</strong> {{ $product->categories->category_name }}</div>
                                <div><strong>Ferrule:</strong> {{ $product->ferrule }}</div>
                                <div><strong>Length:</strong> {{ $product->length }}</div>
                                <div><strong>Weight:</strong> {{ $product->weight }}</div>
                                <div><strong>Butt:</strong> {{ $product->butt }}</div>
                                <div><strong>Balancing:</strong> {{ $product->balancing }}</div>
                            </div>

                            @if($product->images)
                                <h3 class="text-lg font-bold mb-2">Product Images:</h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    @for($i = 1; $i <= 6; $i++)
                                        @php
                                            $imageData = $product->images->{"images_data_$i"};
                                            $imageName = $product->images->{"images_file_name_$i"};
                                        @endphp
                                        @if($imageData)
                                            <div>
                                                <img src="data:image/jpeg;base64,{{ base64_encode($imageData) }}" alt="{{ $imageName }}" class="w-full h-auto rounded-lg shadow-md">
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            @else
                                <p class="text-gray-600">No images available for this product.</p>
                            @endif
                        @else
                            <p class="text-red-600">No product found</p>
                        @endif
                    @endif
                </div>
            </main>
        </div>

        <!-- Bottom Navigation Bar -->
        <nav class="fixed bottom-0 left-0 right-0 bg-white shadow-lg">
            <div class="flex justify-around items-center h-16">
                <a href="{{ url('/') }}" class="flex flex-col items-center text-purple-600 hover:text-purple-800">
                    <i class="fas fa-home text-xl mb-1"></i>
                    <span class="text-xs">About Us</span>
                </a>
                <a href="{{ url('/Buyer/BuyerSearchProducts') }}" class="flex flex-col items-center text-purple-600 hover:text-purple-800">
                    <i class="fas fa-search text-xl mb-1"></i>
                    <span class="text-xs">Search</span>
                </a>
            </div>
        </nav>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchForm = document.getElementById('searchForm');
                const searchInput = document.getElementById('searchInput');
                const categoryTypeInput = document.getElementById('categoryType');
                const serialIdInput = document.getElementById('serialId');

                searchForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const searchValue = searchInput.value.trim();
                    const parts = searchValue.split('-');

                    if (parts.length === 2) {
                        categoryTypeInput.value = parts[0].trim();
                        serialIdInput.value = parts[1].trim();
                        searchForm.submit();
                    } else {
                        alert('Wrong Serial ID format');
                    }
                });
            });
        </script>
    </body>
</html>