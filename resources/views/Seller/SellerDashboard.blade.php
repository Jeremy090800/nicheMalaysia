<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Seller Dashboard</title>
        <link rel="icon" href="{{ asset('images/niche_logo.jpg') }}" type="image/jpeg">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" >
    </head>
    <body class="bg-gray-100 min-h-screen flex flex-col">

        <header class="relative shadow-md p-3 bg-black flex justify-center items-center">
            <div class="flex items-center">
                <img src="{{ asset('images/Niche_Cues_Thailand.jpg') }}" alt="NicheCue Logo" class="h-12 w-12 mr-2"> 
                <h1 class="text-2xl font-bold text-white">Niche Cues Malaysia Factory</h1>
            </div>
            <button onclick="showLogoutConfirmation()" class="absolute right-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                Logout
            </button>
        </header>

        <main class="flex-grow flex flex-col items-center justify-center px-4 py-8">

            <div class="text-center max-w-2xl w-full mb-8">
                <h2 class="text-4xl font-bold text-black-600 mb-4">Welcome to Seller Centre</h2>
            </div>
            
            <div class="bg-white shadow-lg rounded-lg p-8 max-w-2xl w-full mb-8">
                <div class="flex flex-col items-center gap-4">
                    <a href="{{ url('/Seller/AddProducts') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out w-full max-w-md text-center">
                        Create New Product
                    </a>

                    <a href="{{ url('/Seller/AddSeries_SellerDashboard') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out w-full max-w-md text-center">
                        Create New Series
                    </a>

                </div>
            </div>

            <!-- Product Listing Section -->
            <div class="bg-white shadow-lg rounded-lg p-4 md:p-8 max-w-full w-full overflow-hidden relative">
                <h3 class="text-2xl font-bold mb-6 text-center text-black-600">Your Products</h3>
                <button type="button" 
                    onclick="showBulkDeleteConfirmation()" 
                    class="absolute top-6 right-4 text-red-500 hover:text-red-700 transition duration-300 ease-in-out z-10">
                    <i class="fas fa-trash-alt text-xl"></i>
                </button>
                <div class="overflow-x-auto">
                    <form id="bulkDeleteForm" action="{{ url('/Seller/BulkDeleteProducts') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <table class="min-w-full bg-white table-auto">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <input type="checkbox" id="selectAll" onclick="toggleAllCheckboxes()">
                                    </th>

                                    <!--Series Name-->
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Warranty Number</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serial ID</th>
                                    {{-- <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th> --}}
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Series</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ferrule(mm)</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Length(mm)</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight(mm)</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Butt(mm)</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Balancing</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owned By</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                                    
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Images</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <input type="checkbox" name="selected_products[]" value="{{ $product->id }}" class="product-checkbox" data-serial-id="{{ $product->serial_id }}">
                                        </td>

                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->warranty_number }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->serial_id }}</td>
                                        {{-- <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->categories->category_prefix }}-{{ $product->serial_id }}</td> --}}
                                        {{-- <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->categories->category_name }}</td> --}}
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->series->series_name }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->ferrule }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->length }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->weight }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->butt }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->balancing }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->description }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->owned_by }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">
                                            {{ $product->created_at->setTimezone('Asia/Kuala_Lumpur')->format('Y F j, h:i A') }}
                                        </td>
                                        


                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <!-- Display images (unchanged) -->
                                            @if($product->images)
                                                <div class="flex space-x-2 overflow-x-auto">
                                                    @php
                                                        $productImages = [];
                                                        $imageFileNames = [];
                                                        for ($i = 1; $i <= 6; $i++) {
                                                            $imageField = 'images_data_' . $i;
                                                            $fileNameField = 'images_file_name_' . $i;
                                                            if ($product->images->$imageField) {
                                                                $productImages[] = base64_encode($product->images->$imageField);
                                                                $imageFileNames[] = $product->images->$fileNameField ?? 'Unknown';
                                                            }
                                                        }
                                                    @endphp
                                                    @foreach($productImages as $index => $image)
                                                        <img src="data:image/jpeg;base64,{{ $image }}" 
                                                            alt="Image {{ $index + 1 }}" 
                                                            class="h-12 w-12 object-cover cursor-pointer"
                                                            onclick="openImageModal({{ json_encode($productImages) }}, {{ json_encode($imageFileNames) }}, {{ $index }}, '{{ $product->serial_id }}')">
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-gray-500">No Images</span>
                                            @endif
                                        </td>


                                        <td class="px-4 py-2 whitespace-nowrap text-sm font-medium">
                                            <button class="text-indigo-600 hover:text-indigo-900 mr-2" 
                                            data-id="{{ $product->id }}" 
                                            data-warranty_number="{{ $product->warranty_number }}" 
                                            data-serial_id="{{ $product->serial_id }}"
                                            data-series_id="{{ $product->series_id }}"
                                            data-ferrule="{{ $product->ferrule }}"
                                            data-length="{{ $product->length }}"
                                            data-weight="{{ $product->weight }}"
                                            data-butt="{{ $product->butt }}"
                                            data-balancing="{{ $product->balancing }}"
                                            data-description="{{ $product->description }}"
                                            onclick="openEditProductModal(this)"
                                            type="button"   >
                                                Edit
                                            </button>
                                        </td>

                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-4 py-2 text-center text-gray-500">No products found. Create a new product to get started!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </main>

        

        <!-- Edit Product Modal -->
        <div id="editProductModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
            <div class="relative top-20 mx-auto p-6 border w-11/12 max-w-3xl shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">Edit Product Details</h3>
                    <form id="editProductForm" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editProductId" name="id">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Warranty Number -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Warranty Number</label>
                                <input type="text" id="editWarrantyNumber" name="warranty_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Serial ID -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Serial ID</label>
                                <input type="text" id="editSerialId" name="serial_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Series -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Series</label>
                                <select id="editSeries" name="series_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @foreach($series as $s)
                                        <option value="{{ $s->series_id }}">{{ $s->series_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Ferrule -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ferrule (mm)</label>
                                <input type="number" step="0.1" id="editFerrule" name="ferrule" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Length -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Length (mm)</label>
                                <input type="number" step="0.1" id="editLength" name="length" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Weight -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Weight (mm)</label>
                                <input type="number" step="0.1" id="editWeight" name="weight" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Butt -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Butt (mm)</label>
                                <input type="number" step="0.1" id="editButt" name="butt" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Balancing -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Balancing</label>
                                <input type="text" id="editBalancing" name="balancing" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="editDescription" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        </div>

                        <div class="flex justify-end space-x-3 mt-5">
                            <button type="button" onclick="closeEditProductModal()" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




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


        {{-- <!-- Image Modal (unchanged) -->
        <div id="imageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
            <!-- ... (keep the existing image modal code) ... -->
        </div>

        <!-- Bulk Delete Confirmation Modal -->
        <div id="bulkDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Confirmation</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">
                            Are you sure you want to delete the following products?
                        </p>
                        <div id="selectedSerialIds" class="mt-2 text-sm text-gray-700"></div>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button type="button" onclick="hideBulkDeleteConfirmation()" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-24 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 mr-2">
                            Cancel
                        </button>
                        <button type="button" onclick="submitBulkDelete()" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-24 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}

        <script>
            let currentProductImages = [];
            let currentImageFileNames = [];
            let currentImageIndex = 0;
            let currentSerialId = '';

            function showLogoutConfirmation() {
                document.getElementById('logoutModal').classList.remove('hidden');
            }

            function hideLogoutConfirmation() {
                document.getElementById('logoutModal').classList.add('hidden');
            }

            function openImageModal(images, fileNames, startIndex, serialId) {
                currentProductImages = images;
                currentImageFileNames = fileNames;
                currentImageIndex = startIndex;
                currentSerialId = serialId;
                updateModalImage();
                document.getElementById('serialId').textContent = `Serial ID: ${serialId}`;
                document.getElementById('imageModal').classList.remove('hidden');
            }

            function closeImageModal() {
                document.getElementById('imageModal').classList.add('hidden');
            }

            function updateModalImage() {
                const currentImage = document.getElementById('currentImage');
                currentImage.src = `data:image/jpeg;base64,${currentProductImages[currentImageIndex]}`;
                document.getElementById('fileName').textContent = `File Name: ${currentImageFileNames[currentImageIndex]}`;
            }

            function changeImage(direction) {
                currentImageIndex = (currentImageIndex + direction + currentProductImages.length) % currentProductImages.length;
                updateModalImage();
            }

            function toggleAllCheckboxes() {
                const checkboxes = document.getElementsByClassName('product-checkbox');
                const selectAllCheckbox = document.getElementById('selectAll');
                for (let checkbox of checkboxes) {
                    checkbox.checked = selectAllCheckbox.checked;
                }
            }

            // function showBulkDeleteConfirmation() {
            //     const checkboxes = document.getElementsByClassName('product-checkbox');
            //     const selectedSerialIds = [];
            //     for (let checkbox of checkboxes) {
            //         if (checkbox.checked) {
            //             selectedSerialIds.push(checkbox.getAttribute('data-serial-id'));
            //         }
            //     }

            //     if (selectedSerialIds.length === 0) {
            //         alert('Please select at least one product to delete.');
            //         return;
            //     }

            //     const selectedSerialIdsElement = document.getElementById('selectedSerialIds');
            //     selectedSerialIdsElement.innerHTML = selectedSerialIds.map(id => `<div>${id}</div>`).join('');
            //     document.getElementById('bulkDeleteModal').classList.remove('hidden');
            // }

            // function hideBulkDeleteConfirmation() {
            //     document.getElementById('bulkDeleteModal').classList.add('hidden');
            // }

            // function submitBulkDelete() {
            //     document.getElementById('bulkDeleteForm').submit();
            // }
            
            



            // Add these functions to your existing script section
            function openEditProductModal(button) {
                event.preventDefault();

                document.getElementById('editProductId').value = button.getAttribute('data-id');
                document.getElementById('editWarrantyNumber').value = button.getAttribute('data-warranty_number');
                document.getElementById('editSerialId').value = button.getAttribute('data-serial_id');
                document.getElementById('editSeries').value = button.getAttribute('data-series_id');
                document.getElementById('editFerrule').value = button.getAttribute('data-ferrule');
                document.getElementById('editLength').value = button.getAttribute('data-length');
                document.getElementById('editWeight').value = button.getAttribute('data-weight');
                document.getElementById('editButt').value = button.getAttribute('data-butt');
                document.getElementById('editBalancing').value = button.getAttribute('data-balancing');
                document.getElementById('editDescription').value = button.getAttribute('data-description');

                // Update form action
                const form = document.getElementById('editProductForm');
                form.action = `/Seller/UpdateProduct/${button.getAttribute('data-id')}`;

                // Show the modal
                document.getElementById('editProductModal').classList.remove('hidden');
            }

            function closeEditProductModal() {
                document.getElementById('editProductModal').classList.add('hidden');
            }

            // Close modal when clicking outside
            document.getElementById('editProductModal').addEventListener('click', function(event) {
                if (event.target === this) {
                    closeEditProductModal();
                }
            });



        </script>
    </body>
</html>