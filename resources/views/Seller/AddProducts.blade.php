<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Create New Product</title>
      <link rel="icon" href="{{ asset('images/niche_logo.jpg') }}" type="image/jpeg">
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  </head>

  <body class="bg-gray-100">
        <header class="shadow-md p-3 flex justify-center items-center bg-black">
            <img src="{{ asset('images/Niche_Cues_Thailand.jpg') }}" alt="NicheCue Logo" class="h-12 w-12 mr-2"> 
            <h1 class="text-2xl font-bold text-white">Niche Cues Malaysia Factory</h1>
        </header>

        <header class="p-4">
            <a href="{{ url('/Seller/SellerDashboard') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-block" id="backButton">
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


                    <!-- Category Dropdown -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <label class="text-gray-700 text-sm font-bold" for="category">
                                Category: <span class="text-red-500">*</span>
                            </label>

                            <a href="{{ url('/Seller/AddCategories') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-1 px-2 rounded transition duration-300 ease-in-out">
                                New Category
                            </a>
                        </div>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="category" name="category_prefix" required>

                                @forelse($categories as $category)
                                    <option value="{{ $category->category_prefix }}" data-name="{{ $category->category_name }}">{{ $category->category_name }}</option>
                                @empty
                                    <option value="" disabled>No categories available</option>
                                @endforelse
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        @if($categories->isEmpty())
                            <p class="text-red-500 text-xs italic mt-2">No categories created yet</p>
                        @endif
                    </div>

                    <!--Serial_id of the product-->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="serial_id">
                            Serial ID: <span class="text-red-500">*</span>
                        </label>
                        <div class="flex items-center">
                            <span id="serialPrefix" class="bg-gray-200 text-gray-700 py-2 px-3 rounded-l"></span>
                            <input class="shadow appearance-none border rounded-r w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="serial_id" name="serial_id" required>
                        </div>
                    </div>





                    <!-- Ferrule of the products -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="ferrule">
                            Ferrule (mm): <span class="text-red-500">*</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="ferrule" name="ferrule" min="0" required>
                    </div>
                    
                    <!-- Length of the products -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="length">
                            Length (cm): <span class="text-red-500">*</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="length" name="length" required>
                    </div>
                    
                    <!-- Weight of the products -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="weight">
                            Weight (oz): <span class="text-red-500">*</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="weight" name="weight" required>
                    </div>
                    
                    <!-- Butt Length of the products -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="butt">
                            Butt Length (cm): <span class="text-red-500">*</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="butt" name="butt" required>
                    </div>
                    
                    <!-- Balancing of the products -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="balancing">
                            Balancing Point (cm): <span class="text-red-500">*</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="balancing" name="balancing" required >
                    </div>

                    <!-- Products Description -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                            Product Description:
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-40" id="description" name="description" maxlength="16383"></textarea>
                        <div class="mt-2 text-gray-600" id="charCount">
                            Maximum characters: 16,383 | Used: 0
                        </div>
                    </div>


                    <!-- owned by -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="owned_by">
                            Owned By: (Upcoming Update) 
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100 cursor-not-allowed" type="text" id="owned_by" name="owned_by" readonly>
                    </div>

                    <!--working code-->
                    {{-- <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="owned_by">
                            Owned by: 
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="owned_by" name="owned_by" required>
                    </div> --}}


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
            let isSubmitting = false; 

            // Listen for changes on all form inputs
            document.querySelectorAll('#productForm input, #productForm select, #productForm textarea').forEach(element => {
                element.addEventListener('change', function() {
                    formChanged = true;
                });
                element.addEventListener('input', function() {
                    formChanged = true;
                });
            });

            // Handle form submission
            document.getElementById('productForm').addEventListener('submit', function() {
                isSubmitting = true;
            });

            // // Handle back button click
            // document.getElementById('backButton').addEventListener('click', function(event) {
            //     if (formChanged) {
            //         event.preventDefault();
            //         if (confirm('Your entered data will be cleared and not saved. Are you sure you want to go back?')) {
            //             window.location.href = this.href;
            //         }
            //     }
            // });

            // Handle browser back button and page unload
            window.addEventListener('beforeunload', function (e) {
                if (formChanged && !isSubmitting) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });

            // Character count functionality
            const descriptionField = document.getElementById('description');
            const charCountDisplay = document.getElementById('charCount');
            const maxChars = 16383;

            function updateCharCount() {
                const charCount = descriptionField.value.length;
                charCountDisplay.textContent = `Maximum characters: ${maxChars} | Used: ${charCount}`;
            }

            descriptionField.addEventListener('input', function() {
                updateCharCount();
                if (descriptionField.value.length >= maxChars) {
                    descriptionField.value = descriptionField.value.substring(0, maxChars); // Prevent exceeding the limit
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



            //add category java script
            document.addEventListener('DOMContentLoaded', function() {
                const categorySelect = document.getElementById('category');
                const serialIdInput = document.getElementById('serial_id');
                const serialPrefix = document.getElementById('serialPrefix');

                function updateSerialPrefix() {
                    const selectedOption = categorySelect.options[categorySelect.selectedIndex];
                    const categoryName = selectedOption.getAttribute('data-name');
                    const categoryType = selectedOption.value;

                    serialPrefix.textContent = categoryType + '-';
                }

                categorySelect.addEventListener('change', updateSerialPrefix);

                // Initial call to set the correct prefix and placeholder
                updateSerialPrefix();
            });







        </script>
  </body>
</html>
