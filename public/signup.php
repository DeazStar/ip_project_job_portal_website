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
            <div class="error <?php echo isset($_SESSION['error']) ? 'show' : ''; ?>">
                <?php
                        if(isset($_SESSION['error'])){
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        }
                    ?>
                </div>
            <form id="form" action = "../src/controller/signupcontroller.php" method = "POST" Onsubmit="return validateInputs()">
              <div class="form-container">
                <div class="form_control">
                  <input type="text" name="firstName" id="f_name" required>
                  <label for="">First Name</label>
                  <div class="error">
                    <?php
                            if(isset($_SESSION['f_name'])){
                                echo $_SESSION['f_name'];
                                unset($_SESSION['f_name']);
                            }
                        ?>
                    </div>
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                  <input type="text" name="lastName" id="l_name" required>
                  <label for="">Last Name</label>
                  <div class="error">
                    <?php
                            if(isset($_SESSION['l_name'])){
                                echo $_SESSION['l_name'];
                                unset($_SESSION['l_name']);
                            }
                        ?>
                    </div>  
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                  <div class="age_in">
                  <input type="date" class="age_in" id="age" name="dateOfBirth" required>
                  <label for="age" class="age_par" >DOB</label>
                  <div class="error">
                    <?php
                            if(isset($_SESSION['age'])){
                                echo $_SESSION['age'];
                                unset($_SESSION['age']);
                            }
                        ?>
                    </div>
              </div>
                </div>
              </div>
			<div class="gen">
			  <label for="gender">Gender:</label>

			  <div class="radio-container">
				<input type="radio" id="male"required name="gender" value="M">
				<label for="male">Male</label>    
				<input type="radio" id="female" name="gender" value = "F">
				<label for="female">Female</label>
        <div class="error">
          <?php
                  if(isset($_SESSION['Gen'])){
                      echo $_SESSION['Gen'];
                      unset($_SESSION['Gen']);
                  }
              ?>
          </div>
			  </div>
			</div>


              <div class="form-container">
                <div class="form_control">
                
                  <input type="text"  id="email"  name="email" required>
                  <label for="email" >Email</label>
                  <div class="error">
                    <?php
                            if(isset($_SESSION['email'])){
                                echo $_SESSION['email'];
                                unset($_SESSION['email']);
                            }
                        ?>
                    </div>
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                
                  <input type="text"  id="remail"  name="recoveryEmail" required>
                  <label for="remail">Recovery Email</label> 
                  <div class="error">
                    <?php
                            if(isset($_SESSION['remail'])){
                                echo $_SESSION['remail'];
                                unset($_SESSION['remail']);
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
                            if(isset($_SESSION['password'])){
                                echo $_SESSION['password'];
                                unset($_SESSION['password']);
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
                            if(isset($_SESSION['repass'])){
                                echo $_SESSION['repass'];
                                unset($_SESSION['repass']);
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
                            if(isset($_SESSION['tel'])){
                                echo $_SESSION['tel'];
                                unset($_SESSION['tel']);
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
                            if(isset($_SESSION['country'])){
                                echo $_SESSION['country'];
                                unset($_SESSION['country']);
                            }
                        ?>
                  </div>
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                
                  <input type="text"  id="Professional_title" required name="professional_title">
                  <label for="Professional_title">Professional Title</label> 
                  <div class="error">
                  <?php
                            if(isset($_SESSION['proff'])){
                                echo $_SESSION['proff'];
                                unset($_SESSION['proff']);
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
                            if(isset($_SESSION['post'])){
                                echo $_SESSION['post'];
                                unset($_SESSION['post']);
                            }
                        ?>
                  </div>
                </div>
              </div>

              <div class="form-container">
                <div class="form_control">
                
                  <input type="text"  id="city" required  name="city">
                  <label for="city">City</label> 
                  <div class="error">
                  <?php
                            if(isset($_SESSION['city'])){
                                echo $_SESSION['city'];
                                unset($_SESSION['city']);
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
                            if(isset($_SESSION['address'])){
                                echo $_SESSION['address'];
                                unset($_SESSION['address']);
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