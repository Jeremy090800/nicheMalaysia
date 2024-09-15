<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Create New Product</title>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  </head>

  <body class="bg-gray-100">
        <header class="bg-white shadow-md p-4 flex justify-center items-center">
            <h1 class="text-2xl font-bold text-purple-600">NicheCue Malaysia</h1>
        </header>

        <header class="p-4">
            <a href="{{ url('/') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-block" id="backButton">
                &larr; Back
            </a>
        </header>


        <div class="container mx-auto px-4 py-8">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('Seller/AddProducts/handle_store_products_function') }}" enctype="multipart/form-data" id="productForm">
                @csrf
                <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    
                    <!-- Serial ID of the products -->
                    <h2 class="text-2xl font-bold mb-4 text-center">Create New Product</h2>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="serial_id">
                            Serial ID:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="serial_id" name="serial_id" required>
                    </div>
                    
                    <!-- Ferrule of the products -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="ferrule">
                            Ferrule (mm):
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="ferrule" name="ferrule" min="0" required>
                    </div>
                    
                    <!-- Length of the products -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="length">
                            Length (cm):
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="length" name="length" required>
                    </div>
                    
                    <!-- Weight of the products -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="weight">
                            Weight (oz):
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="weight" name="weight" required>
                    </div>
                    
                    <!-- Butt Length of the products -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="butt">
                            Butt Length (cm):
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="butt" name="butt" required>
                    </div>
                    
                    <!-- Balancing of the products -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="balancing">
                            Balancing Point (cm):
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="balancing" name="balancing" required>
                    </div>

                    <!-- Image Upload Section -->
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="imageInput">
                            Upload Images:
                        </label>
                        <input type="file" name="images[]" id="imageInput" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept="image/*" multiple>
                    </div>

                    <div id="imagePreview" class="grid grid-cols-3 gap-4 mb-4"></div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-center">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Create Product
                        </button>
                    </div>
                    
                </div>
            </form>
        </div>

        <script>
            let selectedFiles = [];
            //track whether the form has been modified
            let formChanged = false;

            // Listen for changes on all form inputs
            document.querySelectorAll('#productForm input, #productForm select, #productForm textarea').forEach(element => {
                element.addEventListener('change', function() {
                    formChanged = true;
                });
                element.addEventListener('input', function() {
                    formChanged = true;
                });
            });

            // Handle back button click
            document.getElementById('backButton').addEventListener('click', function(event) {
                if (formChanged) {
                    event.preventDefault();
                    if (confirm('Your entered data will be cleared and not saved. Are you sure you want to go back?')) {
                        window.location.href = this.href;
                    }
                }
            });

            // Handle browser back button and page unload
            window.addEventListener('beforeunload', function (e) {
                if (formChanged) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });


            document.getElementById('imageInput').addEventListener('change', function(event) {
                const newFiles = Array.from(event.target.files);

                // Add new files to the existing selection
                selectedFiles = [...selectedFiles, ...newFiles].slice(0, 6); // Limit to 6 images

                updatePreviews();
            });

            function updatePreviews() {
                const preview = document.getElementById('imagePreview');
                preview.innerHTML = '';

                selectedFiles.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgContainer = document.createElement('div');
                        imgContainer.className = 'relative';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('w-full', 'h-auto', 'object-cover', 'mb-2');

                        const removeBtn = document.createElement('button');
                        removeBtn.textContent = 'X';
                        removeBtn.className = 'absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center';
                        removeBtn.onclick = function(e) {
                            e.preventDefault(); // Prevent form submission
                            removeImage(index);
                        };

                        const fileName = document.createElement('p');
                        fileName.textContent = file.name;
                        fileName.className = 'text-sm text-gray-600 truncate';

                        imgContainer.appendChild(img);
                        imgContainer.appendChild(removeBtn);
                        imgContainer.appendChild(fileName);
                        preview.appendChild(imgContainer);
                    };
                    reader.readAsDataURL(file);
                });

                updateFileInput();
            }

            function removeImage(index) {
                selectedFiles.splice(index, 1);
                updatePreviews();
            }

            function updateFileInput() {
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => {
                    dataTransfer.items.add(file);
                });
                document.getElementById('imageInput').files = dataTransfer.files;
            }
        </script>
  </body>
</html>
