<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/log_in.css">
    <!--custom css-->
    <link rel="stylesheet" href="css/login.css">
    <!--end custom css-->

    <!--fontawsome-->
    <script src="https://kit.fontawesome.com/85dd05858a.js" crossorigin="anonymous"></script>
    <!--end fontawsome-->

    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Nunito:wght@900&family=Roboto:wght@700&family=Ubuntu:wght@700&display=swap"
        rel="stylesheet">
    <!--end google fonts-->

    <link rel="icon" href="images/logo.png" type="image/icon type">
    <!--icon -->
    <title>Log in AfriHire</title>
</head>

<body>
    <header>
        <div class="nav_container">
            <nav>
                <ul class="nav_one">
                    <li><a href="index.html"><img class="logo_img" src="images/logo.png" alt="Afrihire Logo"></a>
                    </li>
                    <li class="nav_item">
                        <a href="aboutus.html">About Us</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="above_sign">
        <div class="login">
            <div class="login_parr">
                <p class="parr"> Log in</p>
                <button class="login_btn">Continue with Google</button>
                <hr>

                <form action = "../src/controller/signincontroller.php" method ="POST" id="form" onsubmit="return validate()" name="form">
                    <div class="form-container">
                        <div class="form_control">

                            <input type="text" id="email" name="email" required>
                            <label for="email">Email</label>
                            <div id="email_error"></div>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="form_control">
                            <input type="password" id="password" name="password" required>
                            <label for="pass">Password</label>
                            <div id="pass_error"></div>
                        </div>
                    </div>
                    <div class="rem_me">
                        <input type="checkbox">
                        <p>Remember me</p>
                    </div>
                    <div class="forgot_pass">
                        <a href="#">Forget Password</a>
                    </div>
                    <div class="btn-container">
                        <?php
                            if(isset($_SESSION['error'])){
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            }
                        ?>
                        <button class="can_btn">Cancel</button>
                        <button type ="submit" class="btn">Log in</button>
                    </div>
                    <p class="parr1">Don't have an account?&nbsp;<a class="log_btn" href="choose.html">Sign up</a></p>
                </form>
            </div>
        </div>
    </div>
    <script src="script/log_in.js"></script>
</body>

</html>