<?php
  session_start();
  if(!isset($_SESSION['pass'])){
    header('Location:choose.php');
    exit;
  }
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
            <?php
                  if(isset($_SESSION['error'])){
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                  }
                ?>
              <div class="form-container">
                <div class="form_control">
                  <input type="text" name="companyName" required id="f_name" >
                  <label for="">Company Name</label>
                  <div class="error">
                  <?php
                  if(isset($_SESSION['c_name'])){
                    echo $_SESSION['c_name'];
                    unset($_SESSION['c_name']);
                  }
                ?></div>
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                  <input type="text" name="website" id="l_name" required>
                  <label for="">Website</label>
                  <div class="error">
                  <?php
                  if(isset($_SESSION['website'])){
                    echo $_SESSION['website'];
                    unset($_SESSION['website']);
                  }
                ?></div>
                </div>
              </div>
              <div class="form-container">
                <div class="form_control">
                  <div class="age_in">
                  <input type="date" class="age_in" name="foundedDate" id="founded_date" required>
                  <label for="age" class="age_par">Founded Date</label>
                  <div class="error">
                  <?php
                  if(isset($_SESSION['FOD'])){
                    echo $_SESSION['FOD'];
                    unset($_SESSION['FOD']);
                  }
                ?>
                  </div>
                  </div>
                </div>
              </div>


              <div class="form-container">
                <div class="form_control">
                
                  <input type="text"  id="email"  name="email" required>
                  <label for="email" >Email</label>
                  <div class="error">
                  <?php
                  if(isset($_SESSION['EMAIL'])){
                    echo $_SESSION['EMAIL'];
                    unset($_SESSION['EMAIL']);
                  }
                ?></div> 
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                
                  <input type="text"  id="remail"  name="recoveryEmail" required>
                  <label for="remail">Recovery Email</label> 
                  <div class="error">
                  <?php
                  if(isset($_SESSION['REMAIL'])){
                    echo $_SESSION['REMAIL'];
                    unset($_SESSION['REMAIL']);
                  }
                ?>
                  </div>
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                  <input type="password" name="password"  id="password" required>
                  <label for="pass">Password</label>
                  <div class="error">
                  <?php
                  if(isset($_SESSION['Password'])){
                    echo $_SESSION['Password'];
                    unset($_SESSION['Password']);
                  }
                ?>
                  </div>
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                  <input type="password" name="confirm-password" id="password2" required>
                  <label for="repass">Repeat Password</label>
                  <div class="error">
                  <?php
                  if(isset($_SESSION['rePass'])){
                    echo $_SESSION['rePass'];
                    unset($_SESSION['rePass']);
                  }
                ?>
                  </div>
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                  <input type="tel" name="phoneNumber" required id="tel">
                  <label for="">Telephone</label>
                  <div class="error">
                  <?php
                  if(isset($_SESSION['tele'])){
                    echo $_SESSION['tele'];
                    unset($_SESSION['tele']);
                  }
                ?>
                  </div>
                  </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                
                  <select name="country" >
                    <option value="ethiopia">Ethiopia</option>
                  </select>
                  <label for="country">Country</label> 
                  <div class="error">
                    <?php
                  if(isset($_SESSION['Countyr'])){
                    echo $_SESSION['Country'];
                    unset($_SESSION['Country']);
                  }
                ?>
                </div>
                </div>
              </div>
              <div class="form-container">
                <div class="form_control">
                
                  <input type="text"  id="address"  name="address" required>
                  <label for="address">Address</label> 
                  <div class="error">
                  <?php
                  if(isset($_SESSION['Address'])){
                    echo $_SESSION['Address'];
                    unset($_SESSION['Address']);
                  }
                ?>
                  </div>
                </div>
              </div>
              
              <div class="form-container">
                <div class="form_control">
                
                  <input type="text" reqired id="postcode" required name="postcode">
                  <label for="postcode">Postal Code</label> 
                  <div class="error">
                  <?php
                  if(isset($_SESSION['postal'])){
                    echo $_SESSION['postal'];
                    unset($_SESSION['postal']);
                  }
                ?>
                  </div>
                </div>
              </div>

              <div class="checkbox">
                <input type="checkbox" required name="" id="">
                <p>By creating an account you agree to <a  href="">Terms & Privacy</a>.</p>
              </div> 
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