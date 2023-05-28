<?php 

require_once dirname(__DIR__) . '/core/DataBase.php';

class Employment {
    private int $id;
    private string $position;
    private string $company;
    private string $startedDate;
    private string $dateLeft;
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
    public function setPosition(string $position):void {
        $this->position = $position;
    }

    public function getPosition():string {
        return $this->position;
    }

    public function setCompany(string $company):void {
        $this->company = $company;
    }

    public function getCompany():string {
        return $this->company;
    }

    public function setStartedDate(string $startedDate):void {
        $this->startedDate = $startedDate;
    }

    public function getStartedDate():string {
        return $this->startedDate;
    }

    public function setDateLeft(string $dateLeft):void {
        $this->dateLeft = $dateLeft;
    }

    public function getDateLeft():string {
        return $this->dateLeft;
    }


    public function saveEmployment(int $userId):void {
        $saveSql = "INSERT INTO employment(position, company, started_date, date_left) 
        VALUES(:position, :company, :startedDate, :dateLeft);";

        $mapSql = "INSERT INTO user_employment(job_seeker_id, employment_id) VALUE(:userId, :employmentId)";

        try {
            $stmt = $this->connection->prepare($saveSql);
            $stmt->bindParam(":position", $this->position);
            $stmt->bindParam(":company", $this->company);
            $stmt->bindParam(":startedDate", $this->startedDate);
            $stmt->bindParam(":dateLeft", $this->dateLeft);

            $stmt->execute();

            $employmentId = $this->connection->lastInsertId();

            $stmtTwo = $this->connection->prepare($mapSql);
            $stmtTwo->bindParam(":userId", $userId);
            $stmtTwo->bindParam(":employmentId", $employmentId);

            $stmtTwo->execute();

        } catch (PDOException $e) {
            echo "can't insert data" . $e->getMessage();
        }
    }

    public function retrieveEmployment(int $userId): array {
        $sqlOne = "SELECT employment_id FROM user_employment WHERE job_seeker_id=:userId;";
        $sqlTwo = "SELECT * FROM employment WHERE 
        employment_id = :employmentId";

        $employmentArray = [];
        $employmentId = [];

        try {
            $stmt = $this->connection->prepare($sqlOne);
            $stmt->bindParam(":userId", $userId);

            $stmt->execute();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $employmentId[] = $result['employment_id'];
            }

            foreach($employmentId as $id) {
                $stmtTwo = $this->connection->prepare($sqlTwo);
                $stmtTwo->bindParam(":employmentId", $id);
    
                $stmtTwo->execute();
    
                while (($row = $stmtTwo->fetch(PDO::FETCH_ASSOC))) {
                    $employmentArray[] = $row;
                }
            }

        } catch (PDOException $e) {
            echo "Can't fetch data" . $e->getMessage();
        }

        return $employmentArray;
    }

    public function removeEmployment(int $userId, int $educationId): void {
        $sqlOne = "DELETE FROM user_employment WHERE job_seeker_id= :userId AND employment_id = :employmentId";
        $sqlTwo = "DELETE FROM employment WHERE employment_id = :employmentId";

        try {
            $stmtOne = $this->connection->prepare($sqlOne);
            $stmtOne->bindParam(":userId", $userId);
            $stmtOne->bindParam(":employmentId", $educationId);

            $stmtOne->execute();

            $stmtTwo = $this->connection->prepare($sqlTwo);
            $stmtTwo->bindParam(":employmentId", $educationId);

            $stmtTwo->execute();
        } catch (PDOException $e) {
            echo "Can't delete from database " . $e->getMessage();
        }
    }

    public function updateEmployment(int $userId, int $educationId) {
        $sqlUpdate = "UPDATE employment SET position = :position, company = :company, started_date = :startedDate, 
        date_left=:dateLeft WHERE employment_id = :employmentId";

        try {
            $stmt = $this->connection->prepare($sqlUpdate);
            $stmt->bindParam(":position", $this->position);
            $stmt->bindParam(":company", $this->company);
            $stmt->bindParam(":startedDate", $this->startedDate);
            $stmt->bindParam(":dateLeft", $this->dateLeft);
            $stmt->bindParam(":employmentId", $this->id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "Can't update data" . $e->getMessage();
        }
    }

}