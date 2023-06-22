<?php
session_start();
require_once dirname(__DIR__) . '/core/DataBase.php';

// Define a function to validate the input data
function validate_input($data)
{
    $data = trim($data); // Remove whitespace from the beginning and end
    $data = stripslashes($data); // Remove backslashes
    $data = htmlspecialchars($data); // Convert special characters to HTML entities
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new DataBase();
    $connection = $db->getConnection();

    // Get the form data and validate it
    $companyLogo = $_FILES["company-logo"]["name"]; //stores only the name
    $companyName = validate_input($_POST["company-name"]);
    $companyLocation = validate_input($_POST["company-location"]);
    $jobTitle = validate_input($_POST["job-title"]);
    $companyIndustry = validate_input($_POST["company-industry"]);
    $employmentType = validate_input($_POST["employment-type"]);
    $seniorityLevel = validate_input($_POST["seniority-level"]);
    $paymentAmount = validate_input($_POST["payment-amount"]);
    $paymentFrequency = validate_input($_POST["payment-frequency"]);
    $jobDescription = validate_input($_POST["job-description"]);

    // Prepare the SQL statement with placeholders
    $stmt = $connection->prepare("INSERT INTO job_postings (company_logo, company_name,
                            company_location, job_title, company_industry, employment_type,
                            seniority_level, payment_amount, payment_frequency, job_description)
                            VALUES (:companyLogo, :companyName, :companyLocation, :jobTitle,
                                :companyIndustry, :employmentType, :seniorityLevel, :paymentAmount,
                                :paymentFrequency, :jobDescription)");

    // Bind the form data to the prepared statement
    $stmt->bindParam(':companyLogo', $companyLogo);
    $stmt->bindParam(':companyName', $companyName);
    $stmt->bindParam(':companyLocation', $companyLocation);
    $stmt->bindParam(':jobTitle', $jobTitle);
    $stmt->bindParam(':companyIndustry', $companyIndustry);
    $stmt->bindParam(':employmentType', $employmentType);
    $stmt->bindParam(':seniorityLevel', $seniorityLevel);
    $stmt->bindParam(':paymentAmount', $paymentAmount);
    $stmt->bindParam(':paymentFrequency', $paymentFrequency);
    $stmt->bindParam(':jobDescription', $jobDescription);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Logo upload
    if (!empty($_FILES['company-logo']['name'])) {
        $timestamp = time();
        $uniqueFilename = $timestamp . '_' . basename($companyLogo); //uploading name
        $companyLogo = $timestamp . '_' . basename($companyLogo); ///storing name

        // Define the target file path with the unique filename
        $target_file = "../../public/images/" . $uniqueFilename;

        $tempfilename = $_FILES["company-logo"]["tmp_name"];
        $filesize = $_FILES["company-logo"]["size"];

        // Check if uploaded file is an image
        $image_info = getimagesize($tempfilename);
        if (!$image_info) {
            $_SESSION['error'] = "<h5 class='alert alert-danger text-center' style='max-width: 70%' style='min-width: 50%' alert-dismissible> Invalid logo used</h5>";
            header("Location: ../../public/postjob.php");
            exit;
        }

        // Check if uploaded file is too big
        if ($filesize > 2097152) {
            echo 'File too big';
            exit;
        }

        // Check if uploaded file is allowed file type
        $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        if (!in_array($image_info[2], $allowed_types)) {
            echo 'Only PNG, JPEG, and GIF files are allowed';
            exit;
        }

        // uploading img to folder
        if (move_uploaded_file($tempfilename, $target_file)) {
            echo "The image " . basename($companyLogo) . " has been uploaded.";
        } else {
            $_SESSION['error'] = "<h5 class='alert alert-danger text-center' style='max-width: 70%' style='min-width: 50%' alert-dismissible> Please choose a valid image</h5>";
            header("Location: ../../public/postjob.php");
            
        }
    } else {
        $companyLogo = 'logo.png'; ///storing name
    }

    // Execute the prepared statement
    try {
        $stmt->execute();

        $_SESSION['error'] = "<h5 class='alert alert-success text-center' style='max-width: 70%' style='min-width: 50%' alert-dismissible> Job Successfully posted</h5>";
        header("Location: ../../public/postjob.php");
        
    } catch (PDOException $e) {
        $_SESSION['error'] = "<h5 class='alert alert-danger text-center' style='max-width: 70%' style='min-width: 50%' alert-dismissible> Sorry, the job was not posted. There was an error in the SQL statement.</h5>";
        header("Location: ../../public/postjob.php");
        exit;
    }

    // Close the prepared statement and database connection
    $stmt = null;
    $connectionObject = null;
} else {
    echo "No POST method";
}
