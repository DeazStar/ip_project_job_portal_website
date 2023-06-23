<?php

require_once dirname(__DIR__) . '/core/DataBase.php';
require_once 'Company.php';

class Job {
    private Company $company;
    private int $id;
    private string $jobTitle;
    private DateTime $jobPostedDate;
    private string $employmentType;
    private string $seniorityLevel;
    private float $paymentAmount;
    private string $paymentFrequency;
    private PDO $connection;
    private DataBase $db;

    public function __construct(int $id) {
        $this->id = $id;
        $this->db = new DataBase();
        $this->connection = $this->db->getConnection();
    }

    public function setJobId(int $id):void {
        $this->$id = $id;
    }

    public function getJobId():int {
        return $this->id;
    }
    public function setJobTitle(string $jobTitle):void {
        $this->jobTitle = $jobTitle;
    }

    public function getJobTitle():string {
        return $this->jobTitle;
    }

    public function setJobPostedDate(DateTime $jobPostedDate):void {
        $this->jobPostedDate = $jobPostedDate;
    }

    public function getJobPostedDate():DateTime {
        return $this->jobPostedDate;
    }

    public function setEmploymentType(string $employmentType):void {
        $this->employmentType = $employmentType;
    }

    public function getEmploymentType():string {
        return $this->employmentType;
    }

    public function setSeniorityLevel(string $seniorityLevel):void {
        $this->seniorityLevel = $seniorityLevel;
    }

    public function getSeniorityLevel():string {
        return $this->seniorityLevel;
    }

    public function setPaymentAmount(float $paymentAmount):void {
        $this->paymentAmount = $paymentAmount;
    }

    public function getPaymentAmount():float {
        return $this->paymentAmount;
    }

    public function setPaymentFrequency(string $paymentFrequency):void {
        $this->paymentFrequency = $paymentFrequency;
    }

    public function getPaymentFrequency():string {
        return $this->paymentFrequency;
    }

    public function setCompany(Company $company):void{
        $this->company = $company;
    }

    public function getCompany():Company {
        return $this->company;
    }

    /*public function getPostedJobs() {
        $sql = "SELECT * FROM job_postings WHERE ";
        $postedJobs = [];

        try {
            $stmt = $this->connection->prepare($sql);

            $stmt->execute();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                
            }
        }
    }*/

    /**
     * A destructor method to close the database connection when the object is destroyed
     * @return void
     */
    public function __destruct()
    {
        $this->db->close();
    }

} 