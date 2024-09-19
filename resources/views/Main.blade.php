<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Main Page</title>    
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body class="bg-gray-100 min-h-screen flex flex-col">

        <header class="bg-white shadow-md p-4 flex justify-center items-center">
            <h1 class="text-2xl font-bold text-purple-600">NicheCue Malaysia</h1>
        </header>
        
        <header class="p-4">
            <a href="{{ url('/Seller/SellerLogin') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded inline-block">
                Seller Centre
            </a>
        </header>

        <main class="flex-grow flex items-center justify-center px-4">
            <div class="text-center max-w-xl w-full">
                <h1 class="text-4xl font-bold mb-8">Welcome to Niche Cue Malaysia</h1>
                <div class="flex flex-col sm:flex-row sm:flex-wrap justify-center items-center gap-4">
                    
                    <!--will be remove anytime as the buyer should be allow to add products-->
                    <a href="{{ url('/Seller/AddProducts') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto">
                        Create New Product (TESTING)
                    </a>
                    
                    <!--Buyer can search for their products specification by providing serial_id-->
                    <a href="{{ url('/Buyer/BuyerSearchProducts') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto">
                        Search Product
                    </a>
                </div>
            </div>
        </main>
    </body>
</html>