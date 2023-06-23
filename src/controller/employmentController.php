<?php
session_start(); 
require_once "../model/JobSeeker.php";


if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit-employment'])) {
    $jobSeeker = new JobSeeker($_SESSION['id']);

    if($_POST['operation'] === 'insert') {
        $jobSeeker->saveEmployment($_POST['position'], $_POST['company'], $_POST['started-date'], 
        $_POST['end-date']);
    } else if ($_POST['operation'] === 'update') {
        $jobSeeker->updateEmployment($_POST['employment-id'], $_POST['position'], $_POST['company'], 
        $_POST['started-date'], $_POST['end-date']);
    }
    
    header("Location: ../../public/profile.php");
}