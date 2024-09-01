<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Recruitment Management Services</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Global Styles */
        * {
            padding: 0;
            margin: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: #ffffff;
            scroll-behavior: smooth;
            background-color: #000000;
        }

        /* Header and Navigation */
        header {
            background-color:black;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        header .container {
            padding: 10px;
            margin:15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgb(47, 95, 255);
            box-shadow:rgba(47, 95, 255, 0.507) 0px 0px 20px;
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

        /* Menu Toggle for Mobile */
        .menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
        }

        .menu-toggle .bar {
            display: block;
            width: 25px;
            height: 3px;
            margin: 5px auto;
            transition: all 0.3s ease-in-out;
            background-color: #ffffff;
        }

        /* Hero Section */
        .hero {
            color: #ffffff;
            text-align: center;
            padding: 6rem 0;
            position: relative;
            top: 100px;
            height:50%;
        }

        .hero .informations h1 {
            font-size: 3rem;
            margin: 0 0 1rem;
            animation: fadeInDown 1s ease-out;
            color: #2f5fff;
        }

        .hero .informations p {
            font-size: 1.25rem;
            margin: 0 0 2rem;
            animation: fadeInUp 1s ease-out;
        }


        /* Features Section */
        .features {
            padding: 4rem 0;
            margin:15px;
            margin-top:50px;
            border-radius:10px;
            background: #0d0d0d;
            text-align: center;
        }

        .features h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #2f5fff;
        }

        .feature {
            border: 1px solid rgb(47, 95, 255);
            border-radius: 10px 10px;
            display: inline-block;
            width: 30%;
            margin: 0 1.5%;
            padding: 1rem;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease;
        }

        .feature:hover {
            transform: translateY(-10px);
        }

        .feature i {
            font-size: 3rem;
            color: #0059ff;
        }

        .feature h3 {
            font-size: 1.5rem;
            margin: 1rem 0;
            color: #2f5fff;
        }

        

        /* Contact Section */
        .contact {
            position: relative;
            overflow:hidden;
            padding: 4rem 0;
            background: #0d0d0d;
            height:500px;
            border-radius: 10px 10px;
            margin:15px;
        }
        .contact .contact-us{
            width: 50%;
            left:10;
            position: absolute;
        }
        .contact .contact-us h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            color: #2f5fff;
        }

        .contact .contact-us form {
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-us input,
        .contact-us textarea {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            background-color: #1a1a1a;
            border: 1px solid #2f5fff;
            border-radius: 5px;
            color: #ffffff;
        }

        .contact-us button {
            background: #2f5fff;
            color: #ffffff;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .contact-us button:hover {
            background: #1a46d8;
        }

        .contact .contact-details {
            color: #ffffff;
            position: absolute;
            width:40%;
            top:200px;
            right:0;
            text-align: center;
            margin-top: 2rem;
        }

        .contact .social-media a {
            margin: 0 0.5rem;
            color: #2f5fff;
            font-size: 1.5rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact .social-media a:hover {
            color: #1a46d8;
        }

        .square{
            position: absolute;
            display:flex;
            background: linear-gradient(135deg,#0059ff,rgb(0, 0, 0));
            width:900px;
            height:1000px;
            right:-100px;
            top:-100px;
            transform:rotate(20deg);
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <a href="#" class="logo">Campus Recruit</a>
            <nav>
                <ul>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero" id="hero">
        <div class="informations">
            <h1>Connecting Students with Their Dream Jobs</h1>
            <p>Efficient, streamlined campus recruitment solutions for students and recruiters.</p>
        </div>
        <div class="features">
            <h2>Our Features</h2>
            <div class="feature">
                <i class="icon-job-matching"></i>
                <h3>Job Matching</h3>
                <p>Find the best job matches based on your profile and preferences.</p>
            </div>
            <div class="feature">
                <i class="icon-tracking"></i>
                <h3>Application Tracking</h3>
                <p>Track your application status in real-time.</p>
            </div>
            <div class="feature">
                <i class="icon-interview"></i>
                <h3>Interview Scheduling</h3>
                <p>Schedule interviews with ease and convenience.</p>
            </div>
        </div>
    </section>
    <section class="features" id="features">
    <?php
        include 'connection.php';
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            // SQL query to select all records from the table
            $sql = "SELECT * FROM application";
            $result = $conn->query($sql);
            if ($result === false) {
                echo "Error in SQL query: " . $conn->error . "<br>"; // Debugging statement
            } 
            // Check if there are records
            if ($result->num_rows > 0) {
                // Start the HTML table and add headers
                echo "<table>
                        <tr>
                            <th>ApplicationID</th>
                            <th>UserName</th>
                            <th>JobID</th>
                            <th>ApplicationDate</th>
                            <th>Status</th>
                        </tr>";
                
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["ApplicationID"]. "</td>
                            <td>" . $row["UserName"]. "</td>
                            <td>" . $row["JobID"]. "</td>
                            <td>" . $row["ApplicationDate"]. "</td>
                            <td>" . $row["Status"]. "</td>
                          </tr>";
                }
                // End the HTML table
                echo "</table>";
            } else {
                echo "0 results";
            }
        }
        // Close connection
        $conn->close();
    ?>
    </section>

    <section class="contact" id="contact">
        <div class="square">
        </div>
        <div class="contact-us">
            <h2>Contact Us</h2>
            <form id="contact-form">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit">Send</button>
            </form>
        </div>
        <div class="contact-details">
            <p>Email: info@campusrecruit.com</p>
            <p>Phone: (123) 456-7890</p>
            <p>Address: 123 Main Street, Anytown, USA</p>
            <div class="social-media">
                <a href="#"><i class="icon-facebook"></i></a>
                <a href="#"><i class="icon-twitter"></i></a>
                <a href="#"><i class="icon-linkedin"></i></a>
            </div>
        </div>
    </section>

        <script>
        // Toggle Menu for Mobile View
        const menuToggle = document.querySelector('.menu-toggle');
        const nav = document.querySelector('nav ul');

        menuToggle.addEventListener('click', () => {
            nav.classList.toggle('showing');
        });

        // Form Validation
        document.getElementById('contact-form').addEventListener('submit', function(event) {
            const name = document.querySelector('input[name="name"]').value;
            const email = document.querySelector('input[name="email"]').value;
            const message = document.querySelector('textarea[name="message"]').value;
            if (name === "" || email === "" || message === "") {
                alert("Please fill out all fields.");
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
