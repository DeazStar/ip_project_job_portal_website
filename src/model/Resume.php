<?php

require_once dirname(__DIR__) . '/core/DataBase.php';


class Resume {
    private string $resumeUrl;

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