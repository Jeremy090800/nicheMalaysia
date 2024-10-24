<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create New Category</title>
        <link rel="icon" href="{{ asset('images/niche_logo.jpg') }}" type="image/jpeg">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

        <style>
            /* Ensures text wraps correctly and adds a scrollbar for overflow */
            .description-cell {
                max-width: 2000px; /* Set a maximum width as per your design */
                max-height: 100px; /* Set a maximum height */
                overflow-y: auto; /* Adds a vertical scrollbar if content is too long */
                word-wrap: break-word; /* Wraps long words to prevent overflow */
                white-space: normal; /* Ensures text wraps within the cell */
            }
        </style>
        
    </head>

    <body class="bg-gray-100">
        <header class="bg-white shadow-md p-4 flex justify-center items-center">
            <h1 class="text-2xl font-bold text-purple-600">NicheCue Malaysia</h1>
        </header>

        <header class="p-4">
            <a href="{{ url('/Seller/AddProducts') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-block" id="backButton">
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

            <form method="POST" action="{{ url('/Seller/AddCategories/handle_store_categories_function') }}" id="categoryForm">
                @csrf
                <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    
                    <!-- Category Type -->
                    <h2 class="text-2xl font-bold mb-4 text-center">Create New Category</h2>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category_prefix">
                            Category Type:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="category_prefix" name="category_prefix" required>
                    </div>
                    
                    <!-- Category Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category_name">
                            Category Name:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="category_name" name="category_name" required>
                    </div>
                    
                    <!-- Category Description -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category_description">
                            Category Description:
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-40" id="category_description" name="category_description" maxlength="16383"></textarea>
                        <div class="mt-2 text-gray-600" id="charCount">
                            Maximum characters: 16,383 | Used: 0
                        </div>
                    </div>


                    <!-- Submit Button -->
                    <div class="flex items-center justify-center">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" id="submitBtn">
                            Create Category
                        </button>
                    </div>
                    
                </div>
            </form>




            <!-- Existing Categories -->
            <div class="max-w-xl mx-auto mt-8 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2 class="text-2xl font-bold mb-4 text-center">Existing Categories</h2>
                
                @if($categories->isEmpty())
                    <p class="text-center text-gray-700">No categories found.</p>
                @else
                    <table class="min-w-full bg-white divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                
                                <!--NEWLY ADDED-->
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($categories as $category)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->category_prefix }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->category_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 description-cell">{{ $category->category_description }}</td>

                                    <!--NEWLY ADDED-->
                                    <!--EDIT BUTTON-->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg edit-button" 
                                            data-prefix="{{ $category->category_prefix }}" 
                                            data-name="{{ $category->category_name }}" 
                                            data-description="{{ $category->category_description }}"
                                            onclick="openEditPopup(this)">
                                                Edit
                                        </button>

                                    <!--NEWLY ADDED-->
                                    <!--DELETE BUTTON-->
                                    <button 
                                        type="button" 
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg"
                                        onclick="openDeletePopup('{{ $category->category_prefix }}')">
                                            Delete
                                    </button>

                                    </td>
                                    


                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>




            <!--MEWLY ADDED-->
            <!-- POP UP FORM FOR EDIT CATEGORY -->
            <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
                    <h2 class="text-2xl font-bold mb-6">Edit Category Detail</h2>
                    
                    <form id="editCategoryForm" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="category_prefix" id="editSeriesPrefix" value="">
                        <div>
                            <label for="editCategoryName" class="block text-gray-700 text-lg mb-2">Category Name:</label>
                            <input type="text" name="category_name" id="editCategoryName" required class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg">
                        </div>
                        <div>
                            <label for="editCategoryDescription" class="block text-gray-700 text-lg mb-2">Category Description:</label>
                                <!-- Edit Form -->
                                <textarea id="editCategoryDescription" name="category_description" maxlength="16383" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-40"></textarea>
                                <div class="mt-2 text-gray-600" id="editCharCount">
                                    Maximum characters: 16,383 | Used: 0
                                </div>

                        </div>
                        <div class="flex justify-between pt-4">
                            <button type="button" onclick="closeEditPopup()" class="bg-red-500 text-white px-6 py-3 rounded-lg text-lg">Cancel</button>
                            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg text-lg">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <!--MEWLY ADDED-->
            <!-- POP UP FORM FOR DELETE CATEGORY -->
            <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-lg font-bold mb-4">Are you sure you want to delete this category?</h2>
                    <p>This action cannot be undone.</p>
                    <div class="flex justify-between mt-4">
                        <button type="button" onclick="closeDeletePopup()" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Cancel</button>
                        <button type="button" id="confirmDeleteButton" class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete</button>
                    </div>
                </div>
            </div>

        </div>



        <script>
            let formChanged = false;
            let isFormSubmitting = false;
        
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
                if (formChanged && !isFormSubmitting) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });
        
            // Confirm before submitting the form
            document.getElementById('categoryForm').addEventListener('submit', function(event) {
                isFormSubmitting = true;
                if (!confirm('Are you sure you want to create this category?')) {
                    event.preventDefault(); // Prevent form submission if user cancels
                }
            });


            // Character count functionality for addForm
            const descriptionField = document.getElementById('category_description');
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


            // Character count functionality for Edit Form
            const editDescriptionField = document.getElementById('editCategoryDescription');
            const editCharCountDisplay = document.getElementById('editCharCount');
            const maxEditChars = 16383;
            function updateEditCharCount() {
                const charCount = editDescriptionField.value.length;
                editCharCountDisplay.textContent = `Maximum characters: ${maxEditChars} | Used: ${charCount}`;
            }
            editDescriptionField.addEventListener('input', function() {
                updateEditCharCount();
                if (editDescriptionField.value.length >= maxEditChars) {
                    editDescriptionField.value = editDescriptionField.value.substring(0, maxEditChars); // Prevent exceeding the limit
                }
            });

            //open the editpopup
            function openEditPopup(button) {
                // Retrieve data from button attributes
                const categoryPrefix = button.getAttribute('data-prefix');
                const categoryName = button.getAttribute('data-name');
                const categoryDescription = button.getAttribute('data-description');

                // Set values in the popup form
                document.getElementById('editCategoryPrefix').value = categoryPrefix;
                document.getElementById('editCategoryName').value = categoryName;
                document.getElementById('editCategoryDescription').value = categoryDescription;

                // Update form action to include category prefix in the URL
                const form = document.getElementById('editCategoryForm');
                if (form) {
                    form.action = `UpdateCategories/${categoryPrefix}`;
                } else {
                    console.error("Form element not found");
                }

                //Update the character count when the popup opens
                updateEditCharCount();

                // Show the popup/modal (implement the logic for showing your modal here)
                document.getElementById('editModal').classList.remove('hidden');
                // For example, if you are using a modal from a library, you could do something like:
                // $('#yourModalId').modal('show');
            }
            //close the editpopup
            function closeEditPopup(){
                document.getElementById('editModal').classList.add('hidden');
            }


            
            // Variable to store the current category prefix for deletion
            let categoryPrefixToDelete = null;

            function openDeletePopup(categoryPrefix) {
                categoryPrefixToDelete = categoryPrefix; // Store the category prefix
                document.getElementById('deleteModal').classList.remove('hidden'); // Show the modal
            }

            function closeDeletePopup() {
                document.getElementById('deleteModal').classList.add('hidden'); // Hide the modal
                categoryPrefixToDelete = null; // Reset the stored prefix
            }

            document.getElementById('confirmDeleteButton').addEventListener('click', function() {
                if (categoryPrefixToDelete) {
                    // Create and submit a form for the deletion
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `DeleteCategory/${categoryPrefixToDelete}`;

                    // Add CSRF token
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}'; // Laravel's CSRF token

                    // Add DELETE method override
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    // Append inputs and submit form
                    form.appendChild(csrfInput);
                    form.appendChild(methodInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });

            
        </script>
        
    </body>
</html>
