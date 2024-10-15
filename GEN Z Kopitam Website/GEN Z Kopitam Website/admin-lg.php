<?php
// Include database connection
include("database.php");

// Start session
session_start();

// Initialize variables to store errors or success
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $pin = mysqli_real_escape_string($conn, $_POST['pin']); // Capture the pin input

    // SQL query to get the user with the matching email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Check if the user exists
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password with the hashed password in the database
        if (password_verify($password, $row['password'])) {
            
            // Now check if the entered admin_pin matches the one in the database
            if ($pin === $row['admin_pin']) {
                // Pin is correct, log the user in
                $_SESSION['email'] = $row['email']; // Store the email in SESSION
                // Redirect to admin.php after successful login
                header("Location: admin.php");
                exit();
            } else {
                // Admin PIN is incorrect
                $error = "Invalid Admin PIN!";
            }
        } else {
            // Password is incorrect
            $error = "Invalid email or password!";
        }
    } else {
        // User with this email doesn't exist
        $error = "Invalid email or password!";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="php.css">
    <!--Arrow icon link-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!--Home Button Icon link-->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--SwiperJS CSS Linking-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <title>GEN Z Kopitam</title>
    </head>
<body id="body__index1">
    <!--NavBar section-->
   <nav class="navbar">
<div class="navbar__container">
    

    <!--Navbar On the Side-->
    <ul class="navbar__sidebar">
        
        <li onclick=hideSidebar() class="navbar__itemsidebar"> 
            <a class="navbar__item__text__sidebar" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 -960 960 960" width="35px" fill="black"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a>
        </li>

        <li class="navbar__itemsidebar"> 
            <a class="navbar__item__text__sidebar" href="foodmenu.html"><h2>Food Menu</h2></a>
        </li>

        <li class="navbar__itemsidebar">
            <a class="navbar__item__text__sidebar" href="login.php"><h1>Food Cart</h1></a>
        </li>

        <li class="navbar__itemsidebar">
            <a class="navbar__item__text__sidebar" href="#footer__id"><h1>Contact Us</h1></a>
        </li>

        <li class="navbar__itemsidebar">
            <a class="navbar__item__text__sidebar" href="#footer__id"><h1>Support Us</h1></a>
        </li>

        <li class="navbar__btn__side">
            <a href="signup.php" class="login__button__side">
        Sign Up
            </a>
        </li>
    
    </ul>
    <!--Till here for the side bar-->
    <ul class="navbar__menu1">

        <li class="navbar__homebutton ">
            <a class="homebutton" id="navbar__logo" href="index.html"><h1><i class="fa-solid fa-bowl-food"></i>  GEN Z Kopitam</h1></a>
        </li>

        <li class="navbar__item hideOnMobile"> 
            <a class="navbar__item__text" href="foodmenu.html"><h2>Food Menu</h2></a>
        </li>

        <li class="navbar__item hideOnMobile">
            <a class="navbar__item__text" href="login.php"><h1>Food Cart</h1></a>
        </li>

        <li class="navbar__item hideOnMobile">
            <a id="scroll" class="navbar__item__text" href="#footer__id"><h1>Contact Us</h1></a>
        </li>

        <li class="navbar__item hideOnMobile">
            <a id="link" class="navbar__item__text" href="#footer__id"><h1>Support Us</h1></a>
        </li>

        <li class="navbar__btn hideOnMobile">
            <a href="signup.php" class="login__button">
        Sign Up
            </a>
        </li>

        <li class="navbar__item  menu__button" onclick=showSidebar()><a class="navbar__item__text" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 -960 960 960" width="35px" fill="black"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
        </a>
    </li>

    </ul>
   
    
</div>
   </nav>

    <main class="container-main">
        <form class="form-container"  method="POST">
            <div>
                <h1>Admin Login Form</h1>
            </div>

            <!-- Display error message if login fails -->
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <div class="input-box">
                <input type="email" placeholder="Your Email..." name="email" required>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Your Password..." name="password" required>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Your Admin Pin..." name="pin" required>
            </div>

            <div class="">
                <input type="submit" value="Login Admin" class="submit-btn">
            </div>
        </form>
    </main>
 <!--Footer Section-->
 <div id="footer__id" class="footer__container">
    <div class="footer__links">
        <div class="footer__link--wrapper">
            <div class="footer__link--items">
                <h2>Contact Us</h2>
                No. 01156299869
            </div>
        </div>
        <div class="footer__link--wrapper">
            <div class="footer__link--items">
                <h2>Location</h2>
                123 Jalan Selera Utama,
10400 George Town, Penang, Malaysia
            </div>
            <div class="footer__link--items">
                <h2>Support Us</h2>
                <a href="login.php">Feedback</a>
            </div>
        </div>
    </div>
    <div class="social__media">
        <div class="social__media--wrap">
            <div class="footer__logo">
                <a href="index.html" id="footer__logo"><i class="fa-solid fa-bowl-food">
               </i>&nbsp;GEN Z Kopitam</a>
            </div>
            <p class="website__rights"> GEN Z Kopitam. All rights
                reserved</p>
                <div class="social__icons">
                    <a href="#" class="social__icon--link" 
                    target="_blank">
                      <i class="fab fa-facebook"></i>  
                    </a>
                    <a href="#" class="social__icon--link" 
                    target="_blank">
                        <i class="fab fa-instagram"></i>  
                      </a>
                      <a href="#" class="social__icon--link" 
                      target="_blank">
                        <i class="fab fa-twitter"></i>  
                      </a>
                      <a href="#" class="social__icon--link" 
                      target="_blank">
                        <i class="fab fa-youtube"></i>  
                      </a>
                </div>
        </div>
    </div>
</div>


    <!--For the Side of the navbar-->
   <script>
    function showSidebar(){
        const sidebar = document.querySelector('.navbar__sidebar')
        sidebar.style.display = 'flex'
    }
    function hideSidebar(){
        const sidebar = document.querySelector('.navbar__sidebar')
        sidebar.style.display = 'none'
    }
   </script>
</body>
</html>

