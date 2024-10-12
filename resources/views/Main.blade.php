<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>    
    <link rel="icon" href="{{ asset('images/niche_logo.jpg') }}" type="image/jpeg">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>


        .bg-image {
            padding-bottom: 0.75rem;
            background-image: url('{{ asset("images/Interior.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
            height: 100vh; /* Full height of viewport */
        }

        .content-wrapper {
            min-height: calc(100vh - 0.75rem);
            background-color: rgba(255, 255, 255, 0.8);
        }

        .overlay {
            position: absolute; /* Position overlay absolutely */
            top: 0; /* Start from the top */
            left: 0; /* Start from the left */
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            background-color: rgba(0, 0, 0, 0.5); /* White tint overlay */
            text-align: center; /* Center text */
            color: white; /* Text color */
            z-index: 1; /* Make sure overlay is below navigation bar */
            display: flex; /* Use flexbox to center content */
            flex-direction: column; /* Stack content vertically */
            justify-content: center; /* Center vertically */
            align-items: center; /* Center horizontally */
        }

        header {
            background-color: white; /* Ensure it's solid white */
        }

        .bg-white {
            background-color: rgba(255, 255, 255, 0.9) !important;
        }

        .search-container {
            padding-top: 1rem;
            padding-bottom: 2rem;
        }

        .display-3{
            font-size:calc(1.525rem + 3.3vw);
            font-weight:900;
            line-height:1.2}
            @media (min-width: 1200px)
            {.display-3{font-size:4rem}
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <header class="shadow-md p-3 flex justify-center items-center bg-black">
        <img src="{{ asset('images/Niche_Cues_Thailand.jpg') }}" alt="NicheCue Logo" class="h-12 w-12 mr-2"> 
        <h1 class="text-2xl font-bold text-white">Niche Cues Malaysia Factory</h1>

        <!--will be removed anytime, preserved for testing purpose-->

        <a href="{{ url('/Seller/SellerLogin') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded inline-block">
            Seller Centre
        </a>
    </header>

    <div class="content-wrapper flex-grow flex flex-col bg-image">
        <div class="overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8 text-center">
                        <h5 class="text-white font-bold mb-3 animated slideInDown" style="font-size: 1.25rem">WELCOME TO</h5>
                        <h1 class="display-3 text-white animated slideInDown mb-4">Niche Cue Malaysia</h1>
                        <p class="fw-medium font-bold text-white mb-4 pb-2" style="font-size: 1.25rem">Your Trusted Cue Builder</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Us Start -->
    <div class="container-xxl py-5 flex justify-center ">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h1 class="display-3 mb-5">About Us</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 text-center"> 
                    <p>
                        Welcome to Niche Cues Malaysia! We are dedicated to crafting the highest quality cues for enthusiasts and professionals alike. Our commitment to excellence and innovation sets us apart in the industry. With years of experience and a passion for precision, we ensure that every cue we create meets the highest standards. Thank you for choosing us as your trusted cue builder!
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- About Us End -->
    <!-- About Start -->
    <div class="container-fluid bg-light overflow-hidden my-5">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 relative" style="min-height: 400px;">
                <img class="absolute inset-0 object-cover w-full h-full" src="{{ asset('images/Interior.jpg') }}" alt="About Us">
            </div>
            <div class="w-full md:w-1/2 flex flex-col justify-center p-5">
                <div class="text-left">
                    <h1 class="text-4xl font-bold mb-4">About Us</h1>
                    <p class="mb-4 pb-2">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo erat amet</p>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-white w-16 h-16 flex items-center justify-center">
                                <i class="fa fa-users fa-2x text-primary"></i>
                            </div>
                            <div class="ml-3">
                                <h2 class="text-primary text-2xl" data-toggle="counter-up">1234</h2>
                                <p class="font-medium mb-0">Happy Clients</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-white w-16 h-16 flex items-center justify-center">
                                <i class="fa fa-check fa-2x text-primary"></i>
                            </div>
                            <div class="ml-3">
                                <h2 class="text-primary text-2xl" data-toggle="counter-up">1234</h2>
                                <p class="font-medium mb-0">Projects Done</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- About End -->




    <!-- Service Start -->
    <div class="container-xxl py-5 flex justify-center">
        <div class="container max-w-5xl pb-16"> <!-- Set a max-width for the container -->
            <div class="section-title text-center mb-5">
                <h1 class="display-3 mb-5">Our Services</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"> <!-- Use gap-4 for consistent spacing -->
                <div class="service-item p-4 border border-2 border-light rounded-lg"> <!-- Adjust padding here -->
                    <div class="overflow-hidden mb-3">
                        <img class="img-fluid" src="{{ asset('images/1.jpg') }}" alt="General Carpentry">
                    </div>
                    <h4 class="mb-2 text-lg font-semibold">General Carpentry</h4>
                    <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                </div>
                <div class="service-item p-4 border border-2 border-light rounded-lg">
                    <div class="overflow-hidden mb-3">
                        <img class="img-fluid" src="{{ asset('images/1.jpg') }}" alt="Furniture Manufacturing">
                    </div>
                    <h4 class="mb-2 text-lg font-semibold">Furniture Manufacturing</h4>
                    <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                </div>
                <div class="service-item p-4 border border-2 border-light rounded-lg">
                    <div class="overflow-hidden mb-3">
                        <img class="img-fluid" src="{{ asset('images/1.jpg') }}" alt="Furniture Remodeling">
                    </div>
                    <h4 class="mb-2 text-lg font-semibold">Furniture Remodeling</h4>
                    <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                </div>
                <div class="service-item p-4 border border-2 border-light rounded-lg">
                    <div class="overflow-hidden mb-3">
                        <img class="img-fluid" src="{{ asset('images/1.jpg') }}" alt="Wooden Floor">
                    </div>
                    <h4 class="mb-2 text-lg font-semibold">Wooden Floor</h4>
                    <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                </div>
                <div class="service-item p-4 border border-2 border-light rounded-lg">
                    <div class="overflow-hidden mb-3">
                        <img class="img-fluid" src="{{ asset('images/1.jpg') }}" alt="Wooden Furniture">
                    </div>
                    <h4 class="mb-2 text-lg font-semibold">Wooden Furniture</h4>
                    <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                </div>
                <div class="service-item p-4 border border-2 border-light rounded-lg">
                    <div class="overflow-hidden mb-3">
                        <img class="img-fluid" src="{{ asset('images/1.jpg') }}"alt="Custom Work">
                    </div>
                    <h4 class="mb-2 text-lg font-semibold">Custom Work</h4>
                    <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->








    <!-- Bottom Navigation Bar -->
    <nav class="fixed bottom-0 left-0 right-0 bg-black shadow-lg z-10">
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
