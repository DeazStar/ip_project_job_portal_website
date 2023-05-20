<?php

require_once "../model/JobSeeker.php";

$_SESSION['id'] = 1;

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit-language'])) {
    $arr = $_POST['language'];
    $languageArray = explode(",", $arr);
    
    $jobSeeker = new JobSeeker($_SESSION['id']);
    $jobSeeker->saveLanguage($languageArray);

    header("Location: ../../public/profile.php");
}