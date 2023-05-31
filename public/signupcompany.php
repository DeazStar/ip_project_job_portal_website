<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Afrihire Sign Up</title>
    <link rel="icon" href="images/logo.png" type="png">

        <!--fontawsome-->
        <script src="https://kit.fontawesome.com/85dd05858a.js" crossorigin="anonymous"></script>
        <!--end fontawsome-->
    
        <!--google fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Nunito:wght@400;900&family=Roboto&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
        <!--end google fonts-->

    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <header>
        <div class="nav_container">
            <nav>
                <ul class="nav_one">
                    <li><a href="index.html"><img class="logo_img" src="images/logo.png"  alt="Afrihire Logo"></a>
                    </li>
                    <li class="nav_item">
                        <a href="aboutus.html">About Us</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="above_sign">
    <div class="sign_up">
        <div class="sign_par">
            <p class="parr" > Sign Up </p><br> 
            <button class="login_btn">Continue with Google</button>
            <hr>
            <form id="form" action = "../src/controller/signupcontrollerC.php" method = "POST" onsubmit="return validateInputs()">
              <div class="form-container">
                <div class="form_control">
                  <input type="text" name="companyName" required id="f_name" >
                  <label for="">Company Name</label>
                  <div class="error"></div>
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                  <input type="text" name="website" id="l_name" required>
                  <label for="">Website</label>
                  <div class="error"></div>
                </div>
              </div>
              <div class="form-container">
                <div class="form_control">
                  <input type="date" name="foundedDate" id="founded_date" required>
                  <label for="">Founded Date</label>
                  <div class="error"></div>
                </div>
              </div>


              <div class="form-container">
                <div class="form_control">
                
                  <input type="text"  id="email"  name="email" required>
                  <label for="email" >Email</label>
                  <div class="error"></div> 
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                
                  <input type="text"  id="remail"  name="recoveryEmail" required>
                  <label for="remail">Recovery Email</label> 
                  <div class="error"></div>
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                  <input type="password" name="password"  id="password" required>
                  <label for="pass">Password</label>
                  <div class="error"></div>
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                  <input type="password" name="confirm-password" id="password2" required>
                  <label for="repass">Repeat Password</label>
                  <div class="error"></div>
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                  <input type="tel" name="phoneNumber" required id="tel">
                  <label for="">Telephone</label>
                  </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                
                  <select name="country" >
                    <option value="ethiopia">Ethiopia</option>
                  </select>
                  <label for="country">Country</label> 
                  <!-- <div class="error"></div> -->
                </div>
              </div>
              <div class="form-container">
                <div class="form_control">
                
                  <input type="text"  id="address"  name="address" required>
                  <label for="address">Address</label> 
                  <!-- <div class="error"></div> -->
                </div>
              </div>


              <div class="checkbox">
                <input type="checkbox" required name="" id="">
                <p>By creating an account you agree to <a  href="">Terms & Privacy</a>.</p>
              </div> 
                <?php
                  if(isset($_SESSION['error'])){
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                  }
                ?>
                <button class="can_btn">Cancel</button>
              <button type="submit" class="btn">Signup</button>
              <p class="parr1">Already have an account?&nbsp; <a class="log_btn" href="login.php">Log in</a></p> 
            </form>
            </div> 

        </div>
    </div>
<script  src="script/sign_up.js"></script>
</body>
</html>