<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Result Page</title>
    </head>

    <body>
        <h1>Result</h1>
        <p>You entered: {{ session('user_input') }}</p>
        <a href="{{ url('/') }}">Go Back</a>
    </body>




</html>