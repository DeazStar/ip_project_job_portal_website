<?php
    session_start();
    require_once "../model/person.php";
    require_once "../model/admin.php";

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];
        $country = $_POST['country'];
        $gender = $_POST['gender'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $phoneNumber = $_POST['phoneNumber'];
        $recoveryEmail = $_POST['recoveryEmail'];
        $professionalTitle = $_POST['professional_title'];
        $postcode = $_POST['postcode'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        
        // Validate user input
        if(empty($firstName)){ 
            $_SESSION['error'] = 'First name is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($lastName)){
            $_SESSION['error'] = 'Last name is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($email)){
            $_SESSION['error'] = 'Email is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($password)){
            $_SESSION['error'] = 'Password is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($confirmPassword)){
            $_SESSION['error'] = 'Confirm password is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if($password != $confirmPassword){
            $_SESSION['error'] = 'Passwords do not match.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($country)){
            $_SESSION['error'] = 'Country is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($gender)){
            $_SESSION['error'] = 'Gender is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($dateOfBirth)){
            $_SESSION['error'] = 'Date of birth is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($phoneNumber)){
            $_SESSION['error'] = 'Phone number is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($recoveryEmail)){
            $_SESSION['error'] = 'Recovery email is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($professionalTitle)){
            $_SESSION['error'] = 'Professional title is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($postcode)){
            $_SESSION['error'] = 'Postcode is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($city)){
            $_SESSION['error'] = 'City is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($address)){
            $_SESSION['error'] = 'Address is required.';
            header('Location: ../../public/signup.php');
            exit;
        } 
        if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword) || 
            empty($country) || empty($gender)|| empty($dateOfBirth)|| empty($phoneNumber)|| empty($recoveryEmail)||
            empty($professionalTitle) || empty($postcode)|| empty($city)|| empty($address)){
            
            $_SESSION['error'] = 'All fields are required.';
            header('Location: ../../public/signup.php');
            exit;
            }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Invalid email format.';
            header('Location: ../../public/signup.php');
            exit;
        }if (!filter_var($recoveryEmail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Invalid recovery email format.';
            header('Location: ../../public/signup.php');
            exit;
        }
        
        // Check if password is at least 8 characters long
        if (strlen($password) < 8) {
            $_SESSION['error'] = 'Password must be at least 8 characters long.';
            header('Location: ../../public/signup.php');
            exit;
        }
        
        if ($password !== $confirmPassword) {
            $_SESSION['error'] = 'Passwords do not match.';
            header('Location: ../../public/signup.php');
            exit;
        }
        $admin = new Admin();
        if ($admin->emailExists($email)) {
            $_SESSION['error'] = 'An account with that email already exists.';
            header('Location: ../../public/signup.php');
            exit;
        }    
      
        $user = new User($firstName, $lastName , $email, md5($password), $country,
                         $gender ,$dateOfBirth , $phoneNumber ,$recoveryEmail ,
                        $professionalTitle , $postcode , $city , $address
                        );


        $admin->saveUser($user);
        echo"<h1>data is saved successfully</h1>";

        

        header('Location: ../../public/login.php');
        exit;
        }
    
    else{
        echo "NOt saved";
    }
?>