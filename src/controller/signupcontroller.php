<?php
    
    require_once "../model/PersonalInfo.php";
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
            $_SESSION['f_name'] = 'First name is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($lastName)){
            $_SESSION['l_name'] = 'Last name is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($email)){
            $_SESSION['email'] = 'Email is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($password)){
            $_SESSION['password'] = 'Password is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($confirmPassword)){
            $_SESSION['repass'] = 'Confirm password is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if($password != $confirmPassword){
            $_SESSION['repass'] = 'Passwords do not match.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($country)){
            $_SESSION['country'] = 'Country is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($gender)){
            $_SESSION['Gen'] = 'Gender is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($dateOfBirth)){
            $_SESSION['age'] = 'Date of birth is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($phoneNumber)){
            $_SESSION['tel'] = 'Phone number is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($recoveryEmail)){
            $_SESSION['remail'] = 'Recovery email is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($professionalTitle)){
            $_SESSION['proff'] = 'Professional title is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($postcode)){
            $_SESSION['post'] = 'Postcode is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($city)){
            $_SESSION['city'] = 'City is required.';
            header('Location: ../../public/signup.php');
            exit;
        } else if(empty($address)){
            $_SESSION['address'] = 'Address is required.';
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

        

        $admin->saveUser($_POST);
        unset($_SESSION['pass']);
        

        header('Location: ../../public/login.php');
        exit;
        }
    
    else{
        echo "NOt saved";
    }
?>