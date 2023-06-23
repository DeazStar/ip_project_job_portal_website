<?php 

session_start();
require_once "../model/JobSeeker.php";


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['educationId'])) {
    $jobSeeker = new JobSeeker($_SESSION['id']);
    $jobSeeker->removeEducation($_GET['educationId']);

    header("Location: ../../public/profile.php");
}