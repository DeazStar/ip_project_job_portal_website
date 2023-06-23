<?php

require_once dirname(__DIR__) . '/core/DataBase.php';
require_once 'EducationModel.php';
require_once 'EmploymentModel.php';


class Resume {
    private ?string $resumeUrl = null;
    private Education $education; 
    private Employment $employment;

    private array $language = [];
    
    private array $skill = [];

    private DataBase $db;

    private PDO $connection;

    /**
     * Resume construct 
     * 
     * Create a new instance of the Resume class.
     */
    public function __construct() {
        $this->db = new DataBase();
        $this->connection = $this->db->getConnection(); 
        $this->education = new Education();
        $this->employment = new Employment();
    }

    /**
     * getter method for language
     * 
     * @return array
     */
    public function getLanguage():array {
        return $this->language;
    }

    public function getSkill():array {
        return $this->skill;
    }

    public function getEducation():Education {
        return $this->education;
    }

    public function getEmployment():Employment {
        return $this->employment;
    }

    /**
     * addLanguage set the language and then use a saveLanguage() interactively to save to database
     * 
     * @param int $userId the job seeker id
     * @param array $language the languages selected job seeker
     * 
     * @return void
     */
    public function addLanguage(int $userId, array $language):void {
        $this->language = $language;

        foreach($this->language as $lang) {
            $this->saveLanguage($userId, $lang);
        }
    }

