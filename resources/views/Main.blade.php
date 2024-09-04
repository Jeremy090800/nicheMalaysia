<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Main Page</title>    
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    </head>

    <body class="bg-gray-100 h-screen flex items-center justify-center">
    
        <div class="text-center">
        
            <h1 class="text-4xl font-bold mb-8">Welcome to Niche Cue Malaysia</h1>
            <div class="space-x-4">
                <a href="{{ url('/showForm') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    testing insert
                </a>
                <a href="{{ url('/products/create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Create New Product
                </a>

                <!--might delete this anytime-->
                <a href="{{ url('/products/search') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Search Product
                </a>
            </div>
        
        </div>
    </body>
</html>