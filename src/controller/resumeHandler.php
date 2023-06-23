<?php
session_start();
require_once '../model/JobSeeker.php';



if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit_resume'])) {
    print_r($_FILES['resume']);

    $jobSeeker = new JobSeeker($_SESSION['id']);
    try{
        $jobSeeker->uploadResume($_FILES['resume']);
        $_SESSION['error-uploading-file'] = null;
    } catch(Exception $e) {
        $_SESSION['error-uploading-file'] = $e->getMessage();
    } finally {
        header("Location: ../../public/profile.php");
    }
}