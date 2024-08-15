<?php
// Set session cookie parameters
session_set_cookie_params([
    'lifetime' => 86400, // 24 hours
    'path' => '/',
    'domain' => '', // Leave empty for current domain
    'secure' => false, // Set to true if using HTTPS
    'httponly' => true,
    'samesite' => 'Lax', // or 'Strict'
]);

session_start();

// Database credentials
$servername = "localhost";
$username = "root";
$password = "password"; // Update with your MySQL password
$dbname = "ashis"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle registration
if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Handle file upload
    $profile_photo = 'default.png'; // Default profile photo
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $tmp_name = $_FILES['profile_photo']['tmp_name'];
        $name = basename($_FILES['profile_photo']['name']);
        $profile_photo = $upload_dir . $name;
        
        if (!move_uploaded_file($tmp_name, $profile_photo)) {
            $profile_photo = 'default.png'; // Use default if upload fails
        }
    }

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO userss (email, password_hash, username, profile_photo) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssss", $email, $password_hash, $username, $profile_photo);

        if ($stmt->execute()) {
            $message = "Registration successful!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Error preparing statement: " . $conn->error;
    }
}

// Handle login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("SELECT password_hash, username, profile_photo FROM userss WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($password_hash, $username, $profile_photo);
        $stmt->fetch();

        if ($stmt->num_rows > 0) {
            // Check password
            if (password_verify($password, $password_hash)) {
                // Password is correct
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $username;
                $_SESSION['profile_photo'] = $profile_photo;
                header("Location: akas.php?section=welcome");
                exit();
            } else {
                $message = "Invalid email or password.";
            }
        } else {
            $message = "Invalid email or password.";
        }

        $stmt->close();
    } else {
        $message = "Error preparing statement: " . $conn->error;
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: akas.php");
    exit();
}

// Display content based on section
$section = isset($_GET['section']) ? $_GET['section'] : 'login';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <link rel="stylesheet" href="style.css">
    <section id="header">
        <a href="#"><img src="Ecmerse photos/smalllogo.png" alt="" class="logo"></a>
        <div>
            <ul id="navbar">
                <li><a href="index.html">Home</a></li>
                <li><a href="shope.html">Shop</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li  class="active" id="lg-bag"><a href="cart.html">Cart</a></li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                    <li class="user-info">
    <img src="<?php echo htmlspecialchars($_SESSION['profile_photo']); ?>" alt="Profile Photo" class="profile-photo">
    <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
    <a href="akas.php?logout=true" class="logout">Logout</a>
</li>

                <?php else: ?>
                    <li id=""><a class="active" href="akas.php">Login</a></li>
                <?php endif; ?>
                <a href="#" id="close"><i class="fa-solid fa-circle-xmark" style="color: #19191a;"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.html"><i class="fa-solid fa-cart-plus"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>
    <div class="gap"></div>
</head>
<body>
<div class="container">
    <?php if ($section == 'login'): ?>
        <h1>Login</h1>
        <div id="log">
        <form action="akas.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" name="login" value="Login">
            <p style="text-align: center;">Don't have an account? <a id="re" href="akas.php?section=register">Register here</a></p>
        </form>
        </div>
     
        <?php if (isset($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
     
    <?php elseif ($section == 'register'): ?>
        <h1>Register</h1>
       
        <form action="akas.php" method="post" enctype="multipart/form-data">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="profile_photo">Profile Photo:</label>
            <input type="file" id="profile_photo" name="profile_photo">
            <input type="submit" name="register" value="Register">
      
        </form>
       
        <?php if (isset($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <p style="text-align: center;">Already have an account? <a href="akas.php?section=login">Login here</a></p>
    <?php elseif ($section == 'welcome'): ?>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <img src="<?php echo htmlspecialchars($_SESSION['profile_photo']); ?>" alt="Profile Photo" class="profile-photo">
        <p>You are now logged in.</p>
        <a href="akas.php?logout=true" class="logout">Logout</a>
    <?php endif; ?>
</div>

<section id="newsletter" class="section-p1">
    <div class="newstext">
        <h4>Sign up for newsletter</h4>
        <p>Get E-mail updates, your latest shop and <span>special offers</span></p>
    </div>
    <div class="form">
        <input type="text" placeholder="Your E-mail address">
        <button class="normal">Sign up</button>
    </div>
</section>
<section>
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
</section>
</body>
</html>
