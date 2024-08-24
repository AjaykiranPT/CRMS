
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>login</title>
    <style>
    *{
        padding: 0;
        margin: 0;
        font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        box-sizing: border-box;
        color: aliceblue;
    }
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: rgb(0, 0, 0);
    
    }
    h2{
        font-size: 25px;
    }
    .container{
        position: relative;
        width: 750px;
        height: 400px;
        border: 1px solid rgb(47, 95, 255);
        box-shadow:rgba(47, 95, 255, 0.507) 0px 0px 20px;
        border-radius: 10px 10px;
        overflow: hidden;
        min-width: 600px;
    }
    .login-form{
        position:absolute;
        top: 0px;
        width: 50%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding-left: 20px;
        /* display: none; */
       
    }
    .forgot-form{
        width: 60%;
        height: 100%;
        position:absolute;
        top: 0px;
        right: 0;
        margin-right: 30;
        align-items: center;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* display: none; */
    }
    .input-layer{
        height: 60px;
        width:100%;
        position: relative;
        margin-top: 30px;
    }
    .input-layer input{
        width: 100%;
        height: 100%;
        background-color: transparent;
        border: none;
        border-bottom: 2px solid #ffffff;
        outline: none;
        font-size: 20px;
        color: rgb(255, 255, 255);
        transition: 0.6s;
    }
    .input-layer label{
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        font-size: 15px;
        color: white;
        transition: 0.3s;
    
    }
    .input-layer input:focus ~ label,
    .input-layer input:valid ~ label {
        top: -5;
        color: rgb(47, 95, 255);
    }
    .input-layer i{
        position: absolute;
        top:40%;
        right: 0%;
    }
    .input-layer input:focus ~ i,
    .input-layer input:valid ~ i
    .input-layer input:focus{
        color: rgb(47, 95, 255);
    }
    input[type=submit]{
        position:absolute;
        color: rgb(47, 95, 255);
        width: 100%;
        height: 45px;
        border: 1px solid rgb(47, 95, 255);
        background-color:transparent;
        font-weight: 600;
        border-radius: 20px;
        
    }
    input[type=submit]:hover{
        box-shadow: 0px -5px 8px #0059ff inset;
        color: white;
        border: rgb(0, 0, 0);
    }
    .forgot{
        margin-left: 40%;
    }
    .forgotlink{
        text-align: center;
        font-size: 12px;
        background-color: transparent;
        border: none;
    }
    .forgot-form .input-layer{
        height: 30px;
        width:150%;
        position: relative;
        margin-top: 30px;
    }
    
    .forgot-form .input-layer label{
        font-size: 14px;
        transform: translateY(-90%);
    }
    .forgot-form .input-layer input:focus ~ label,
    .forgot-form .input-layer input:valid ~ label {
        top: -10;
        color: rgb(47, 95, 255);
    }
    .information{
        position: absolute;
        top: 0;
        height: 100%;
        width: 50%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        h2{
            font-size: 35px;
        }
    }
    .information.login{
        text-align: right;
        right: 5;
        /* display: none; */
    }
    .information.forgot{
        width: 50%;
        height: 50%;
        top: 80px;
        text-align: left;
        left: -250px;
    
    }
    .changeslide{
        margin-top: 10px;
    }
    .changeslide button{
        background-color: transparent;
        border: transparent;
        color: #0059ff;
    }
    .changeslide .forgot{
        left: -100px;
    }
    .container .slopebox{
        position: absolute;
        height: 100%;
        width: 600px;
        right: -300px;
        background: linear-gradient(240deg,#0059ff,rgb(0, 0, 0));
        transition: 1.2s ease;
        border-radius: 100px;
        transition-delay: 0s;
    }
    .container.active .slopebox{
        right: -700px;
        transform: scale(90%);
        /* transition-delay: 0s; */
        transition-delay: 0.1s; 
    }
    .container .slopebox2{
        position: absolute;
        height: 100%;
        width: 600px;
        left: -700px;
        background: linear-gradient(135deg,#0059ff,rgb(0, 0, 0));
        transition: 1.2s ease;
        border-radius: 100px;
        transform: scale(90%);
    }
    .container.active .slopebox2{ 
        left: -300;
        transform: scale(100%); 
        transition-delay: 0.1s; 
    }   
    
    
    .login-form .animation{
        transform: translateX(0);
        transition: 1.2s ease;
        opacity: 100%;
        transition-delay: calc(.1s * var(--D));
        z-index: 3;
    
    }
    .information.login .animation{
        transform: translateX(0);
        transition: 1.2s ease;
        opacity: 100%;
        transition-delay: calc(.1s * var(--D));
        z-index: 2;
    }
    .container.active .login-form .animation{
        transform: translateX(-200%);
        transition: 1.2s ease;
        opacity: 0%;
        transition-delay: calc(.1s * var(--D));
        z-index: 1;
    }
    .container.active .information.login .animation{
        transform: translateX(200%);
        transition: 1.2s ease;
        opacity: 0%;
        transition-delay: calc(.1s * var(--D));
        z-index: 1;
    }
    
    
    .forgot-form .animation{
        transform: translateX(300%);
        transition: 1.2s ease;
        opacity: 0%;
        transition-delay: calc(.1s * var(--D));
        z-index: 1;
    }
    
    .information.forgot .animation{
        transform: translateX(-300%);
        transition: 1.2s ease;
        opacity: 0%;
        transition-delay: calc(.2s * var(--D));
        z-index: 1;
    }
    .container.active .forgot-form .animation{
        transform: translateX(0);
        transition: 1.2s ease;
        opacity: 100%;
        transition-delay: calc(.2s * var(--D));
        z-index: 2;
    }
    .container.active .information.forgot .animation{
        transform: translateX(0);
        transition: 1.2s ease;
        opacity: 100%;
        transition-delay: calc(.2s * var(--D));
        z-index: 2;
    
    }
    .errordiv{
        height: 40px;
        align-items:center;
        display:flex;
        position: relative;
    }
    .errordiv p{
        color:red;
        position: absolute;
        top:20px
    }
    .errordiv .pos{
        color:green;
        position: absolute;
        top:20px
    }
</style>
</head>
<body>

    <div class="container">

        <div class="slopebox"></div>
        <div class="slopebox2"></div>


        <!-- lOGIN  -->
        <div class="login-form">
            <h2 class="animation" style="--D:1">LOGIN</h2>

            <form action="loginvalidation.php" method="POST" onsubmit='return loginValidation()'>
                
                <div class="input-layer animation" style="--D:2">
                    <input type="text" name="login_email" id="login_email" required>
                    <label for="login_email">EMAIL </label>
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="input-layer animation" style="--D:3">
                    <input type="password" name="login_password" id="login_password" required>
                    <label for="login_password">PASSWORD</label>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="errordiv">
                    <?php
                        if(isset($_GET['error'])){
                            $error_message=htmlspecialchars($_GET['error']);
                            echo "<p>{$error_message}</p>";
                            unset($_GET['error']);
                       } 
                       if(isset($_GET['message'])){
                            echo "<p class='pos'>{$_GET['message']}</p>";
                            unset($_GET['message']);
                        } 
                    ?>
                </div>
                <div class="input-layer animation" style="--D:4">
                    <input type="submit" value="LOGIN" class="login">
                </div>
            </form>
            <div class="forgot animation" style="--D:5">
                    <button class="forgotlink">Forgot password?</button>
                </div>
        </div>


        <!-- INFORMATION IN lOGIN  -->
        <div class="information login">
            <H2 class="animation" style="--D:0">WELCOME<br> BACK!</H2>
            <div class="changeslide signup animation" style="--D:1">
                <label class="animation" style="--D:2">New to our platform? </label>
                <a class="signuplink animation" style="--D:3" href="registration.php">Create your account</a>
            </div>
        </div>


        
       <!-- FORGOT -->
       <div class="forgot-form">
        <h2 class="animation" class="--D:1">FORGOT PASSWORD</h2>
        <form action="forgotValidation.php" method="POST" onsubmit='return forgotValidation()'>
           
            <div class="input-layer animation" class="--D:2">
                <input type="text" name="forgot_email" id="forgot_email" required>
                <label for="forgot_email">EMAIL </label>
            
            </div>
            <div class="input-layer animation" class="--D:3">
                <input type="text" class="forgot_phone" name="forgot_phone" id="forgot_phone" required> 
                <label  for="forgot_phone">Phone number </label>  
            </div>
            <div class="input-layer animation" class="--D:4">
                <input type="password" name="forgot_password" id="forgot_password" required>
                <label for="login-password">NEW PASSWORD</label>
            </div>
            <div class="input-layer animation" class="--D:5">
                <input type="password" name="forgot_cpassword" id="forgot_cpassword" required>
                <label for="forgot_cpassword">CONFIRM PASSWORD</label>
            </div>
    
            <div class="input-layer animation" class="--D:6">
                <input type="submit" value="RESET PASSWORD">
            </div>
        </form>
    </div>


    <!-- INFORMATION IN FORGOT  -->
    <div class="information forgot animation">
        <H2 class="animation">WELCOME<br> BACK!</H2>
        <div class="changeslide forgot animation" >
            <i class="fa-solid fa-arrow-left"></i>
            <button class="loginlink">BACK TO LOGIN</button>
        </div>
    </div>
    </div> 
    
    

    <script>

        function loginValidation(){
            var login_email = document.getElementById("login_email").value;
            var login_password = document.getElementById('login_password').value;

            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (login_email === "") {
                alert("Email is required.");
                return false;
            }
            if (!emailPattern.test(login_email)) {
                alert("Please enter a valid email address.");
                return false;
            }
            if (login_password === "") {
                alert("Password is required.");
                return false;
            }
            
            return true;

        }


        function forgotValidation(){
            var forgot_email = document.getElementById("forgot_email").value;
            var forgot_phone = document.getElementById("forgot_phone").value;
            var forgot_password = document.getElementById("forgot_password").value;
            var forgot_cpassword = document.getElementById('forgot_cpassword').value;
            

            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var phoneNumPattern = /^[0-9]{10}$/;

            if (login_email === "") {
                alert("Email is required.");
                return false;
            }
            if (!emailPattern.test(forgot_email)) {
                alert("Please enter a valid email address.");
                return false;
            }
            if (!phoneNumPattern.test(forgot_phone)) {
                alert("Phone number should be 10 digits long.");
                return false;
            }
            if (forgot_password === "") {
                alert("Password is required.");
                return false;
            }
            if (forgot_cpassword === "") {
                alert("Password is required.");
                return false;
            }
            if (!passwordpattern.test(userpassword)) {
                alert("Password must be at least 8 characters long, including at least one special character and one uppercase letter.");
                 return false;
            }
            if(userpassword !== cpassword){
                alert("Two passwords must be Same");
                return false;
            }
            
            return true;

        }

        const container=document.querySelector('.container');
        const forgotlink=document.querySelector('.forgotlink');
        const loginlink=document.querySelector('.loginlink');
        const loginmessage=document.querySelector('.errordiv');
    
        // FOR SHIFT
        forgotlink.addEventListener('click',()=>{
            container.classList.add('active');
            loginmessage.style.display='none';
        })
        loginlink.addEventListener('click',()=>{
            container.classList.remove('active');
        })
        

    </script>

</body>
</html>