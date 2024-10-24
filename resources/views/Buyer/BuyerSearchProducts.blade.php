<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Search</title>
        <link rel="icon" href="{{ asset('images/niche_logo.jpg') }}" type="image/jpeg">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <!-- Custom CSS for styling -->
        <style>
            html, body {
                height: 100%; /* Full height for html and body */
                margin: 0;
                padding: 0;
                overflow-y: auto; /* Enable scrolling for the full body */
                /*overflow-x: hidden; /* Prevent horizontal scrolling */
                margin: 0;
                padding: 0;
            }

            .bg-image {
                background-image: url('{{ asset("images/Niche_F1_logo.jpg") }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                min-height: 100vh; /* Ensure the background stretches to the full viewport */
            }

            .content-wrapper {
                background-color: rgba(255, 255, 255, 0.8); /* Add a white overlay to the content */
            }

            main {
                padding: 1rem 0; /* Padding for the content */
            }

            /* Image container with grid layout */
            .product-images-container {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1rem;
                max-width: 100%;
                overflow-y: auto; /* Scroll only when necessary */
            }

            /* Ensure images are responsive */
            .product-images-container img {
                width: 100%;
                height: auto;
                max-height: 400px;
            }

            /* Search container styling */
            .search-container {
                padding-top: 1rem;
                padding-bottom: 2rem;
                padding-left: 1rem;
                background-color: rgba(255, 255, 255, 0.9);
            }
        </style>
    </head>
    <body>
        <!-- Header with the Product Search title -->
        <header class="shadow-md p-3 flex justify-center items-center bg-black">
            <!-- Small Logo beside the title using asset -->
            <img src="{{ asset('images/Niche_Cues_Thailand.jpg') }}" alt="NicheCue Logo" class="h-12 w-12 mr-2"> <!-- Adjust the size if needed -->
            <h1 class="text-2xl font-bold text-white">Niche Cues Malaysia Factory</h1>
        </header>

        <div class="bg-image content-wrapper">
            <main class="flex-grow flex flex-col items-center justify-start px-4 py-8">
                <div class="search-container bg-white shadow-lg rounded-lg p-4 sm:p-8 max-w-[95%] sm:max-w-2xl w-full mb-16">
                    <!-- Search Product Title -->
                    <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Find Your Cue</h2>
                    
                    <form action="{{ url('/Buyer/BuyerSearchProducts/handle_search_products_function') }}" method="GET" class="mb-8" id="searchForm">
                        @csrf
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="warranty_number">
                            Enter Warranty Number
                        </label>
                        
                        <div class="flex flex-col sm:flex-row items-stretch gap-2">
                            <div class="flex-grow">
                                <input 
                                    type="text" 
                                    name="warranty_number" 
                                    id="warrantyNumberInput" 
                                    placeholder="Warranty Number" 
                                    class="w-full px-4 py-2 border rounded-lg sm:rounded-l-lg sm:rounded-r-none focus:outline-none focus:ring-2 focus:ring-purple-600"
                                >
                            </div>
                            <button 
                                type="submit" 
                                class="w-full sm:w-auto bg-black text-white px-6 py-2 rounded-lg sm:rounded-l-none sm:rounded-r-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600"
                            >
                                Search
                            </button>
                        </div>
                    </form>
                    
                    @if(isset($searchPerformed) && $searchPerformed)
                        @if($product)
                            <h2 class="text-2xl font-bold mb-4">Product Specifications</h2>
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div><strong>Warranty_number:</strong> {{ $product->warranty_number }}</div>
                                <div><strong>Serial ID:</strong> {{ $product->serial_id }}</div>
                                <div><strong>Ferrule(mm):</strong> {{ $product->ferrule }}</div>
                                <div><strong>Length(mm):</strong> {{ $product->length }}</div>
                                <div><strong>Weight(mm):</strong> {{ $product->weight }}</div>
                                <div><strong>Butt(mm):</strong> {{ $product->butt }}</div>
                                <div><strong>Balancing(mm):</strong> {{ $product->balancing }}</div>
                            </div>

                            @if($product->images)
                                <h3 class="text-lg font-bold mb-2">Product Images:</h3>
                                <div class="product-images-container">
                                    @for($i = 1; $i <= 6; $i++)
                                        @php
                                            $imageData = $product->images->{"images_data_$i"};
                                            $imageName = $product->images->{"images_file_name_$i"};
                                        @endphp
                                        @if($imageData)
                                            <div>
                                                <img src="data:image/jpeg;base64,{{ base64_encode($imageData) }}" alt="{{ $imageName }}" class="rounded-lg shadow-md">
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
        <nav class="fixed bottom-0 left-0 right-0 bg-black shadow-lg">
            <div class="flex justify-around items-center h-16">
                <a href="{{ url('/') }}" class="flex flex-col items-center text-white hover:text-gray-500">
                    <i class="fas fa-home text-xl mb-1"></i>
                    <span class="text-xs">Home</span>
                </a>
                <a href="{{ url('/Buyer/BuyerSearchProducts') }}" class="flex flex-col items-center text-white hover:text-gray-500">
                    <i class="fas fa-search text-xl mb-1"></i>
                    <span class="text-xs">Search</span>
                </a>
            </div>
        </nav>
    </body>
</html>
