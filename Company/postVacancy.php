<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Posting Form</title>
    <style>
        body {
            padding: 0;
            margin: 0;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            box-sizing: border-box;
            background-color: #222;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        header {
            background-color:transparent;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        header .header {
            padding: 10px;
            margin:15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgb(47, 95, 255);
            border-radius: 10px 10px;
            background-color:black;
        }

        header .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #2f5fff;
            text-decoration: none;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-right: 1rem;
        }

        nav ul li a {
            color: #ffffff;
            text-decoration: none;
            padding: 0.5rem 1rem;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            background: #0059ff;
            color: #ffffff;
            border-radius: 5px;
        }

        .container {
            background-image: linear-gradient(50deg, rgb(19, 19, 19),#000000);
            width: 50%;
            min-width: 500px;
            height: 60%;
            padding:50px;
            margin-top:100px;
            overflow: auto;
            border: 1px solid rgb(47, 95, 255);
            border-radius: 10px 10px;
        }
        .container::-webkit-scrollbar{
            display: none;
    `   }
        .container h2 {
            text-align: center;
            color: lightblue;
            display:block;
        }
        .input-layer {
            margin-bottom: 45px;
            position: relative;
            height:30px;
        }

        .input-layer label {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            color: #c0c0c0;
            font-size: 17px;
            pointer-events: none;
            font-weight: 100;
            transition: all 0.3s ease;
            letter-spacing: .5px;
        }

        .input-layer input[type='text'],
        .input-layer textarea {
            height: 30px;
            width: 100%;
            border: none;
            outline: none;
            border-bottom: 1px solid #c0c0c0;
            font-size: 16px;
            padding: 5px 0;
            background: none;
            color: #ffffff;
        }
        .input-layer input[type="text"]:focus ~ label,
        .input-layer input[type="text"]:not(:placeholder-shown) ~ label,
        .input-layer textarea:focus ~ label,
        .input-layer textarea:not(:placeholder-shown) ~ label {
            top: -20px;
            left: 0;
            color: #0059ff;
            font-size: 14px;
        }
        
        .input-layer input:focus,
        .input-layer textarea:focus {
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
        .selection{
            height: 100px;
            justify-content: center;
            display: flex;
        }
        input[type="date"] {
            padding: 10px; 
            font-size: 16px; 
            border: 2px solid #ccc;
            border-radius: 5px;
            background-image: linear-gradient(50deg, rgb(19, 19, 19),#000000);
            color: #333; 
            width: 100%;
            box-sizing: border-box; 
        }


        input[type="date"]:focus {
            border-color: #007bff;
            outline: none; 
            background-color: #fff;
        }

        .input-layer .dinput{
            position: absolute;
            width: 80%;
            right:0;
        }
        .input-layer .dlabel{
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            color: #c0c0c0;
            font-size: 17px;
            pointer-events: none;
            font-weight: 100;
            transition: all 0.3s ease;
            letter-spacing: .5px;
            display:flex;
            align-items:center;
        }

    </style>
</head>
<body>
    <header>
        <div class="header">
            <nav>
                <ul>
                    <li><a href="login.php">Home</a></li>
                    <li><a href="dashboard.php">Dasboard</a></li>
                    <li><a href="register.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Post a Job Vacancy</h2>
        <form method="post" onsubmit="return company_validateForm()">
        
            <div class="input-layer">
                <input type="text" id="jobtitle" name="jobtitle" placeholder=" ">
                <label for="jobtitle">Job title</label>
            </div>
            
            <div class="input-layer">
                <textarea id="description" name="description" placeholder=" "></textarea>
                <label for="description">Job Description:</label>
            </div>
            <div class="input-layer">
                <input type="text" id="location" name="location" placeholder=" " >
                <label for="location">Location</label>
            </div>
            <div class="input-layer">
                <input type="date" id="deadline" class="dinput" name="deadline">
                <label for="deadline" class="dlabel">Deadline</label>
            </div>
            <div class="input-layer">
                <select name="course" id="course" class="course">
                    <option value="" selected disabled>Select Course</option>
                    <option value="Bachelor of Computer Applications">Bachelor of Computer Applications</option>
                    <option value="Bachelor of Commerce">Bachelor of Commerce</option>
                    <option value="Bachelor of Business Administration">Bachelor of Business Administration</option>
                    <option value="Bachelor of Social Work">Bachelor of Social Work</option>
                    <option value="B.Sc Mathematics">B.Sc Mathematics</option>
                    <option value="B.Sc Physics">B.Sc Physics</option>
                    <option value="B.Sc Chemistry">B.Sc Chemistry</option>
                    <option value="BA History">BA History</option>
                </select>
            </div>
            <div class="input-layer">
                <select name="jobtype" id="jobtype" class="jobtype">
                    <option value="" selected disabled>Job type</option>
                    <option value="fulltime">Full time</option>
                    <option value="parttime">Part time</option>
                </select>
            </div>
            <div class="input-layer">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>  
    <script>
        function company_validateForm() {
            var jobtitle = document.getElementById('jobtitle').value;
            var description = document.getElementById('description').value;
            var location = document.getElementById('location').value;
            var deadline = document.getElementById('deadline').value;
            var course = document.getElementById('course').value;
            var jobtype = document.getElementById('jobtype').value;
            
            // Validate Job Title
            if (jobtitle.length < 3) {
                alert('Job title must be at least 3 characters long.');
                return false;
            }
            
            // Validate Description
            if (description.length < 10) {
                alert('Job description must be at least 10 characters long.');
                return false;
            }
            
            // Validate Location
            if (location.length < 3) {
                alert('Location must be at least 3 characters long.');
                return false;
            }
            
            // Validate Deadline
            if (deadline === '') {
                alert('Please select a deadline.');
                return false;
            }
            
            // Validate Course
            if (course === '') {
                alert('Please select a course.');
                return false;
            }
            
            // Validate Job Type
            if (jobtype === '') {
                alert('Please select a job type.');
                return false;
            }
            
            return true; // Allow form submission
        }
    </script>
    <?php
    include 'connection.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Set parameters and execute
        $companyid=29;
        $jobtitle = $_POST['jobtitle'];
        $jobdescription = $_POST['description'];
        $joblocation = $_POST['location'];
        $deadline = $_POST['deadline'];
        $course = $_POST['course'];
        $jobtype = $_POST['jobtype'];
    

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO job_posting (company_id,jobtitle,job_description,job_location,deadline,course,jobtype) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $companyid, $jobtitle, $jobdescription, $joblocation, $deadline,$course,$jobtype);

        if ($stmt->execute()) {
            echo "<script>alert('Job vacancy has been successfully posted!');</script>";
        } else {
            echo "<script>alert('Error for posting the job');</script>";
        }

        // Close connection
        $stmt->close();
        $conn->close();
    }
    ?>
    </body>
</html>