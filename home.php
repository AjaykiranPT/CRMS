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
            background: #1a1a1a;
            color: #ffffff;
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 1.5rem;
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
            background: linear-gradient(50deg, rgb(19, 19, 19), #000000);
            color: #ffffff;
            text-align: center;
            padding: 6rem 0;
            position: relative;
            top: 50px;
        }

        .hero h1 {
            font-size: 3rem;
            margin: 0 0 1rem;
            animation: fadeInDown 1s ease-out;
            color: #2f5fff;
        }

        .hero p {
            font-size: 1.25rem;
            margin: 0 0 2rem;
            animation: fadeInUp 1s ease-out;
        }

        .hero .btn {
            background: #2f5fff;
            color: #ffffff;
            padding: 0.75rem 2rem;
            text-decoration: none;
            border-radius: 5px;
            animation: fadeInUp 1.5s ease-out;
            transition: background-color 0.3s;
            margin: 0.5rem;
        }

        .hero .btn:hover {
            background-color: #1a46d8;
        }

        /* Login Button */
        .hero .login-btn {
            background: #ff5722;
            color: #ffffff;
        }

        .hero .login-btn:hover {
            background: #e64a19;
        }

        /* Keyframe Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Features Section */
        .features {
            padding: 4rem 0;
            background: #0d0d0d;
            text-align: center;
        }

        .features h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #2f5fff;
        }

        .feature {
            display: inline-block;
            width: 30%;
            margin: 0 1.5%;
            background: #1a1a1a;
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

        /* How It Works Section */
        .how-it-works {
            padding: 4rem 0;
            background: #0d0d0d;
        }

        .how-it-works h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            color: #2f5fff;
        }

        .how-it-works ol {
            list-style: none;
            padding: 0;
        }

        .how-it-works ol li {
            background: #0059ff;
            color: #ffffff;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .how-it-works ol li:hover {
            background: #1a46d8;
        }

        /* News and Updates Section */
        .news-updates {
            padding: 4rem 0;
            background: #0d0d0d;
        }

        .news-updates h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            color: #2f5fff;
        }

        .news-updates article {
            background: #1a1a1a;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease;
        }

        .news-updates article:hover {
            transform: translateY(-10px);
        }

        /* Contact Section */
        .contact {
            padding: 4rem 0;
            background: #0d0d0d;
        }

        .contact h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            color: #2f5fff;
        }

        .contact form {
            max-width: 600px;
            margin: 0 auto;
        }

        .contact input,
        .contact textarea {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            background-color: #1a1a1a;
            border: 1px solid #2f5fff;
            border-radius: 5px;
            color: #ffffff;
        }

        .contact button {
            background: #2f5fff;
            color: #ffffff;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .contact button:hover {
            background: #1a46d8;
        }

        .contact .contact-details {
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

        /* Footer */
        footer {
            background: #1a1a1a;
            color: #ffffff;
            padding: 2rem 0;
            text-align: center;
        }

        footer ul {
            list-style: none;
            padding: 0;
        }

        footer ul li {
            display: inline;
            margin-right: 1rem;
        }

        footer ul li a {
            color: #ffffff;
            text-decoration: none;
        }

        footer .newsletter {
            max-width: 400px;
            margin: 2rem auto 0;
            text-align: center;
        }

        footer .newsletter input {
            width: 70%;
            padding: 0.5rem;
            border: none;
            border-radius: 5px;
            margin-right: 0.5rem;
            background-color: #1a1a1a;
            color: #ffffff;
        }

        footer .newsletter button {
            background: #2f5fff;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        footer .newsletter button:hover {
            background: #1a46d8;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <a href="#" class="logo">Campus Recruit</a>
            <nav>
                <div class="menu-toggle">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                <ul>
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#how-it-works">How It Works</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero" id="hero">
        <div class="container">
            <h1>Connecting Students with Their Dream Jobs</h1>
            <p>Efficient, streamlined campus recruitment solutions for students and recruiters.</p>
            <a href="#contact" class="btn">Get Started</a>
            <a href="login.html" class="btn login-btn">Login</a>
        </div>
    </section>

    <section class="features" id="features">
        <div class="container">
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

    <section class="how-it-works" id="how-it-works">
        <div class="container">
            <h2>How It Works</h2>
            <ol>
                <li>Register and create your profile</li>
                <li>Browse job postings</li>
                <li>Apply for positions</li>
                <li>Get matched and schedule interviews</li>
                <li>Receive job offers</li>
            </ol>
        </div>
    </section>

    <section class="news-updates" id="news-updates">
        <div class="container">
            <h2>News and Updates</h2>
            <article>
                <h3>Latest Recruitment Trends</h3>
                <p>Stay updated with the latest trends in campus recruitment.</p>
            </article>
            <article>
                <h3>Upcoming Events</h3>
                <p>Join our upcoming recruitment drives and webinars.</p>
            </article>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <form id="contact-form">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit">Send</button>
            </form>
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
