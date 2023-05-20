<?php

require_once dirname(__DIR__) . '/core/DataBase.php';


class Resume {
    private string $resumeUrl;

    private array $language = [];

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
    }

    /**
     * getter method for language
     * 
     * @return array
     */
    public function getLanguage():array {
        return $this->language;
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
    public function getResumeUrl():string {
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
        $this->resumeUrl = $result['resume_url'];
    }

    /**
     * A destructor method to close the database connection when the object is destroyed
     * @return void
     */
    public function __destruct() {
        $this->db->close();
    }
}