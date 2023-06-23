<?php
session_start();

require_once '../model/JobService.php';

if(isset($_GET['job-id'])) {
    try{
        var_dump($_SESSION['id']);
        var_dump($_GET['job-id']);
        JobService::applyJob($_GET['job-id'], $_SESSION['id']);
    } catch (Exception $e) {
        $_SESSION['apply-job-error'] = $e->getMessage();
    }
}

header("Location: ../../public/findjob.php");