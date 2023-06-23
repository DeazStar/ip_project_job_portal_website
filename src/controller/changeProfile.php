<?php 
session_start();
require_once '../model/JobSeeker.php';
require_once '../model/ProfilePictureModel.php';
require_once '../model/Company.php';



$file = $_FILES['profile-picture'];
if ($_SESSION['user_type'] == "JOB_SEEKER") {
    $jobSeeker = new JobSeeker($_SESSION['id']);
    $profilePicture = new ProfilePictureModel();
    $profilePicture->uploadPicture($jobSeeker, $file);
    header("Location: ../../public/profile.php");
    
} else if ($_SESSION['user_type'] == "COMPANY") {
    $company = new Company(1);
    $profilePicture = new ProfilePictureModel();
    $profilePicture->uploadPicture($company, $file);
    header("Location: ../../public/companyProfile.php");
}