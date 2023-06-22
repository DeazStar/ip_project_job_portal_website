<?php
session_start();
if(isset($_POST['choice'])){
    if($_POST['choice'] == "1"){
        $_SESSION['pass'] = true;
        header('Location:../../public/signupcompany.php');
        exit;
    }
    else{
        $_SESSION['pass'] = true;
        header('Location:../../public/signup.php');
        exit;
    }
}
else{
    header('Location:../../public/choose.php');
    exit;
}
?>