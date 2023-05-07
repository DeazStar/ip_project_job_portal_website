<?php

include 'config.php';

$sql = "CREATE TABLE job_postings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_logo VARCHAR(255),
    company_name VARCHAR(255) NOT NULL,
    company_location VARCHAR(255) NOT NULL,
    job_title VARCHAR(255) NOT NULL,
    company_industry VARCHAR(255) NOT NULL,
    employment_type VARCHAR(255) NOT NULL,
    seniority_level VARCHAR(255) NOT NULL,
    payment_amount DECIMAL(10,2) NOT NULL,
    payment_frequency VARCHAR(255) NOT NULL,
    job_description TEXT NOT NULL,
    additional_files VARCHAR(255)
)";

if ($conn->query($sql) === TRUE) {
    echo "job_posting table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>