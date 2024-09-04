<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Product</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Search Product</h1>
        
        <div class="mb-6">
            <a href="{{ url('/') }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                &larr; Back
            </a>
        </div>
        
        <form action="{{ url('products/handle_search_products_function') }}" method="GET" class="mb-8">
            <div class="max-w-md mx-auto">
                <div class="flex items-center border-b border-gray-300 py-2">
                    <input type="text" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" id="serial_id" name="serial_id" placeholder="Enter Serial ID" required>
                    <button type="submit" class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded">
                        Search
                    </button>
                </div>
            </div>
        </form>

        @if(isset($searchPerformed) && $searchPerformed)
            @if($product)
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Product Details</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="font-bold text-gray-700">Serial ID:</div>
                        <div>{{ $product->serial_id }}</div>
                        <div class="font-bold text-gray-700">Ferrule:</div>
                        <div>{{ $product->ferrule }}</div>
                        <div class="font-bold text-gray-700">Length:</div>
                        <div>{{ $product->length }}</div>
                        <div class="font-bold text-gray-700">Weight:</div>
                        <div>{{ $product->weight }}</div>
                        <div class="font-bold text-gray-700">Butt:</div>
                        <div>{{ $product->butt }}</div>
                        <div class="font-bold text-gray-700">Balancing:</div>
                        <div>{{ $product->balancing }}</div>
                    </div>
                </div>
            @else
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">No product found!</strong>
                    <span class="block sm:inline"> No product found with the given Serial ID.</span>
                    <div class="mt-4 text-center">
                        <img src="{{ asset('gif-testing/cat-sorry.gif') }}" alt="No Product Found" class="mx-auto">
                    </div>
                </div>
            @endif
        @endif

    </div>
</body>
</html>
