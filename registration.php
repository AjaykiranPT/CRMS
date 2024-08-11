<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Company Signup</title>
    <style>
    * {
        padding: 0;
        margin: 0;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        box-sizing: border-box;
    }
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        color: #000000;
        /* background-image: url('img/background-registration.jpg'); */
        background-color: #000000;
        /*background-position: center;
        background-repeat: no-repeat;
        background-size: cover; */
        height: 100%;
    }
    h2 {
        font-size: 25px;
        text-align: center;
        margin: 50px;
        color: #2f5fff;
    }
    .container{
        background-image: linear-gradient(50deg, rgb(19, 19, 19),#000000);
        width: 50%;
        min-width: 500px;
        height: 80%;
        padding-inline: 10%;
        padding-block: 20px;
        margin: 0;
        overflow: auto;
        border: 1px solid rgb(47, 95, 255);
        box-shadow:rgba(47, 95, 255, 0.507) 0px 0px 20px;
        border-radius: 10px 10px;
        backdrop-filter: blur(10px); /* Blur value */
  -webkit-backdrop-filter: blur(10px); /* For Safari */
    }
    .container::-webkit-scrollbar{
        display: none;
    }
        
    .container .form{
        width:60%;
    }
    .input-layer {
        margin-bottom: 45px;
        height: 50px;
        position: relative;
    }
    .input-layer input {
        height: 30px;
        width: 100%;
        border: none;
        outline: none;
        border-bottom: 1px solid #c0c0c0;;
        font-size: 16px;
        padding: 5px 0;
        background: none;
        color: #ffffff;
    } 
    .input-layer label {
        position: absolute;
        top: 20%;
        left: 0px;
        transform: translateY(-50%);
        color: #c0c0c0;
        font-size: 17px;
        pointer-events: none;
        font-weight: 100;
        transition: all 0.3s ease;
        letter-spacing: .5px;
    }
    .input-layer input:focus ~ label,
    .input-layer input:not(:placeholder-shown) ~ label {
        top: -20px;
        left: 0;
        color: #0059ff;
    }
    .input-layer input:focus{
        border-bottom: #0059ff 2px solid;
    }
    
    .input-layer input[type=submit] {
        position: absolute;
        color: rgb(47, 95, 255);
        width: 100%;
        height: 40px;
        border: 1px solid rgb(47, 95, 255);
        background-color: black;
        font-weight: 600;
        border-radius: 5px;
    }
    .input-layer input[type=submit]:hover {

        color: white;
        border-color: #ffffff;
    }
    select{
        height: 40px;
        width: 100%;
        background-color:#00000054;
        outline: none;
        color:#ffffff;
        border-color: #d8d8d85b;
        border-style:inset;
        border-radius: 15px;
        align-items: center;
        font-size: 15px;
    }
    section option{
        color: #0059ff;
    }
    .input-layer .fname{
        width: 48%;
        position: absolute;
        left: 0;
    }
    .input-layer .lname{
        width: 48%;
        position: absolute;
        right: 0;
    }
    .container input[type='radio']{
        position: relative;
        width: 120px;
        height: 40px;
        align-items: center;
        margin: 10px;
        outline: none;
        background: #000000;
    }
    .selection{
        height: 100px;
        justify-content: center;
        display: flex;
    }
    .checkbox{
        height: 40px;
        width: 300px;
        background-color: #0059ff;
        box-shadow: 0px 7px 10px rgb(0, 0, 0) inset;
        border: 1px solid white;
        overflow: hidden;
        border-radius: 20px;

    }
    #checkbox-toggle{
        display: none;
    }
    .checkbox .toggle{
        width: 150px;
        height: 40px;
        background-color: #ffffffb2;
        position: absolute;
        border-radius: 20px;
        left: 0;
        cursor: pointer;
        transition:all .3s ease-in-out;
    }
    
    .checkbox .slide{
        width: 300px;
        height: 40px;
        display: flex;
        align-items:center ;
        justify-content: space-around;
        cursor: pointer;
        position: relative;
    }
    .checkbox .slide .text{
        font-size: 16px;
        font-weight: 700;
        z-index: 100;
        cursor: pointer;

    }
    .check:checked + .checkbox .slide .toggle{
        transform: translateX(148px);
    }
    .errordiv{
        align-items:center;
        display:flex;
        position: relative;
        justify-content: center;
    }
    .errordiv p{
        color:red;
        position: absolute;
        top:-50px;
    }
    </style>
