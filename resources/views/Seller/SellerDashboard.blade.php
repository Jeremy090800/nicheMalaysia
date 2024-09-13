<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Seller Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" >
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
                <h2 class="text-4xl font-bold text-purple-600 mb-4">Welcome to Seller Centre</h2>
            </div>
            
            <div class="bg-white shadow-lg rounded-lg p-8 max-w-2xl w-full mb-8">
                <div class="flex flex-col items-center gap-4">
                    <a href="{{ url('/Seller/AddProducts') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out w-full max-w-md text-center">
                        Create New Product
                    </a>

                    <a href="{{ url('/products/upload_function') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out w-full max-w-md text-center">
                        Image Show All
                    </a>
                </div>
            </div>

            <!-- Product Listing Section -->
            <div class="bg-white shadow-lg rounded-lg p-4 md:p-8 max-w-full w-full overflow-hidden relative">
                <h3 class="text-2xl font-bold mb-6 text-center text-purple-600">Your Products</h3>
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
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serial ID</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ferrule</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Length</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Butt</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Balancing</th>
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
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->serial_id }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->ferrule }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->length }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->weight }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->butt }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $product->balancing }}</td>
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
                                            <a href="{{ url('/Seller/EditProduct/'.$product->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
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


        <!-- Image Modal (unchanged) -->
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
        </div>

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

            function showBulkDeleteConfirmation() {
                const checkboxes = document.getElementsByClassName('product-checkbox');
                const selectedSerialIds = [];
                for (let checkbox of checkboxes) {
                    if (checkbox.checked) {
                        selectedSerialIds.push(checkbox.getAttribute('data-serial-id'));
                    }
                }

                if (selectedSerialIds.length === 0) {
                    alert('Please select at least one product to delete.');
                    return;
                }

                const selectedSerialIdsElement = document.getElementById('selectedSerialIds');
                selectedSerialIdsElement.innerHTML = selectedSerialIds.map(id => `<div>${id}</div>`).join('');
                document.getElementById('bulkDeleteModal').classList.remove('hidden');
            }

            function hideBulkDeleteConfirmation() {
                document.getElementById('bulkDeleteModal').classList.add('hidden');
            }

            function submitBulkDelete() {
                document.getElementById('bulkDeleteForm').submit();
            }
        </script>
    </body>
</html>