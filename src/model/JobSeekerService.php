<?php 

require_once dirname(__DIR__) . '/core/DataBase.php';
require_once 'JobSeeker.php';

class JobSeekerService {

    public static function getAllJobSeekers($start, $finish):array {
        $sql = "SELECT job_seeker_id, first_name, last_name , country,  professional_title ,profile_picture_url FROM job_seeker LIMIT $start, $finish";
        $jobSeekers = [];

        try {
            $db = new DataBase();
            $connection = $db->getConnection();

            $stmt = $connection->query($sql);

            $stmt->execute();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $jobSeeker = new JobSeeker($result['job_seeker_id']);
                $jobSeeker->getPersonalInfo()->setFirstName($result['first_name']);
                $jobSeeker->getPersonalInfo()->setLastName($result['last_name']);
                $jobSeeker->getPersonalInfo()->setCountry($result['country']);
                $jobSeeker->getPersonalInfo()->setProfessionalTitle($result['professional_title']);
                $jobSeeker->setProfileUrl($result['profile_picture_url']);

                $jobSeekers[] = $jobSeeker;

            }


        } catch (PDOException $e) {
            echo "error fetching profiles" . $e->getMessage();
        }

        return $jobSeekers;
    }

    public static function getAppliedJobSeeker($id, $start, $finish): array {
        $sql = "SELECT js.job_seeker_id, js.first_name, js.last_name, js.country, js.professional_title, js.profile_picture_url
                FROM applied_job aj
                INNER JOIN job_seeker js ON aj.job_seeker_id = js.job_seeker_id
                WHERE aj.job_postings_id = :id
                LIMIT :start, :finish";
    
        $jobSeekers = [];
    
        try {
            $db = new DataBase();
            $connection = $db->getConnection();
    
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':start', $start, PDO::PARAM_INT);
            $stmt->bindValue(':finish', $finish, PDO::PARAM_INT);
            $stmt->execute();
    
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $jobSeeker = new JobSeeker($result['job_seeker_id']);
                $jobSeeker->getPersonalInfo()->setFirstName($result['first_name']);
                $jobSeeker->getPersonalInfo()->setLastName($result['last_name']);
                $jobSeeker->getPersonalInfo()->setCountry($result['country']);
                $jobSeeker->getPersonalInfo()->setProfessionalTitle($result['professional_title']);
                $jobSeeker->setProfileUrl($result['profile_picture_url']);
    
                $jobSeekers[] = $jobSeeker;
            }
        } catch (PDOException $e) {
            echo "Error fetching profiles: " . $e->getMessage();
        }
    
        return $jobSeekers;
    }
    

    public static function getRows() {
        $sql = "SELECT COUNT(*) as count FROM job_seeker";
        $count = 1;

        try {
            $db = new DataBase();
            $connection = $db->getConnection();

            $stmt = $connection->query($sql);
            $stmt->execute();

            $result = $stmt->fetchColumn();

            $count = $result ?? 1;
        } catch (PDOException $e) {
            echo "Sorry Something wen't wrong" . $e->getMessage();
        }

        return $count;
    }

    public static function getAppliedRow() {
        $sql = "SELECT COUNT(*) as count FROM applied_job";
        $count = 1;

        try {
            $db = new DataBase();
            $connection = $db->getConnection();

            $stmt = $connection->query($sql);
            $stmt->execute();

            $result = $stmt->fetchColumn();

            $count = $result ?? 1;
        } catch (PDOException $e) {
            echo "Sorry Something wen't wrong" . $e->getMessage();
        }

        return $count;
    }
}