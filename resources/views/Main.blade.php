<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Main Page</title>    
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body class="bg-gray-100 min-h-screen flex flex-col">
        <header class="p-4">
            <a href="{{ url('/Seller/SellerLogin') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded inline-block">
                Seller Centre
            </a>
        </header>

        <main class="flex-grow flex items-center justify-center px-4">
            <div class="text-center max-w-xl w-full">
                <h1 class="text-4xl font-bold mb-8">Welcome to Niche Cue Malaysia</h1>
                <div class="flex flex-col sm:flex-row sm:flex-wrap justify-center items-center gap-4">

                    <a href="{{ url('/Seller/AddProducts') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto">
                        Create New Product
                    </a>
                    
                    <a href="{{ url('/products/search') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto">
                        Search Product
                    </a>

                    <a href="{{ url('/products/upload_function') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto">
                        Image Show All
                    </a>


                </div>
            </div>
        </main>
    </body>
</html>