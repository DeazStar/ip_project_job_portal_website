<?php

require_once dirname(__DIR__) . '/core/DataBase.php';

class JobPosted
{
    private $db;
    private PDO $connection;    
    public $rowCount;           

    public function __construct()   
    {
        $this->db = new DataBase();
        $this->connection = $this->db->getConnection(); 
    }

    public function getJobPostings($search = '', $sort = 'job_posted_date')
    {
        // Build the query                      //1=1 true always
        $sql = "SELECT * FROM job_postings WHERE 1=1"; // 

        if (!empty($search)) {
            // Add search conditions
            $search = $this->sanitizeInput($search);
            $sql .= " AND (job_title LIKE '%$search%'
                    OR company_name LIKE '%$search%'
                    OR company_industry LIKE '%$search%')";
        }

        // Add sorting
        switch ($sort) {
            case 'job_posted_date':
                $sql .= " ORDER BY job_posted_date DESC";
                break;
            case 'payment_amount':
                $sql .= " ORDER BY payment_amount DESC";
                break;
        }

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $rowCount = $stmt->rowCount(); // Number of rows fetched

        $jobPostings = [];
        if ($rowCount > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
            {
                $jobPostings[] = $row;
            }
        }
        return $jobPostings;
    }
    public function getJobDetail($JobId)
    {
        // Build the query                 //1=1 true always
        $sql = "SELECT * FROM job_postings WHERE id= $JobId"; //

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $rowCount = $stmt->rowCount(); // Number of rows fetched

        $jobDetail = [];
        if ($rowCount > 0) 
        {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
            {
                $jobDetail[] = $row;
            }
        }
        return $jobDetail;
    }

    private function sanitizeInput($input)
    {
        // Sanitize the input to prevent SQL injection
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

}
//header("Location: ../public/findjob.php");
//exit;   


?>
