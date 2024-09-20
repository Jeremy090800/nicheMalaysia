<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Seller Centre Login</title>
        <link rel="icon" href="{{ asset('images/niche_logo.jpg') }}" type="image/jpeg">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    </head>


    <body class="bg-gray-100 min-h-screen flex flex-col">

        <header class="bg-white shadow-md p-4 flex justify-center items-center">
            <h1 class="text-2xl font-bold text-purple-600">NicheCue Malaysia</h1>
        </header>

        <header class="p-4">
            <a href="{{ url('/') }}"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-block">
                Main Menu
            </a>
        </header>

        <main class="flex-grow flex items-center justify-center px-4">
            <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
                <h2 class="text-3xl font-bold mb-6 text-center">Seller Centre Login</h2>
                
                <!-- Display error message -->
                @if($errors->any())
                <div class="mb-4 p-3 bg-red-200 text-red-800 rounded text-center">
                    <ul class="list-none">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ url('/Seller/SellerLogin/handle_seller_login_function') }}" id="loginForm">
                    @csrf

                    <div class="mb-4">
                        <label for="seller_id" class="block text-gray-700 text-sm font-bold mb-2">Seller ID</label>
                        <input type="text" name="seller_id" id="seller_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>

                    <div class="mb-6 relative">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                                required>
                            <span id="togglePassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                                <i id="eyeIcon" class="fas fa-eye text-gray-500"></i>
                            </span>
                        </div>
                    </div>


                    <div class="flex items-center justify-center">
                        <button type="submit"
                            class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                            Login
                        </button>
                    </div>

                </form>
            </div>
        </main>




        <script>
            // Clear sessionStorage on page load
            window.addEventListener('load', function() {
                // Clear stored values to prevent residual data
                sessionStorage.removeItem('seller_id');
                sessionStorage.removeItem('password');

                // Restore values from sessionStorage if available
                if (sessionStorage.getItem('seller_id')) {
                    document.getElementById('seller_id').value = sessionStorage.getItem('seller_id');
                }
                if (sessionStorage.getItem('password')) {
                    document.getElementById('password').value = sessionStorage.getItem('password');
                }

            });

            // Store values in sessionStorage on input change
            document.getElementById('seller_id').addEventListener('input', function() {
                sessionStorage.setItem('seller_id', this.value);
            });

            document.getElementById('password').addEventListener('input', function() {
                sessionStorage.setItem('password', this.value);
            });

            // Toggle password visibility
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            const eyeIcon = document.querySelector('#eyeIcon');

            togglePassword.addEventListener('click', function (e) {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                if (type === 'password') {
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                } else {
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                }
            });


            @if(session('console_error'))    
                console.error('{{ session('console_error') }}');
            @endif



            // @if(session('auth_success') !== null)
            //     @if(session('auth_success') == true)
            //         console.log("Authentication passed.");
            //     @else
            //     console.log("Authentication failed.");
            //     @endif
            // @endif  



        </script>
    </body>
</html>