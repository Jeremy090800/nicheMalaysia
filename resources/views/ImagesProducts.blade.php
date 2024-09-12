<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload Multiple Images Incrementally</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Upload Multiple Images</h1>

            <div class="mb-6">
                <a href="{{ url('/') }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    &larr; Back
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/products/handle_upload_function') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                <div class="max-w-md mx-auto">
                    <input type="text" name="images_name" class="block w-full text-gray-700 bg-gray-200 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" placeholder="Image Name" required>
                    <input type="file" name="images[]" id="imageInput" class="block w-full text-gray-700 bg-gray-200 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" accept="image/*" multiple>
                    <div id="imagePreview" class="grid grid-cols-3 gap-4 mb-4"></div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Upload Images
                    </button>
                </div>
            </form>

            <a href="{{ route('images.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                View All Images
            </a>
        </div>

        <script>
            let selectedFiles = [];

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
                    }
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