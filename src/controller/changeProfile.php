<?php 
require_once '../model/JobSeeker.php';
require_once '../model/ProfilePictureModel.php';
require_once '../model/Company.php';

// to be removed
$_SESSION['id'] = 1;
$_SESSION['type'] = "JobSeeker";
// to be removed

$file = $_FILES['profile-picture'];
if ($_SESSION['type'] == "JobSeeker") {
    $jobSeeker = new JobSeeker($_SESSION['id']);
    $profilePicture = new ProfilePictureModel();
    $profilePicture->uploadPicture($jobSeeker, $file);
} else {
    $company = new $company();
    $profilePicture = new ProfilePictureModel();
    $profilePicture->uploadPicture($company, $file);
}

header("Location: ../../public/profile.php");