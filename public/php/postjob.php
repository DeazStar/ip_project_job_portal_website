<?php
session_start();
include 'config.php';

// Define a function to validate the input data
function validate_input($data)
{
    $data = trim($data); // Remove whitespace from the beginning and end
    $data = stripslashes($data); // Remove backslashes
    $data = htmlspecialchars($data); // Convert special characters to HTML entities
    return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    
        // Check if the form was submitted
        $companyLogo = $_FILES["company-logo"]["name"];
        $filesize = $_FILES["company-logo"]["size"];

        $tempfilename = $_FILES["company-logo"]["tmp_name"];
        $location = 'uploads/';

        // path concatenation 
        $target_file = $location . basename($companyLogo);


    // Get the form data and validate it
    $companyLogo = $_FILES["company-logo"]["name"];; //store only the name
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
    $stmt = $conn->prepare("INSERT INTO job_postings (company_logo, company_name,
                            company_location, job_title, company_industry, employment_type,
                            seniority_level, payment_amount, payment_frequency, job_description)
                            VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the form data to the prepared statement
    $stmt->bind_param("ssssssssss", $company_logo, $companyName, $companyLocation,
        $jobTitle, $companyIndustry, $employmentType, $seniorityLevel, $paymentAmount,
        $paymentFrequency, $jobDescription);

    
    //logo upload
    if (!empty($_FILES['company-logo']['name'])) //if no file name,, no uploads {
   {
         if ($filesize > 2097152) 
         {
            echo 'file to big';
         } 
            // move uploaded file to the target directory
            elseif (move_uploaded_file($tempfilename, $target_file)) 
            {
                echo "The file " . basename($companyLogo) . " has been uploaded.";
            } 
            else
             {
            echo "Sorry, there was an error uploading your file.";
            }
    } else
     {
        echo 'pls upload a file';
     }


    // Execute the prepared statement
    if ($stmt->execute()) {
        $_SESSION['error']="<h5 class='alert alert-success text-center' style='max-width: 60%' style='min-width: 40%' alert-dismissible> Post Sucessfully posted</h5>";
        header("Location:../postjob.php");
    } else {
        echo "Error: " . $stmt->error;
        $_SESSION['error']="<h5 class='alert alert-success text-center' style='max-width: 60%' style='min-width: 40%' alert-dismissible> Post Sucessfully posted</h5>";
        header("Location:../postjob.php");
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
} 
else 
{
        echo "no post method";
}

?>