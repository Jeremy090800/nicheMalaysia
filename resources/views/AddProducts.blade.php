<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Create New Product</title>
  </head>
  
  <body>
    <h1>Create New Product</h1>
    
    <form method="POST" action="{{ url('/products') }}">
        @csrf
      <label for="serial_id">Serial ID:</label>
      <input type="text" id="serial_id" name="serial_id" required>
      <br>
      
      <label for="ferrule">Ferrule (mm):</label>
      <input type="number" step="0.1" id="ferrule" name="ferrule" required>
      <br>
      
      <label for="length">Length (cm):</label>
      <input type="number" step="0.1" id="length" name="length" required>
      <br>
      
      <label for="weight">Weight (oz):</label>
      <input type="number" step="0.1" id="weight" name="weight" required>
      <br>
      
      <label for="butt">Butt Lengt (cm):</label>
      <input type="text" step="0.1" id="butt" name="butt" required>
      <br>
      
      <label for="balancing">Balancing Point (cm):</label>
      <input type="text" step="0.1" id="balancing" name="balancing" required>
      <br>
      
      <button type="submit">Create Product</button>
       
    </form>
  </body>
      
</html>