    /**
     * saveLanguage a method to save a language into the database
     * 
     * @param int $userId the job seeker id
     * @param string $language the language to save to database 
     * 
     * @return void
     */
    private function saveLanguage(int $userId, string $language):void {        
        $checkLanguage = "SELECT language_id FROM language WHERE language = :language";
        $checkMap = "SELECT job_seeker_id FROM user_language WHERE job_seeker_id = :id AND language_id = :languageId";
        $map = "INSERT INTO user_language(job_seeker_id, language_id) VALUES(:id, :languageId)";
        $addLanguage = "INSERT INTO language(language) VALUES(:language)";

        try {
            $stmt = $this->connection->prepare($checkLanguage);
            $stmt->bindParam(":language", $language);

            $stmt->execute();

            $languageId = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($languageId) > 0) {
                $stmtTwo = $this->connection->prepare($checkMap);
                $stmtTwo->bindParam(":id", $userId);
                $stmtTwo->bindParam(":languageId", $languageId[0]['language_id']);

                $stmtTwo->execute();

                $jobSeekerId = $stmtTwo->fetchAll(PDO::FETCH_ASSOC);

                if(count($jobSeekerId) === 0) {
                    $stmtThree = $this->connection->prepare($map);
                    $stmtThree->bindParam(":id", $userId);
                    $stmtThree->bindParam(":languageId", $languageId[0]['language_id']);

                    $stmtThree->execute();
                }


            } else {
                $stmtFour = $this->connection->prepare($addLanguage);
                $stmtFour->bindParam(":language", $language);
                
                $stmtFour->execute();

                $lastInsertedId = $this->connection->lastInsertId();

                $stmtFive = $this->connection->prepare($map);
                $stmtFive->bindParam(":id", $userId);
                $stmtFive->bindParam(":languageId", $lastInsertedId);

                $stmtFive->execute();
            }
        } catch (PDOException $e) {
            echo "can't fetch data " . $e->getMessage();
        }
    }

    /**
     * deleteLanguage a method to delete a language from database 
     * 
     * @param int $userId the job seeker id
     * @param int $languageId the language id
     * 
     * @return void
     */
    public function deleteLanguage(int $userId, int $languageId):void {
        $sql = "DELETE FROM user_language WHERE job_seeker_id = :userId AND language_id = :languageId";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":languageId", $languageId);

            $stmt->execute();

        } catch (PDOException $e) {
            echo "Can't delete data" . $e->getMessage();
        }
    }

    /**
     * fetchLanguage retrieve the language from the database
     * 
     * @param int $userId the job seeker id 
     * 
     * @return void
     */
    public function fetchLanguage(int $userId):void {
        $sql = "SELECT language_id FROM user_language WHERE job_seeker_id = :id";
        $sqlTwo = "SELECT * FROM language WHERE language_id = :id";
        $languageId = [];
        try {

            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $userId);

            $stmt->execute();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $languageId[] = $row;
            }


            foreach($languageId as $id) {
                $stmt = $this->connection->prepare($sqlTwo);
                $stmt->bindParam(":id", $id['language_id']);

                $stmt->execute();

                $this->language[] = $stmt->fetch(PDO::FETCH_ASSOC);
                
            }



        } catch(PDOException $e) {
            echo "Can't fetch language from the database" . $e->getMessage();
        }

        
    }

    /**
     * getter method for resumeUrl
     * 
     * @return string
     */
    public function getResumeUrl():string|null {
        return $this->resumeUrl;
    }

    /**
     * saveResume - upload the resume in to the upload directory and save the path in database
     * 
     * @param int $id
     * @param array $file
     * 
     * @throws Exception if file have an error 
     * @throws Exception if file is not a pdf file 
     * @throws Exception if file is too big
     * 
     * @return void
     */
    public function saveResume(int $id, array $file): void {
        $filePath = dirname(dirname(__Dir__)).'/public/uploads/jobseeker-profile/resume/';
        $fileTmpName = $file['tmp_name'];
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $allowedExtension = ["pdf"];
        $size = 10000000;
        $tmpExt = explode(".", $fileName);
        $fileExtension = strtolower(end($tmpExt));


        $sql = "UPDATE job_seeker SET resume_url= :url WHERE job_seeker_id = :id";

        if ($file['error'] === 0) {
            if ($fileSize < $size) {
                if (in_array($fileExtension, $allowedExtension)) {
                    $newFileName = uniqid('', true) . "." . $fileExtension;
                    $newFilePath = $filePath . $newFileName;
                    move_uploaded_file($fileTmpName, $newFilePath);
                    $stmt = $this->connection->prepare($sql);
                    $stmt->bindParam(":id", $id);
                    $stmt->bindParam(":url", $newFilePath);
                    $stmt->execute();
                } else {
                    throw new Exception("unsupported file type, upload only pdf files");
                }
            } else {
                throw new Exception("FIle is too big");
            }
        } else {
            throw new Exception("Error uploading the file");
        }
    }

    /**
     * fetchResumeUrl - fetch the path of the resume file from the database
     * 
     * @param int $id
     * 
     * @return void
     */
    public function fetchResumeUrl(int $id):void {
        $sql = "SELECT resume_url FROM job_seeker WHERE job_seeker_id= :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(isset($result)) {
            $this->resumeUrl = $result['resume_url'];
        }
    }

    public function addSkill(int $userId, array $skill):void {
        $this->skill = $skill;

        foreach($this->skill as $sk) {
            $this->saveSkill($userId, $sk);
        }
    }
    private function saveSkill(int $userId, string $skill):void {        
        $checkSkill = "SELECT skill_id FROM skill WHERE skill = :skill";
        $checkMap = "SELECT job_seeker_id FROM user_skill WHERE job_seeker_id = :id AND skill_id = :skillId";
        $map = "INSERT INTO user_skill(job_seeker_id, skill_id) VALUES(:id, :skillId)";
        $addSkill = "INSERT INTO skill(skill) VALUES(:skill)";

        try {
            $stmt = $this->connection->prepare($checkSkill);
            $stmt->bindParam(":skill", $skill);

            $stmt->execute();

            $skillId = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($skillId) > 0) {
                $stmtTwo = $this->connection->prepare($checkMap);
                $stmtTwo->bindParam(":id", $userId);
                $stmtTwo->bindParam(":skillId", $skillId[0]['skill_id']);

                $stmtTwo->execute();

                $jobSeekerId = $stmtTwo->fetchAll(PDO::FETCH_ASSOC);

                if(count($jobSeekerId) === 0) {
                    $stmtThree = $this->connection->prepare($map);
                    $stmtThree->bindParam(":id", $userId);
                    $stmtThree->bindParam(":skillId", $skillId[0]['skill_id']);

                    $stmtThree->execute();
                }


            } else {
                $stmtFour = $this->connection->prepare($addSkill);
                $stmtFour->bindParam(":skill", $skill);
                
                $stmtFour->execute();

                $lastInsertedId = $this->connection->lastInsertId();

                $stmtFive = $this->connection->prepare($map);
                $stmtFive->bindParam(":id", $userId);
                $stmtFive->bindParam(":skillId", $lastInsertedId);

                $stmtFive->execute();
            }
        } catch (PDOException $e) {
            echo "can't fetch data " . $e->getMessage();
        }
    }

    public function fetchSkill(int $userId):void {
        $sql = "SELECT skill_id FROM user_skill WHERE job_seeker_id = :id";
        $sqlTwo = "SELECT * FROM skill WHERE skill_id = :id";
        $skillId = [];
        try {

            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $userId);

            $stmt->execute();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $skillId[] = $row;
            }


            foreach($skillId as $id) {
                $stmt = $this->connection->prepare($sqlTwo);
                $stmt->bindParam(":id", $id['skill_id']);

                $stmt->execute();

                $this->skill[] = $stmt->fetch(PDO::FETCH_ASSOC);
                
            }

        } catch(PDOException $e) {
            echo "Can't fetch skill from the database" . $e->getMessage();
        }
        
    }

    public function deleteSkill(int $userId, int $skillId):void {
        $sql = "DELETE FROM user_skill WHERE job_seeker_id = :userId AND skill_id = :skillId";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":skillId", $skillId);

            $stmt->execute();

        } catch (PDOException $e) {
            echo "Can't delete data" . $e->getMessage();
        }
    }

    public function addEducation(int $userId, string $degreeType, string $field, 
    string $institute, string $enrolledDate, string $graduatedDate): void {
        $this->education->setDegreeType($degreeType);
        $this->education->setField($field);
        $this->education->setInstitute($institute);
        $this->education->setEnrolledDate($enrolledDate);
        $this->education->setGraduatedDate($graduatedDate);

        $this->education->saveEducation($userId);
    }

    public function addEmployment(int $userId, string $position, string $company, 
    string $startedDate, string $dateLeft): void {
        $this->employment->setPosition($position);
        $this->employment->setCompany($company);
        $this->employment->setStartedDate($startedDate);
        $this->employment->setDateLeft($dateLeft);

        $this->employment->saveEmployment($userId);
    }

    public function fetchEducation(int $userId): array {
        $educationArray =  $this->education->retrieveEducation($userId);
        $educationObject = [];

        foreach($educationArray as $education) {
            $obj = new Education();

            $obj->setId($education['education_id']);
            $obj->setDegreeType($education['degree_type']);
            $obj->setField($education['field']);
            $obj->setInstitute($education['institute']);
            $obj->setEnrolledDate($education['enrolled_date']);
            $obj->setGraduatedDate($education['graduated_date']);

            array_push($educationObject, $obj);

        }


        return $educationObject;

    }

    public function fetchEmployment(int $userId): array {
        $employmentArray =  $this->employment->retrieveEmployment($userId);
        $employmentObject = [];

        foreach($employmentArray as $employment) {
            $obj = new Employment();

            $obj->setId($employment['employment_id']);
            $obj->setPosition($employment['position']);
            $obj->setCompany($employment['company']);
            $obj->setStartedDate($employment['started_date']);
            $obj->setDateLeft($employment['date_left']);

            array_push($employmentObject, $obj);

        }


        return $employmentObject;

    }

    public function deleteEducation(int $userId, int $educationId):void {
        $this->education->removeEducation($userId, $educationId);
    }

    public function deleteEmployment(int $userId, int $employmentId):void {
        $this->employment->removeEmployment($userId, $employmentId);
    }

    public function updateEducation(int $userId, int $educationId,string $degreeType, string $field, 
    string $institute, string $enrolledDate, string $graduatedDate): void {
        $this->education->setDegreeType($degreeType);
        $this->education->setField($field);
        $this->education->setInstitute($institute);
        $this->education->setEnrolledDate($enrolledDate);
        $this->education->setGraduatedDate($graduatedDate);
        $this->education->setId($educationId);

        $this->education->updateEducation($userId, $educationId);
    }

    public function updateEmployment(int $userId, int $employmentId,string $position, string $company, 
    string $startedDate, string $dateLeft): void {
        $this->employment->setPosition($position);
        $this->employment->setCompany($company);
        $this->employment->setStartedDate($startedDate);
        $this->employment->setDateLeft($dateLeft);
        $this->employment->setId($employmentId);

        $this->employment->updateEmployment($userId, $employmentId);
    }
    /**
     * A destructor method to close the database connection when the object is destroyed
     * @return void
     */
    public function __destruct() {
        $this->db->close();
    }
}