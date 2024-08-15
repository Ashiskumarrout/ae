<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "ashis";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and validate input
    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
    $subject = htmlspecialchars(strip_tags(trim($_POST['subject'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO shoping (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // Execute statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    // echo "Invalid request method.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/e6878467af.js" crossorigin="anonymous"></script>
</head>
<body>
    <section id="header">
        <a href="#"><img src="Ecmerse photos/smalllogo.png" alt="" class="logo"></a>
        <div>
            <ul id="navbar">
                <li><a href="index.html">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a class="active" href="contact.html">Contact</a></li>
                <li><a href="cart.html"><i class="fa-solid fa-cart-plus"></i></a></li>
            </ul>
        </div>
    </section>

    <section id="page-header" class="about-header">
        <h2>#let's talk</h2>
        <p>LEAVE A MESSAGE. We love to hear from you!</p>
    </section>

    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2>Visit one of our agency locations or contact us today</h2>
            <h3>Head Office</h3>
            <div>
                <li>
                    <i class="fa-solid fa-map-location-dot"></i>
                    <p>Odisha, Cuttack, near Chandi Temple</p>
                </li>
                <li>
                    <i class="fa-regular fa-clock"></i>
                    <p>Monday to Sunday 9:00am to 6:00pm</p>
                </li>
                <li>
                    <i class="fa-solid fa-phone"></i>
                    <p>+91 7008448569</p>
                </li>
                <li>
                    <i class="fa-regular fa-envelope"></i>
                    <p>email@example.com</p>
                </li>
            </div>
        </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3737.893886406811!2d85.84785887501546!3d20.469551081043566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a190dabde0166cd%3A0x50746dd358f9e541!2sAjay%20Binay%20Institute%20of%20Technology%20(ABIT)!5e0!3m2!1sen!2sin!4v1722322862480!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="form-details">
        <form action="#" method="POST">
            <span>LEAVE A MESSAGE</span>
            <h2>We love to hear from you</h2>
            <input type="text" name="name" placeholder="Your name" required>
            <input type="email" name="email" placeholder="Your E-mail" required>
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" cols="30" rows="10" placeholder="Your message" required></textarea>
            <button class="button1" type="submit">Submit</button>
        </form>

        <div class="people">
            <div>
                <img src="Ecmerse photos/2.png" alt="">
                <p><span>Ashis Kumar Rout</span> Senior Marketing Manager<br>Phone: +91 7008448569<br>Email: asasassjkahsjkah@gmail.com</p>
            </div>
            <div>
                <img src="Ecmerse photos/3.png" alt="">
                <p><span>Ashis Kumar Rout</span> Senior Marketing Manager<br>Phone: +91 7008448569<br>Email: asasassjkahsjkah@gmail.com</p>
            </div>
            <div>
                <img src="Ecmerse photos/2.png" alt="">
                <p><span>Ashis Kumar Rout</span> Senior Marketing Manager<br>Phone: +91 7008448569<br>Email: asasassjkahsjkah@gmail.com</p>
            </div>
        </div>
    </section>

    <section id="newsletter" class="section-p1">
        <div class="newstext">
            <h4>Sign up for newsletter</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your E-mail address">
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <img class="logo1" src="Ecmerse photos/smalllogo.png" alt="Company Logo">
            <h4>Contact</h4>
            <p><strong>Address:</strong> Cuttack, Odisha, near Chandi Temple</p>
            <p><strong>Hours:</strong> 10:00-18:00, Mon-Sat</p>
            <div class="follow">
                <h4>Follow Us</h4>
                <div class="icon">
                    <a href="https://facebook.com/AshisKumarRout" target="_blank" title="Facebook"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://wa.me/7008448569" target="_blank" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="https://instagram.com/ashis5769" target="_blank" title="Instagram"><i class="fa-brands fa-square-instagram"></i></a>
                    <a href="https://github.com/Ashiskumarrout" target="_blank" title="GitHub"><i class="fa-brands fa-github"></i></a>
                </div>
            </div>
        </div>

        <div class="col">
            <h4>About</h4>
            <a href="#">About</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>

        <div class="col install">
            <h4>Install App</h4>
            <p>From App Store or Google Play</p>
            <div class="row">
                <img src="Ecmerse photos/app.jpg" alt="App Store">
                <img src="Ecmerse photos/play.jpg" alt="Google Play">
            </div>
            <p>Secure Payment Options</p>
            <img src="Ecmerse photos/pay.png" alt="Payment Methods">
        </div>

        <div class="copyright">
            <hr>
            <p>&copy; 2024 Ashis. Made with <i class="fa-solid fa-heart"></i> by Ashis. Thank you for visiting!</p>
        </div>
    </footer>

    <script src="e.js"></script>
</body>
</html>
