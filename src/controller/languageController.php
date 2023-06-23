<?php
session_start();
require_once "../model/JobSeeker.php";

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit-language'])) {
    $arr = $_POST['language'];
    $languageArray = explode(",", $arr);
    
    $jobSeeker = new JobSeeker($_SESSION['id']);
    $jobSeeker->saveLanguage($languageArray);
    header("Location: ../../public/profile.php");
}