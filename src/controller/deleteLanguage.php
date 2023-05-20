<?php

require_once "../model/JobSeeker.php";

$_SESSION['id'] = 1;

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $jobSeeker = new JobSeeker($_SESSION['id']);
    $jobSeeker->removeLanguage($_GET['languageId']);

    header("Location: ../../public/profile.php");
}