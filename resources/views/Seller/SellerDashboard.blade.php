<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Seller Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 min-h-screen flex flex-col">
        <header class="bg-white shadow-md p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-purple-600">Niche Malaysia Seller Centre</h1>
            <button onclick="showLogoutConfirmation()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                Logout
            </button>
        </header>

        <main class="flex-grow flex flex-col items-center justify-center px-4 py-8">
            <div class="text-center max-w-2xl w-full mb-8">
                <h2 class="text-4xl font-bold text-purple-600 mb-4">Welcome to Niche Malaysia</h2>
                <p class="text-gray-700 text-lg mb-6">We're excited to have you here, Seller! Let's make great things happen together.</p>
            </div>
            
            <div class="bg-white shadow-lg rounded-lg p-8 max-w-2xl w-full">
                <h3 class="text-2xl font-bold mb-6 text-center">Seller Actions</h3>
                <div class="flex flex-col items-center gap-4">
                    <a href="{{ url('/products/create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out w-full max-w-md text-center">
                        Create New Product
                    </a>
                    
                    <a href="{{ url('/products/search') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out w-full max-w-md text-center">
                        Search Product
                    </a>

                    <a href="{{ url('/products/upload_function') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out w-full max-w-md text-center">
                        Image Show All
                    </a>
                </div>
            </div>
        </main>

        <!-- Logout Confirmation Modal -->
        <div id="logoutModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Logout Confirmation</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">
                            Are you sure you want to logout?
                        </p>
                    </div>
                    <div class="items-center px-4 py-3">
                        <form id="logoutForm" action="{{ url('/Seller/SellerLogout') }}" method="POST" class="flex justify-center gap-4">
                            @csrf
                            <button type="button" onclick="hideLogoutConfirmation()" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-24 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                No
                            </button>
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-24 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                                Yes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function showLogoutConfirmation() {
                document.getElementById('logoutModal').classList.remove('hidden');
            }

            function hideLogoutConfirmation() {
                document.getElementById('logoutModal').classList.add('hidden');
            }
        </script>
    </body>
</html>