<?php 
session_start();
require_once "../model/JobSeeker.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['employmentId'])) {
    $jobSeeker = new JobSeeker($_SESSION['id']);
    $jobSeeker->removeEmployment($_GET['employmentId']);

    header("Location: ../../public/profile.php");
}