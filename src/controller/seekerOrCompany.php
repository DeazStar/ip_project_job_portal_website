<?php
if(isset($_POST['choice'])){
    if($_POST['choice'] == "1"){
        header('Location:../../public/signupcompany.php');
        exit;
    }
    else{
        header('Location:../../public/signup.php');
        exit;
    }
}
else{
    header('Location:../../public/choose.php');
    exit;
}
?>