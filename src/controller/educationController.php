<?php
session_start();
require_once "../model/JobSeeker.php";


if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit-education'])) {
    $jobSeeker = new JobSeeker($_SESSION['id']);

    if($_POST['operation'] === 'insert') {
        $jobSeeker->saveEducation($_POST['degree-type'], $_POST['field'], $_POST['institute'], 
        $_POST['enrolled-date'], $_POST['graduated-date']);
    } else if ($_POST['operation'] === 'update') {
        $jobSeeker->updateEducation($_POST['education-id'], $_POST['degree-type'], $_POST['field'], $_POST['institute'], 
        $_POST['enrolled-date'], $_POST['graduated-date']);
    }
    
    header("Location: ../../public/profile.php");
}