</head>
<body>
    <div class="container">
    
       <h2>Fill the Form Correctly</h2>
    <div class="selection">
        <input type="checkbox" id="checkbox-toggle" class="check">
        <div class="checkbox">
            <label for="checkbox-toggle" class="slide">
                <label for="checkbox-toggle" class="toggle"></label>
                <label for="checkbox-toggle" class="text">COMPANY</label>
                <label for="checkbox-toggle" class="text">STUDENT</label>
            </label>
        </div>
    </div>

       <div class="companyform" id="companyform">
            <form action="companyvalidation.php" method="post" onsubmit="return company_validateForm()">
                
                <div class="input-layer">
                    <input type="text" id="companyname" name="companyname" placeholder=" ">
                    <label for="companyname">Company Name</label>
                </div>
                
                <div class="input-layer">
                    <input type="text" id="contactperson" name="contactperson" placeholder=" ">
                    <label for="contactperson">Contact Person</label>
                </div>
                <div class="input-layer">
                    <input type="text" id="companyemail" name="companyemail" placeholder=" ">
                    <label for="companyemail">Email</label>
                </div>
                <div class="input-layer">
                    <input type="text" id="companyphonenum" name="companyphonenum" placeholder=" ">
                    <label for="companyphonenum">Phone Number</label>
                </div>
                <div class="input-layer">
                    <input type="password" id="password" name="password" placeholder=" ">
                    <label for="password">Password</label>
                </div>
                <div class="input-layer">
                    <input type="password" id="cpassword" name="cpassword" placeholder=" ">
                    <label for="cpassword">Confirm password</label>
                </div>
                <div class="input-layer">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>

        <div class="studentform" id="studentform" style="display: none;">
             <form action="studentValidation.php" method="post" onsubmit="return student_validateForm()">
                <div class="input-layer">
                    <div class="fname">
                        <input type="text" id="studentfname" name="studentfname" placeholder=" ">
                        <label for="studentfname">First name</label>
                    </div>
                    <div class="lname">
                        <input type="text" id="studentlname" name="studentlname" placeholder=" ">
                        <label for="studentlname">Last Name</label>
                    </div>
                    </div>
                 
                <div class="input-layer">
                    <select name="gender" id='gender'>
                        <option value="" selected disabled>SELECT GENDER </option>
                        <option value="male">MALE</option>
                        <option value="female">FEMALE</option>
                        <option value="others">OTHERS</option>
                    </select>
                </div>
                <div class="input-layer">
                    <input type="text" id="studentcity" name="studentcity" placeholder=" ">
                    <label for="studentcity">City</label>
                </div>
                <div class="input-layer">
                    <input type="text" id="course" name="course" placeholder=" ">
                    <label for="course">Course</label>
                </div>
                <div class="input-layer">
                    <input type="text" id="college" name="college" placeholder=" ">
                    <label for="college">College</label>
                </div>
                <div class="input-layer">
                    <input type="number" id="yearofpassing" name="yearofpassing" placeholder=" ">
                    <label for="yearofpassing">Year of passing</label>
                </div>
                <div class="input-layer">
                    <input type="text" id="studentphonenum" name="studentphonenum" placeholder=" ">
                    <label for="studentphonenum">Phone Number</label>
                </div>
                <div class="input-layer">
                    <input type="text" id="studentemail" name="studentemail" placeholder=" ">
                    <label for="studentemail">Email</label>
                </div>
                 <div class="input-layer">
                     <input type="password" id="studentpassword" name="studentpassword" placeholder=" ">
                     <label for="studentpassword">Password</label>
                 </div>
                 
                 <div class="input-layer">
                     <input type="password" id="studentrepassword" name="studentrepassword" placeholder=" ">
                     <label for="studentrepassword">Confirm password</label>
                 </div>
                 <div class="input-layer">
                     <input type="submit" value="Submit">
                 </div>
             </form>
         </div>
    </div>

    <script>
        function company_validateForm() {
            // Get form elements
            var companyName = document.getElementById("companyname").value;
            var contactPerson = document.getElementById("contactperson").value;
            var email = document.getElementById("companyemail").value;
            var phoneNum = document.getElementById("companyphonenum").value;
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("cpassword").value;
            
            // Regular expressions for validation
            var regIdPattern = /^[A-Za-z0-9]{6,}$/;
            var phoneNumPattern = /^[0-9]{10}$/;

            // Validate Company Name
            if (companyName === "") {
                alert("Company Name is required.");
                return false;
            }

            // Validate Contact Person
            if (contactPerson === "") {
                alert("Contact Person is required.");
                return false;
            }

             // Validate Phone Number
             if (!phoneNumPattern.test(phoneNum)) {
                alert("Phone number should be 10 digits long.");
                return false;
            }

            // Validate Email
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

           
            var passwordpattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordpattern.test(password)) {
                alert("Password must be at least 8 characters long, including at least one special character and one uppercase letter.");
                 return false;
            }
            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                
                return false;
            }
            // If all validations pass
            return false;
        }
        function student_validateForm(){
        //Get form Elements
            var fname= document.getElementById("studentfname").value;
            var lname = document.getElementById("studentlname").value;
            var useremail = document.getElementById("studentemail").value;
            var Phone =document.getElementById('studentphonenum').value;
            var course =document.getElementById('course').value;
            var college =document.getElementById('college').value;
            var Year =document.getElementById('yearofpassing').value;
            var gender=document.getElementById('gender').value;
            var City =document.getElementById('studentcity').value;
            var userpassword =document.getElementById('studentpassword').value;
            var cpassword = document.getElementById('studentrepassword').value;
        //validate Name
            if (fname === "") {
                alert("First Name is required.");
                return false;
            }
            if (lname === "") {
                alert("Last Name is required.");
                return false;
            }
            if (gender === "") {
                alert("Gender is required.");
                return false;
            }
            if (City === "") {
                alert("City Name is required.");
                return false;
            }
            if (course === "") {
                alert("Course Name is required.");
                return false;
            }
            if (college === "") {
                alert("College Name is required.");
                return false;
            }
           
            if (Year === "") {
                alert("Year of Passing is required.");
                return false;
            }
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(useremail)) {
                alert("Please enter a valid email address.");
                return false;
            }
            // Validate Phone Number
            var phoneNumPattern = /^[0-9]{10}$/;
            if (!phoneNumPattern.test(Phone)) {
                alert("Phone number should be 10 digits long.");
                return false;
            }
            var passwordpattern = /^(?=.*[A-Z])(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/;
            if (!passwordpattern.test(userpassword)) {
                alert("Password must be at least 8 characters long, including at least one special character and one uppercase letter.");
                 return false;
                 }
            if(userpassword !== cpassword){
                alert("Two passwords must be Same");
                return false;
            }
             // If all validations pass
            return true;
       }
        const toggleCheckbox = document.getElementById('checkbox-toggle');
        const studentContainer = document.getElementById('studentform');
        const registrationContainer = document.getElementById('companyform');

        toggleCheckbox.addEventListener('change', function() {
            if (this.checked) {
                studentContainer.style.display = 'block';
                registrationContainer.style.display = 'none';
            } else {
                studentContainer.style.display = 'none';
                registrationContainer.style.display = 'block';
            }
        });

        // Initial state
        registrationContainer.style.display = 'block';
    </script>
</body>
</html>