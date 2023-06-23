<?php

require_once dirname(__DIR__) . '/core/DataBase.php';
require_once 'Job.php';

class JobService {
    public static function applyJob(int $jobId, int $jobSeekerId):void {
        $sql = "INSERT INTO applied_job(job_postings_id, job_seeker_id) VALUES(:job_postings_id, :job_seeker_id)";

        try {
            $db = new DataBase();
            $connection = $db->getConnection();

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(":job_postings_id", $jobId);
            $stmt->bindParam(":job_seeker_id", $jobSeekerId);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Oops Something went wrong try again');
        }
    }
    public static function getPostedJobById(int $id, $start, $finish): array {
        $sql = "SELECT * FROM job_postings WHERE company_id = :id LIMIT :start, :finish";
        $jobs = [];
        
        try {
            $db = new DataBase();
            $connection = $db->getConnection();
            
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":start", $start, PDO::PARAM_INT);
            $stmt->bindParam(":finish", $finish, PDO::PARAM_INT);
            $stmt->execute();
            
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $job = new Job($result['id']);
                $job->setJobTitle($result['job_title']);
                $job->setJobPostedDate(DateTime::createFromFormat('Y-m-d H:i:s', $result['job_posted_date']));
                $job->setEmploymentType($result['employment_type']);
    
                $jobs[] = $job;
            }
        } catch (PDOException $e) {
            echo "Error fetching jobs: " . $e->getMessage();
        }
        
        return $jobs;
    }


    public static function appliedJob(int $id, $start, $finish): array {
        $sql = "SELECT jp.* FROM job_postings jp 
                JOIN applied_job aj ON jp.id = aj.job_postings_id 
                JOIN job_seeker js ON aj.job_seeker_id = js.job_seeker_id
                WHERE js.job_seeker_id = :id 
                LIMIT :start, :finish";
        $jobs = [];
        
        try {
            $db = new DataBase();
            $connection = $db->getConnection();
            
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":start", $start, PDO::PARAM_INT);
            $stmt->bindParam(":finish", $finish, PDO::PARAM_INT);
            $stmt->execute();
            
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $job = new Job($result['id']);
                $job->setJobTitle($result['job_title']);
                $job->setJobPostedDate(DateTime::createFromFormat('Y-m-d H:i:s', $result['job_posted_date']));
                $job->setEmploymentType($result['employment_type']);
    
                $jobs[] = $job;
            }
        } catch (PDOException $e) {
            echo "Error fetching jobs: " . $e->getMessage();
        }
        
        return $jobs;
    }

    public static function getPostedJobRow($id) {
        $sql = "SELECT COUNT(*) as count FROM job_postings WHERE company_id = :id";
        $count = 0;
    
        try {
            $db = new DataBase();
            $connection = $db->getConnection();
    
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
    
            $result = $stmt->fetchColumn();
    
            $count = $result ?? 0;
        } catch (PDOException $e) {
            echo "Sorry, something went wrong: " . $e->getMessage();
        }
    
        return $count;
    }

    public static function appliedRow($id) {
        $sql = "SELECT COUNT(*) as count FROM applied_job WHERE job_seeker_id = :id";
        $count = 0;

        try {
            $db = new DataBase();
            $connection = $db->getConnection();
    
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
    
            $result = $stmt->fetchColumn();
    
            $count = $result ?? 0;
        } catch (PDOException $e) {
            echo "Sorry, something went wrong: " . $e->getMessage();
        }
    
        return $count;
    }
    
}
