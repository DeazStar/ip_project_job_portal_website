<?php

declare(strict_types=1);

require_once 'JobSeeker.php';
require_once 'Company.php';
require_once dirname(__DIR__) . '/core/DataBase.php';

/**
 * Class ProfilePictureModel
 * 
 * Handles the upload and retrieval of profile of profile pictures for job seekers and companies.
 */
class ProfilePictureModel
{
    private string $filePath;
    private int $size = 10000000;

    private string $fileTmp;

    private string $fileExtension;

    private string $fileName;

    private array $acceptedExt = ['jpg', 'jpeg', 'png'];

    private PDO $connection;

    private DataBase $db;

    /**
     * ProfilePictureModel constructor.
     * 
     * Create a new instance of the ProfilePictureModel class.
     */
    public function __construct()
    {
        $this->db = new DataBase();
        $this->connection = $this->db->getConnection();
    }


    /**
     * Upload a picture for the given user and store the reference in the database
     * 
     * @param JobSeeker|Company $user the user object for whom to upload the picture.
     * @param array $file the file array containing the uploaded picture data
     * 
     * @throws Exception If the file is too big, unsupported types, or an error occurs while uploading
     * @throws InvalidArgumentException If an invalid user type is provided.
     * 
     * @return void
     */
    public function uploadPicture(JobSeeker|Company $user, array $file): void
    {
        if ($user instanceof JobSeeker) {
            $this->filePath = dirname(dirname(__Dir__)).'/public/uploads/jobseeker-profile/';
            $sql = "UPDATE job_seeker SET profile_picture_url= :url WHERE job_seeker_id = :id";
            $id = $user->getId();
        } else if ($user instanceof Company) {
            $this->filePath = dirname(dirname(__Dir__)).'/public/uploads/company-profile/';
            $sql = "UPDATE company SET company_logo_url= :url WHERE company_id = :id";
            $id = $user->getId();
        } else {
            throw new InvalidArgumentException('Invalid user type provided');
        }

        $this->fileTmp = $file['tmp_name'];
        $this->fileName = $file['name'];
        $tmpExt = explode('.', $this->fileName);
        $this->fileExtension = strtolower(end($tmpExt));

        if ($file['error'] == UPLOAD_ERR_OK) {
            if (in_array($this->fileExtension, $this->acceptedExt)) {
                if ($file['size'] < $this->size) {
                    $newFileName = uniqid('', true) . '.' . $this->fileExtension;
                    $newFilePath = $this->filePath . $newFileName;
                    move_uploaded_file($this->fileTmp, $newFilePath);
                    $stmt = $this->connection->prepare($sql);
                    $stmt->bindParam(":url", $newFilePath);
                    $stmt->bindParam(":id", $id);
                    $stmt->execute();
                } else {
                    throw new Exception('file too big');
                }
            } else {
                throw new Exception('unsupported file type, upload only jpeg, png and jpg files');
            }
        } else {
            throw new Exception('Error uploading the file');
        }
    }

    /**
     * Fetch the picture reference from the database 
     * 
     * @param JobSeeker|Company $user he user object for whom to fetch the picture reference form the database
     * 
     * @throws InvalidArgumentException If an invalid user type is provided
     * 
     * @return string
     */
    public function fetchPicture(JobSeeker|Company $user): string
    {
        if ($user instanceof JobSeeker) {
            $sql = "SELECT profile_picture_url FROM job_seeker WHERE job_seeker_id= :id";
            $id = $user->getId();
            $key = 'profile_picture_url';
        } else if ($user instanceof Company) {
            $sql = "SELECT company_logo_url FROM company WHERE company_id= :id";
            $id = $user->getId();
            $key = 'company_logo_url';
        } else {
            throw new InvalidArgumentException('Invalid user type provided');
        }

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->filePath = $result[$key];

        return $this->filePath;
    }

    /**
     * A destructor method to close the database connection when the object is destroyed
     * @return void
     */
    public function __destruct()
    {
        $this->db->close();
    }
}
