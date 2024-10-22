<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create New Series</title>
        <link rel="icon" href="{{ asset('images/niche_logo.jpg') }}" type="image/jpeg">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

        <style>
            .description-cell {
                max-width: 2000px;
                max-height: 100px;
                overflow-y: auto;
                word-wrap: break-word;
                white-space: normal;
            }
        </style>
    </head>

    <body class="bg-gray-100">

        <!--Header of the niche cue-->
        <header class="shadow-md p-3 flex justify-center items-center bg-black">
            <img src="{{ asset('images/Niche_Cues_Thailand.jpg') }}" alt="NicheCue Logo" class="h-12 w-12 mr-2"> 
            <h1 class="text-2xl font-bold text-white">Niche Cues Malaysia Factory</h1>
        </header>

        <!--Back Button-->
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

            @if (session('success'))
            <div id="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success! </strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        
            <script>
                // Automatically hide the success message after 5 seconds (5000ms)
                setTimeout(function() {
                    const successMessage = document.getElementById('successMessage');
                    if (successMessage) {
                        successMessage.style.transition = 'opacity 1s ease'; // Add fade-out transition
                        successMessage.style.opacity = '0'; // Set opacity to 0 to make it fade out
                        setTimeout(function() {
                            successMessage.remove(); // Remove the element from the DOM after fade out
                        }, 1000); // Wait for the transition to complete (1 second)
                    }
                }, 2000); // Wait for 2 seconds before fading out
            </script>
        @endif
        

            <form method="POST" action="{{ url('/Seller/AddSeries/handle_store_series_function') }}" id="seriesForm">
                @csrf
                <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <h2 class="text-2xl font-bold mb-4 text-center">Create New Series</h2>
                    
                    <!-- Series Name -->            
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="series_name">
                            Series Name:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="series_name" name="series_name" required>
                    </div>

                    <!-- Series Description -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="series_description">
                            Series Description:
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-40" id="series_description" name="series_description" maxlength="16383"></textarea>
                        <div class="mt-2 text-gray-600" id="charCount">
                            Maximum characters: 16,383 | Used: 0
                        </div>
                    </div>

                    <div class="flex items-center justify-center">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" id="submitBtn">
                            Create Series
                        </button>
                    </div>
                </div>
            </form>

            <!-- Existing Series -->
            <div class="max-w-xl mx-auto mt-8 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2 class="text-2xl font-bold mb-4 text-center">Existing Series</h2>
                
                @if($series->isEmpty())
                    <p class="text-center text-gray-700">No series found.</p>
                @else
                    <table class="min-w-full bg-white divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Series Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($series as $s)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $s->series_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 description-cell">{{ $s->series_description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg edit-button" 
                                            data-id="{{ $s->series_id }}" 
                                            data-name="{{ $s->series_name }}" 
                                            data-description="{{ $s->series_description }}"
                                            onclick="openEditPopup(this)">
                                                Edit
                                        </button>
                                        <button 
                                            type="button" 
                                            class="bg-red-500 text-white px-4 py-2 rounded-lg"
                                            onclick="openDeletePopup({{ $s->series_id }})">
                                                Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- Edit Modal -->
            <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
                    <h2 class="text-2xl font-bold mb-6">Edit Series Detail</h2>

                    <form id="editSeriesForm" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="series_id" id="editSeriesId" value="">
                        <div>
                            <label for="editSeriesName" class="block text-gray-700 text-lg mb-2">Series Name:</label>
                            <input type="text" name="series_name" id="editSeriesName" required class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg">
                        </div>
                        <div>
                            <label for="editSeriesDescription" class="block text-gray-700 text-lg mb-2">Series Description:</label>
                                <!-- Edit Form -->
                                <textarea id="editSeriesDescription" name="series_description" maxlength="16383" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-40"></textarea>
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

            <!-- Delete Modal -->
            <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-lg font-bold mb-4">Are you sure you want to delete this series?</h2>
                    <p>This action cannot be undone.</p>
                    <div class="flex justify-between mt-4">
                        <button type="button" onclick="closeDeletePopup()" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Cancel</button>
                        <button type="button" id="confirmDeleteButton" class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete</button>
                    </div>
                </div>
            </div>

        </div>

        <script>
            // Track form changes
            let formChanged = false;
            // Function to check if form has unsaved changes
            function checkFormChanges() {
                const form = document.getElementById('seriesForm');
                const formElements = form.querySelectorAll('input, textarea');
                
                formElements.forEach(element => {
                    element.addEventListener('input', () => {
                        formChanged = true;
                    });
                });
            }
            // Handle page back button click
            document.getElementById('backButton').addEventListener('click', function(event) {
                if (formChanged) {
                    event.preventDefault();
                    if (confirm('Your entered data will be cleared and not saved. Are you sure you want to go back?')) {
                        formChanged = false; // Reset the flag
                        window.location.href = this.href;
                    }
                }
            });
            // Handle browser back button and page unload
            window.addEventListener('beforeunload', function(event) {
                if (formChanged) {
                    // Modern browsers don't show custom messages, but we need to set this
                    // to trigger the confirmation dialog
                    event.preventDefault();
                    event.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
                    return event.returnValue;
                }
            });
            // Handle browser back button using History API
            window.addEventListener('popstate', function(event) {
                if (formChanged) {
                    if (confirm('Your entered data will be cleared and not saved. Are you sure you want to go back?')) {
                        formChanged = false;
                        history.back();
                    } else {
                        // Prevent going back by pushing a new state
                        history.pushState(null, '', window.location.href);
                    }
                }
            });
            // Initialize form change tracking when the page loads
            document.addEventListener('DOMContentLoaded', function() {
                checkFormChanges();
                // Push an initial state to enable popstate handling
                history.pushState(null, '', window.location.href);
            });





            // Character count functionality for AddSeries form
            const descriptionField = document.getElementById('series_description');
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





            //open the EditSeries popup
            function openEditPopup(button) {
                // Retrieve data from button attributes
                const seriesId = button.getAttribute('data-id');
                const seriesName = button.getAttribute('data-name');
                const seriesDescription = button.getAttribute('data-description');

                // Set values in the popup form
                document.getElementById('editSeriesId').value = seriesId;
                document.getElementById('editSeriesName').value = seriesName;
                document.getElementById('editSeriesDescription').value = seriesDescription;

                // Update form action to include seriesId in the URL
                const form = document.getElementById('editSeriesForm');
                if (form) {
                    //form.action = `UpdateSeries/${seriesId}`;
                    form.action = `{{ url('/Seller/UpdateSeries') }}/${seriesId}`;
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
            //close the EditSeries popup
            function closeEditPopup(){
                document.getElementById('editModal').classList.add('hidden');
            }
            // Character count functionality for EditSeries popup
            const editDescriptionField = document.getElementById('editSeriesDescription');
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





            // Variable to store the current seriesId for deletion
            let seriesIdToDelete = null;
            //open the DeleteSeries popup
            function openDeletePopup(seriesId) {
                seriesIdToDelete = seriesId; //store the seriesId
                document.getElementById('deleteModal').classList.remove('hidden'); // Show the modal
            }
            // Close the DeleteSeries popup
            function closeDeletePopup() {
                document.getElementById('deleteModal').classList.add('hidden'); // Hide the modal
                seriesIdToDelete = null; // Reset the stored prefix
            }
            document.getElementById('confirmDeleteButton').addEventListener('click', function() {
                
                if (seriesIdToDelete) {
                    // Create and submit a form for the deletion
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `{{ url('/Seller/DeleteSeries') }}/${seriesIdToDelete}`;
                    //form.action = `/Seller/DeleteSeries/${seriesIdToDelete}`;
                    

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