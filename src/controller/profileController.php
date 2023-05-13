<?php

require_once "../model/JobSeeker.php";

$_SESSION['id'] = 1;

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit-personal-info'])) {
    $jobSeeker = new JobSeeker($_SESSION['id']);
    $jobSeeker->updateProfile($_POST);
}

header("Location: ../../public/profile.php");