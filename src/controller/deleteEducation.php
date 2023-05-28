<?php 

require_once "../model/JobSeeker.php";

$_SESSION['id'] = 1;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['educationId'])) {
    $jobSeeker = new JobSeeker($_SESSION['id']);
    $jobSeeker->removeEducation($_GET['educationId']);

    header("Location: ../../public/profile.php");
}