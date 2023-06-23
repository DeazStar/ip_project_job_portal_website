<?php
session_start();

var_dump($_SESSION);
if ($_SESSION['user_type'] == 'JOB_SEEKER') {
    header("Location: ../../public/profile.php");
} else if ($_SESSION['user_type'] == 'COMPANY') {
    header("Location: ../../public/companyProfile.php");
} else {
    header("Location: ../../public/index.php");
}
