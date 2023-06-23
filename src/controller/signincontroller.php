<?php
require_once "../core/DataBase.php";
require_once "../model/admin.php";
session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {
    
    //COLLECT FORM DATA
    $email = $_POST['email'];
    $password = $_POST['password'];
    $admin = new Admin();
    
    //  CHECK IF COMPANY EXISTS WITH THIS EMAIL AND PASSWORD
    if(!$admin->getCompany($email , $password)){

        // IF NO JOB SEEKER IS FOUND!!
        $userFound = $admin->getUser($email , $password);
        
        if(!$userFound){
            $_SESSION['error'] = "Invalid email or password";
            header('Location:../../public/login.php');
            exit;
        }
        else{

            // IF JOB SEEKER IS FOUND
            header('Location:../../public/findjob.php');
            exit;
        }
    }
    else{

        // IF COMPANY IS FOUND
        header('Location:../../public/findtalent.php');
        exit;
    }
    
}


$_SESSION['error'] = "All fields are required!!";
header('Location:login.php');
?>
