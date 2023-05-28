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

    public function __construct() {
        $this->db = new DataBase();
        $this->connection = $this->db->getConnection();
    }

    public function setId(int $id):void {
        $this->id = $id;
    }

    public function getId():int {
        return $this->id;
    }
    public function setDegreeType(string $degreeType):void {
        $this->degreeType = $degreeType;
    }

    public function getDegreeType():string {
        return $this->degreeType;
    }

    public function setField(string $field):void {
        $this->field = $field;
    }

    public function getField():string {
        return $this->field;
    }

    public function setInstitute(string $institute):void {
        $this->institute = $institute;
    }

    public function getInstitute():string {
        return $this->institute;
    }

    public function setEnrolledDate(string $enrolledDate):void {
        $this->enrolledDate = $enrolledDate;
    }

    public function getEnrolledDate():string {
        return $this->enrolledDate;
    }

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