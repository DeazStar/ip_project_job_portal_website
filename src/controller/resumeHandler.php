<?php
require_once '../model/JobSeeker.php';

// to be removed
$_SESSION['id'] = 1;


if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit_resume'])) {
    print_r($_FILES['resume']);

    $jobSeeker = new JobSeeker($_SESSION['id']);
    $jobSeeker->uploadResume($_FILES['resume']);
}