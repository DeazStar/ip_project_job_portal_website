<?php 
session_start();
require_once "../model/JobSeeker.php";


if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit-skill'])) {
    $arr = $_POST['skill'];
    $skillArray = explode(",", $arr);
    

    print_r($skillArray);
    
    $jobSeeker = new JobSeeker($_SESSION['id']);
    $jobSeeker->saveSkill($skillArray);

    header("Location: ../../public/profile.php");

}