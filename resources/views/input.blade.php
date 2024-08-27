<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Input</title>
    </head> 

    <body>
        <h1>Enter A value</h1>
        <form action="{{ url('/submit') }}" method="POST">
        @csrf
        <label for ="user_input">Serial Number</label>
        <input type="text" name="user_input" required>
        <button type="submit">Submit</button>
        </form>

    </body>

</html>