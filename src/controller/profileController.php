<?php

session_start();
require_once "../model/JobSeeker.php";
require_once "../model/Company.php";

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit-personal-info'])) {
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['professional-title']) 
        && !empty($_POST['birth-date']) && !empty($_POST['phone-number']) && !empty($_POST['email'])
        && !empty($_POST['country']) && !empty($_POST['postcode']) && !empty($_POST['city']) && !empty($_POST['address'])) {
        $jobSeeker = new JobSeeker($_SESSION['id']);
        $jobSeeker->updateProfile($_POST);
        $_SESSION['required-personal-info'] = null; // Clear the error message
    } else {
        $_SESSION['required-personal-info'] = "all fields are required except the Description";
    }
    header("Location: ../../public/profile.php");
} else if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit-company-info'])) {
    if (!empty($_POST['company-name']) && !empty($_POST['email']) && !empty($_POST['website']) && !empty($_POST['founded-date'])
        && !empty($_POST['phone-number']) && !empty($_POST['country']) && !empty($_POST['postcode']) && !empty($_POST['address'])) {
        $company = new Company($_SESSION['id']);
        $company->updateProfile($_POST);
        $_SESSION['required-personal-info'] = null; // Clear the error message
    } else {
        $_SESSION['required-personal-info'] = "all fields are required except the Description";
    }
    header("Location: ../../public/companyProfile.php");
}

