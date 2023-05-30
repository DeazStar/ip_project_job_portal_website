<?php 

require_once dirname(__DIR__) . '/core/DataBase.php';

class Education {
    private int $id;
    private string $degreeType;
    private string $field;
    private string $institute;
    private string $enrolledDate;
    private string $graduatedDate;
    private PDO $connection;
    private DataBase $db;

    /**
     * EducationModel Constructor 
     * 
     * Creates a new instance of EducationModel class
     */
    public function __construct() {
        $this->db = new DataBase();
        $this->connection = $this->db->getConnection();
    }

    /**
     * setter method for the id
     * 
     * @param int $id
     * 
     * @return void
     */
    public function setId(int $id):void {
        $this->id = $id;
    }

    /**
     * getter method for the id
     * 
     * @return int
     */
    public function getId():int {
        return $this->id;
    }

    /**
     * setter method for the degree type like degree, masters ...
     * 
     * @param string $degreeType 
     * 
     * @return void
     */
    public function setDegreeType(string $degreeType):void {
        $this->degreeType = $degreeType;
    }

    /**
     * getter method for the degree type
     * 
     * @return string
     */
    public function getDegreeType():string {
        return $this->degreeType;
    }

    /**
     * setter method for the field like computer science, ....
     * 
     * @param string $field
     * 
     * @return void
     */
    public function setField(string $field):void {
        $this->field = $field;
    }

    /**
     * getter method for the field 
     * 
     * @return string
     */
    public function getField():string {
        return $this->field;
    }

    /**
     * setter method for the institute
     * 
     * @param string $institute
     * 
     * @return void
     */
    public function setInstitute(string $institute):void {
        $this->institute = $institute;
    }

    /**
     * getter method for the institute
     * 
     * @return string
     */
    public function getInstitute():string {
        return $this->institute;
    }

    /**
     * setter method for the enrolled date
     * 
     * @param string $enrolledDate
     */
    public function setEnrolledDate(string $enrolledDate):void {
        $this->enrolledDate = $enrolledDate;
    }

    /**
     * getter method for the enrolled date
     * 
     * @return string
     */
    public function getEnrolledDate():string {
        return $this->enrolledDate;
    }

    /**
     * setter method for graduated date
     * 
     * @param string $graduatedDate
     * 
     * @return void
     */
    public function setGraduatedDate(string $graduatedDate):void {
        $this->graduatedDate = $graduatedDate;
    }

    public function getGraduatedDate():string {
        return $this->graduatedDate;
    }


    public function saveEducation(int $userId):void {
        $saveSql = "INSERT INTO education(degree_type, field, institute, enrolled_date, graduated_date) 
        VALUES(:degreeType, :field, :institute, :enrolledDate, :graduatedDate);";

        $mapSql = "INSERT INTO user_education(job_seeker_id, education_id) VALUE(:userId, :educationId)";

        try {
            $stmt = $this->connection->prepare($saveSql);
            $stmt->bindParam(":degreeType", $this->degreeType);
            $stmt->bindParam(":field", $this->field);
            $stmt->bindParam(":institute", $this->institute);
            $stmt->bindParam(":enrolledDate", $this->enrolledDate);
            $stmt->bindParam(":graduatedDate", $this->graduatedDate);

            $stmt->execute();

            $educationId = $this->connection->lastInsertId();

            $stmtTwo = $this->connection->prepare($mapSql);
            $stmtTwo->bindParam(":userId", $userId);
            $stmtTwo->bindParam(":educationId", $educationId);

            $stmtTwo->execute();

        } catch (PDOException $e) {
            echo "can't insert data" . $e->getMessage();
        }
    }

    public function retrieveEducation(int $userId): array {
        $sqlOne = "SELECT education_id FROM user_education WHERE job_seeker_id=:userId;";
        $sqlTwo = "SELECT * FROM education WHERE 
        education_id = :educationId";

        $educationArray = [];
        $educationId = [];

        try {
            $stmt = $this->connection->prepare($sqlOne);
            $stmt->bindParam(":userId", $userId);

            $stmt->execute();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $educationId[] = $result['education_id'];
            }

            foreach($educationId as $id) {
                $stmtTwo = $this->connection->prepare($sqlTwo);
                $stmtTwo->bindParam(":educationId", $id);
    
                $stmtTwo->execute();
    
                while (($row = $stmtTwo->fetch(PDO::FETCH_ASSOC))) {
                    $educationArray[] = $row;
                }
            }

        } catch (PDOException $e) {
            echo "Can't fetch data" . $e->getMessage();
        }

        return $educationArray;
    }

    public function removeEducation(int $userId, int $educationId): void {
        $sqlOne = "DELETE FROM user_education WHERE job_seeker_id= :userId AND education_id = :educationId";
        $sqlTwo = "DELETE FROM education WHERE education_id = :educationId";

        try {
            $stmtOne = $this->connection->prepare($sqlOne);
            $stmtOne->bindParam(":userId", $userId);
            $stmtOne->bindParam(":educationId", $educationId);

            $stmtOne->execute();

            $stmtTwo = $this->connection->prepare($sqlTwo);
            $stmtTwo->bindParam(":educationId", $educationId);

            $stmtTwo->execute();
        } catch (PDOException $e) {
            echo "Can't delete from database " . $e->getMessage();
        }
    }

    public function updateEducation(int $userId, int $educationId) {
        $sqlUpdate = "UPDATE education SET degree_type = :degreeType, field = :field, institute = :institute, 
        enrolled_date = :enrolledDate, graduated_date = :graduatedDate WHERE education_id = :educationId";

        try {
            $stmt = $this->connection->prepare($sqlUpdate);
            $stmt->bindParam(":degreeType", $this->degreeType);
            $stmt->bindParam(":field", $this->field);
            $stmt->bindParam(":institute", $this->institute);
            $stmt->bindParam(":enrolledDate", $this->enrolledDate);
            $stmt->bindParam(":graduatedDate", $this->graduatedDate);
            $stmt->bindParam(":educationId", $this->id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "Can't update data" . $e->getMessage();
        }
    }

}