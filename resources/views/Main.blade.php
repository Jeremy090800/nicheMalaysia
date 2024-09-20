<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Main Page</title>    
        <link rel="icon" href="{{ asset('images/niche_logo.jpg') }}" type="image/jpeg">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

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

        <main class="flex-grow flex items-center justify-center px-4 mb-16">
            <div class="text-center max-w-xl w-full">
                <h1 class="text-4xl font-bold mb-8">Welcome to Niche Cue Malaysia</h1>
            </div>
        </main>

        <!-- Bottom Navigation Bar -->
        <nav class="fixed bottom-0 left-0 right-0 bg-white shadow-lg">
            <div class="flex justify-around items-center h-16">
                <!-- About Us with PNG Image -->
                <a href="{{ url('/') }}" class="flex flex-col items-center text-purple-600 hover:text-purple-800">
                    <i class="fas fa-home text-xl mb-1"></i>
                    <span class="text-xs">About Us</span>
                </a>
                
                <!-- Search Icon -->
                <a href="{{ url('/Buyer/BuyerSearchProducts') }}" class="flex flex-col items-center text-purple-600 hover:text-purple-800">
                    <i class="fas fa-search text-xl mb-1"></i>
                    <span class="text-xs">Search</span>
                </a>
            </div>
        </nav>
    </body>
</html>
