<?php
    require_once "../model/company.php";
    require_once "../model/admin.php";

    session_start();
 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $companyName = $_POST['companyName'];
        $website = $_POST['website'];
        $foundedDate = $_POST['foundedDate'];
        $email = $_POST['email'];
        $recoveryEmail = $_POST['recoveryEmail'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];
        $country = $_POST['country'];
        $phoneNumber = $_POST['phoneNumber'];
        $address = $_POST['address'];
        if(empty($companyName)){ 
            $_SESSION['error'] = 'Company name is required.';
            header('Location: ../../public/signupcompany.php');
            exit;
        } else if(empty($website)){
            $_SESSION['error'] = 'Website is required.';
            header('Location: ../../public/signupcompany.php');
            exit;
        } else if(empty($foundedDate)){
            $_SESSION['error'] = 'Founded date is required.';
            header('Location: ../../public/signupcompany.php');
            exit;
        } else if(empty($email)){
            $_SESSION['error'] = 'Email is required.';
            header('Location: ../../public/signupcompany.php');
            exit;
        } else if(empty($recoveryEmail)){
            $_SESSION['error'] = 'Recovery email is required.';
            header('Location: ../../public/signupcompany.php');
            exit;
        } else if(empty($password)){
            $_SESSION['error'] = 'Password is required.';
            header('Location: ../../public/signupcompany.php');
            exit;
        } else if(empty($confirmPassword)){
            $_SESSION['error'] = 'Confirm password is required.';
            header('Location: ../../public/signupcompany.php');
            exit;
        } else if($password != $confirmPassword){
            $_SESSION['error'] = 'Passwords do not match.';
            header('Location: ../../public/signupcompany.php');
            exit;
        } else if(empty($country)){
            $_SESSION['error'] = 'Country is required.';
            header('Location: ../../public/signupcompany.php');
            exit;
        } else if(empty($phoneNumber)){
            $_SESSION['error'] = 'Phone number is required.';
            header('Location: ../../public/signupcompany.php');
            exit;
        } else if(empty($address)){
            $_SESSION['error'] = 'Address is required.';
            header('Location: ../../public/signupcompany.php');
            exit;
        } 
        // Validate user input
        if (
            empty($companyName) || empty($website) || empty($foundedDate) || empty($email) || 
            empty($recoveryEmail) || empty($password) || empty($confirmPassword) || 
            empty($country) || empty($phoneNumber)|| empty($address)
            ){
            
            $_SESSION['error'] = 'All fields are required.';
            header('Location: ../../public/signupcompany.php');
            exit;
            }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Invalid email format.';
            header('Location: ../../public/signupcompany.php');
            exit;
        }
        if (!filter_var($recoveryEmail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Invalid recovery email format.';
            header('Location: ../../public/signupcompany.php');
            exit;
        }
        if (!filter_var($website, FILTER_VALIDATE_URL)) {
            $_SESSION['error'] = 'Invalid URL format for the website';
            header('Location: ../../public/signupcompany.php');
            exit;
        }

        // Check if password is at least 8 characters long
        if (strlen($password) < 8) {
            $_SESSION['error'] = 'Password must be at least 8 characters long.';
            header('Location: ../../public/signupcompany.php');
            exit;
        }


        if ($password !== $confirmPassword) {
            $_SESSION['error'] = 'Passwords do not match.';
            header('Location: ../../public/signupcompany.php');
            exit;
        }
   
        $admin = new Admin();
        if ($admin->emailExists($email)) {
            $_SESSION['error'] = 'An account with that email already exists.';
            header('Location: ../../public/signupcompany.php');
            exit;
        }    
      
        $company = new Company( $companyName, $website ,$foundedDate , $email ,$recoveryEmail ,
                         md5($password), $country, $phoneNumber , $address );


        $admin->saveCompany($company);
        echo"<h1>data is saved successfully</h1>";

        

        header('Location: ../../public/login.php');
        exit;
        }
    
    else{
        echo "NOt saved";
    }
?>