<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function validateForm() {
            var fname = document.forms["registerForm"]["fname"].value;
            var lname = document.forms["registerForm"]["lname"].value;
            var email = document.forms["registerForm"]["mail"].value;
            var phonenum = document.forms["registerForm"]["phonenum"].value;

            if (fname == "") {
                alert("First Name must be filled out");
                return false;
            }

            if (lname == "") {
                alert("Last Name must be filled out");
                return false;
            }

            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Invalid email format");
                return false;
            }

            var phonePattern = /^[0-9]{10}$/;
            if (!phonePattern.test(phonenum)) {
                alert("Phone number must be 10 digits");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Fill The Form Correctly</h2>
        <form name="registerForm" action="regValidation.php" method="POST" onsubmit="return validateForm()">
            <table>
                <div class="div">
                    <tr>
                        <td><label for="fname">FIRST NAME</label></td>
                        <td><input type="text" name="fname" id="fname"></td>
                    </tr>
                </div>
                <div class="inputlayer">
                    <tr>
                        <td><label for="lname">LAST NAME</label></td>
                        <td><input type="text" name="lname" id="lname"></td>
                    </tr>
                </div>
                <div class="inputlayer">
                    <tr>
                        <td><label for="mail">EMAIL</label></td>
                        <td><input type="email" name="mail" id="mail"></td>
                    </tr>      
                </div>
                <div class="inputlayer">
                    <tr>
                        <td><label for="phonenum">MOBILE NUMBER</label></td>
                        <td><input type="text" name="phonenum" id="phonenum"></td>
                    </tr>           
                </div>
                <div class="inputlayer">
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Submit"></td>
                    </tr>
                </div>
            </table>
        </form>
    </div>
</body>
</html>
