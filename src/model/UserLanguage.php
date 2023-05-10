<?php 

require_once '../core/DataBase.php';
declare(strict_types=1);

class UserLanguage {
    private DataBase $db;
    private PDO $connection;

    public function __construct() {
        $this->db = new DataBase();
        $this->connection = $this->db->getConnection();
    }

    public function addLanguage(int $user_id, string $language) {
        $languageId = null;
        $userLanguageId = null;
        $checkLanguage = "SELECT language_id FROM language WHERE language = :language";

        try {
            $stmtThree = $this->connection->prepare($checkLanguage);
            $stmtThree->bindParam(":language", $language);
            $stmtThree->execute();

            $languageId = $stmtThree->fetch(PDO::FETCH_ASSOC);
            $languageId = $languageId['language_id'];
        } catch(PDOException $e) {
            echo "can't check the language in the database" . $e->getMessage();
        }

        if (!isset($language)) {
            $addLanguage = "INSERT INTO language(language) VALUES(:language)";
            try {
                $stmt = $this->connection->prepare($addLanguage);
                $stmt->bindParam(":language", $language);
                $stmt->execute();
                $lastInsertedId = $this->connection->lastInsertId();
            } catch(PDOException $e) {
                echo "can't execute query" . $e->getMessage();
            }
            
            $linkTable = "INSERT INTO user_language(job_seeker_id, language_id) VALUES(:job_seeker_id, :language_id)";

            try {
                $stmtTwo = $this->connection->prepare($linkTable);
                $stmtTwo->bindParam(":job_seeker_id", $user_id);
                $stmtTwo->bindParam(":language_id", $lastInsertedId);
                $stmtTwo->execute();
            } catch (PDOException $ex) {
                echo "can't link tables" . $e->getMessage();
            }
        } else {
            $checkUser = "SELECT language_id FROM user_language WHERE job_seeker_id= :job_seeker_id";

            try {
                $stmtFour = $this->connection->prepare($checkUser);
                $stmtFour->bindParam(":job_seeker_id", $user_id);
                $stmtFour->execute();
                $userLanguageId = $stmtFour->fetch(PDO::FETCH_ASSOC);
                $userLanguageId = $userLanguageId['language_id'];
            } catch(PDOException $e) {
                "can not check if the user already stored the data" . $e->getMessage();
            }

            if (!isset($userLanguageId)) {
               // DO SOMETHING
            }
        }

    }

    public function __destruct() {
        $this->db->close();
    }
}