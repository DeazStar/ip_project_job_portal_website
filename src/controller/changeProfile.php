<?php 
require_once '../model/JobSeeker.php';
require_once '../model/ProfilePictureModel.php';
require_once '../model/Company.php';

// to be removed
$_SESSION['id'] = 1;
$_SESSION['type'] = "company";
// to be removed

$file = $_FILES['profile-picture'];
if ($_SESSION['type'] == "JobSeeker") {
    $jobSeeker = new JobSeeker($_SESSION['id']);
    $profilePicture = new ProfilePictureModel();
    $profilePicture->uploadPicture($jobSeeker, $file);
    header("Location: ../../public/profile.php");
    
} else if ($_SESSION['type'] == "company") {
    $company = new Company(1);
    $profilePicture = new ProfilePictureModel();
    $profilePicture->uploadPicture($company, $file);
    header("Location: ../../public/companyProfile.php");
}