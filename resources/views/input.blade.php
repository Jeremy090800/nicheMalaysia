<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Input</title>
        <script>
            function validateInput() {
                const userInput = document.forms["inputForm"]["user_input"].value;
                const errorMessageElement = document.getElementById("error-message");

                if (userInput === "") {
                    errorMessageElement.innerText = "The input cannot be empty. Please enter a number.";
                    return false;
                } else if (isNaN(userInput)) {
                    errorMessageElement.innerText = "The input can only be a number. Please enter a valid number.";
                    return false;
                }

                // Clear error message if input is valid
                errorMessageElement.innerText = "";
                return true;
            }
        </script>
    </head> 

    <body>
        <h1>Enter A Value</h1>
        <form name="inputForm" action="{{ url('/submit') }}" method="POST" onsubmit="return validateInput()">
            @csrf
            <label for="user_input">Serial Number</label>
            <input type="text" name="user_input">
            <button type="submit">Submit</button>
        </form>
        <p id="error-message" style="color:red;"></p>
    </body>
</html>
