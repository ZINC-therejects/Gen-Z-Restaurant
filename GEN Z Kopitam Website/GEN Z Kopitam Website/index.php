<?php
include("database.php");

session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];  // Retrieve the email from the session

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tel']) && isset($_POST['name'])) {
        $tel = $_POST['tel'];         // Get the updated phone number
        $new_name = $_POST['name'];

        // Sanitize inputs to prevent SQL injection
        $tel = mysqli_real_escape_string($conn, $tel);
        $new_name = mysqli_real_escape_string($conn, $new_name);

        // Update the user's email and phone number in the database
        $update_sql = "UPDATE users SET name = '$new_name', tel = '$tel' WHERE email = '$email'";
        if (mysqli_query($conn, $update_sql)) {
            echo "Information updated successfully!";
        } else {
            echo "Error updating information: " . mysqli_error($conn);
        }
    }

    // Retrieve the user's updated data
    $sql = "SELECT * FROM users WHERE email= '$email'";
    $result = mysqli_query($conn, $sql);
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
            <a class="navbar__item__text__sidebar" href="foodmenu2.html"><h2>Food Menu</h2></a>
        </li>

        <li class="navbar__itemsidebar">
            <a class="navbar__item__text__sidebar" href="cart.html"><h1>Food Cart</h1></a>
        </li>

        <li class="navbar__itemsidebar">
            <a class="navbar__item__text__sidebar" href="#footer__id"><h1>Contact Us</h1></a>
        </li>

        <li class="navbar__itemsidebar">
            <a class="navbar__item__text__sidebar" href="#footer__id"><h1>Support Us</h1></a>
        </li>

        <li class="navbar__btn__side">
            <a href="index.html" class="login__button__side">
        Log out
            </a>
        </li>
    
    </ul>
    <!--Till here for the side bar-->
    <ul class="navbar__menu1">

        <li class="navbar__homebutton ">
            <a class="homebutton" id="navbar__logo" href="index2.html"><h1><i class="fa-solid fa-bowl-food"></i>  GEN Z Kopitam</h1></a>
        </li>

        <li class="navbar__item hideOnMobile"> 
            <a class="navbar__item__text" href="foodmenu2.html"><h2>Food Menu</h2></a>
        </li>

        <li class="navbar__item hideOnMobile">
            <a class="navbar__item__text" href="cart.html"><h1>Food Cart</h1></a>
        </li>

        <li class="navbar__item hideOnMobile">
            <a id="scroll" class="navbar__item__text" href="#footer__id"><h1>Contact Us</h1></a>
        </li>

        <li class="navbar__item hideOnMobile">
            <a id="link" class="navbar__item__text" href="#footer__id"><h1>Support Us</h1></a>
        </li>

        <li class="navbar__btn hideOnMobile">
            <a href="index.html" class="login__button">
        Log Out
            </a>
        </li>

        <li class="navbar__item  menu__button" onclick=showSidebar()><a class="navbar__item__text" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 -960 960 960" width="35px" fill="black"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
        </a>
    </li>

    </ul>
   
    
</div>
   </nav>

    <?php if (isset($result) && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    ?>
    <form class="php-index-form-container" method="POST">
        <h1>Your Information</h1>
        <table class="php-index-table-container" border="">
           
            <tr>
                
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
            </tr>
            <tr>
            <td><input type="text" name="name" value="<?php echo $row["name"]; ?>"></td>
            <td><?php echo $row["email"]; ?></td>
                <td><input type="text" name="tel" value="<?php echo $row["tel"]; ?>"></td>
              <td>  <input type="submit" value="Update Information"></td>
            </tr>
            
        </table>
        
    </form>
    <?php } else { ?>
        <h3>No User Found</h3>
    <?php } ?>

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

<?php
// Close the database connection
mysqli_close($conn);
?>
