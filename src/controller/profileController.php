<?php

require_once "../model/JobSeeker.php";
require_once "../model/Company.php";

$_SESSION['id'] = 1;

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit-personal-info'])) {
    $jobSeeker = new JobSeeker($_SESSION['id']);
    $jobSeeker->updateProfile($_POST);
    header("Location: ../../public/companyProfile.php");
} else if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit-company-info'])) {
    $company = new Company($_SESSION['id']);
    $company->updateProfile($_POST);
    header("Location: ../../public/companyProfile.php");
}
