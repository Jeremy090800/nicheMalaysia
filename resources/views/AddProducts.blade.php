<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Add New Product</title>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  </head>

  <body class="bg-gray-100">
      <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Create New Product</h1>

            <div class="mb-6">
                <a href="{{ url('/') }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    &larr; Back
                </a>
            </div>

          
          <form method="POST" action="{{ url('/products/handle_store_products_function') }}" class="mb-8">
              @csrf
              <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                  <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="serial_id">
                          Serial ID:
                      </label>
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="serial_id" name="serial_id" required>
                  </div>
                  
                  <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="ferrule">
                          Ferrule (mm):
                      </label>
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="ferrule" name="ferrule" required>
                  </div>
                  
                  <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="length">
                          Length (cm):
                      </label>
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="length" name="length" required>
                  </div>
                  
                  <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="weight">
                          Weight (oz):
                      </label>
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="weight" name="weight" required>
                  </div>
                  
                  <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="butt">
                          Butt Length (cm):
                      </label>
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="butt" name="butt" required>
                  </div>
                  
                  <div class="mb-6">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="balancing">
                          Balancing Point (cm):
                      </label>
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="balancing" name="balancing" required>
                  </div>
                  
                  <div class="flex items-center justify-center">
                      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                          Create Product
                      </button>
                  </div>
              </div>
          </form>
      </div>
  </body>
</html>