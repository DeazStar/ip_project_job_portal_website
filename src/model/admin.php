<?php
require_once "../core/DataBase.php";
require_once "../model/PersonalInfo.php";
require_once "../model/company.php";
session_start();
class Admin {
    private PDO $pdo;

    public function __construct(){
        $database = new DataBase();
        $this->pdo = $database->getConnection();
    
    }



    /**
     * Checks whether an email is already used by another user.
     *
     * @param string $email The email input from the user.
     *
     * @return bool Returns True if the email exists, else False.
     *
     * @link admin.php function to check email
     */
    public function emailExists($email) {
        
        // CHECK IF EMAIL EXISTS IN USER TABLE
        $sql = "SELECT COUNT(*) FROM job_seeker WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute(array(
            ':email' => $email
        )); 
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return True;
        }

        //CHECK IF EMAIL EXISTS IN COMPANY TABLE
        $sql = "SELECT COUNT(*) FROM company WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute(array(
            ':email' => $email
        )); 
        $count = $stmt->fetchColumn();
        
        if ($count > 0) {
            return True;
        }

        return False;
    }

    
    /**
     * Saves user data to the database.
     *
     * @param PersonalInfo $user The personalInfo object to save. The object should include the following properties:
     *                   - firstName: The user's first name.
     *                   - lastName: The user's last name.
     *                   - email: The user's email address.
     *                   - password: The user's password (hashed).
     *                   - country: The user's country of residence.
     *                   - gender: The user's gender.
     *                   - phoneNumber: The user's phone number.
     *                   - companyName: The user's company name.
     *                   - tradeRole: The user's trade role.
     *
     * @return bool Returns True if the user is added to the database, else False.
     *
     * @link #save
     */
    public function saveUser(array $user) {
       
        $sql = "INSERT INTO job_seeker 
                    (first_name, last_name, email , date_of_birth, password, country, gender, phone_number, recovery_email 
                    , professional_title , postcode , city , address ) 
                VALUES 
                    (:firstName, :lastName, :email, :date_of_birth , :password, :country, :gender, :phoneNumber , :recovery_email,
                     :professional_title , :postcode , :city , :address)";
        $stmt = $this->pdo->prepare($sql);
        
        $result = $stmt->execute(array(
            ':firstName' => $user['firstName'],
            ':lastName' => $user['lastName'],
            ':email' => $user['email'],
            ':password' => md5($user['password']),
            ':date_of_birth' =>$user['dateOfBirth'],
            ':country' => $user['country'],
            ':gender' => $user['gender'],
            ':phoneNumber' => $user['phoneNumber'],
            ':recovery_email' => $user['recoveryEmail'],
            ':professional_title' =>$user['professional_title'],
            ':postcode' =>$user['postcode'],
            ':city' => $user['city'],
            ':address' => $user['address']

        ));
        
        if ($result) {
            return True;
        }
        return False;
    }
    /**
     * Saves user data to the database.
     *
     * @param array $company array containing data of company to save.
     * @return bool Returns True if the user is added to the database, else False.
     *
     * @link #saveCompany
     */
    public function saveCompany(array $company) {
       
        $sql = "INSERT INTO company 
                (company_name, website, founded_date ,email , recovery_email, password, phone_number ,country, address , postcode) 
                VALUES 
                (:companyName, :website , :foundedDate , :email,  :recovery_email , :password , :phoneNumber , :country ,  :address , :postcode)";
        
        $stmt = $this->pdo->prepare($sql);
        
        $result = $stmt->execute(array(
            ':companyName' => $company['companyName'],
            ':website' => $company['website'],
            'foundedDate' => $company['foundedDate'],
            ':email' => $company['email'],
            ':password' =>md5($company['password']),
            ':country' => $company['country'],
            ':recovery_email' => $company['recoveryEmail'],
            ':phoneNumber' => $company['phoneNumber'],
            ':address' => $company['address'],
            ':postcode' => $company['postcode']
        ));
        
        if ($result) {
            return True;
        }
        return False;
    }

    /**
     * getUser -> search a user from the database return the ID if found
     *
     * @param string $email
     * @param string $password
     * @return array
     */
    public function getUser($email , $password){
        $stmt = $this->pdo->prepare("SELECT * FROM job_seeker WHERE email = :email and password = :password" );
        $stmt->execute(array(
            ':email'=>$email,
            ':password'=>md5($password)
        ));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            
            
            $_SESSION['id'] = $user['id'];
            $_SESSION['user_type'] = "JOB_SEEKER";
            return True;

        }
        else{
            return False;
        }
    }

    /**
     * getCompany -> search a company from the database return the ID if found
     *
     * @param string $email
     * @param string $password
     * @return array
     */
    public function getCompany($email , $password){
        $stmt = $this->pdo->prepare("SELECT * FROM company WHERE email = :email and password = :password" );
        
        $stmt->execute(array(
            ':email'=>$email,
            ':password'=>md5($password)
        ));
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            
            
            $_SESSION['id'] = $user['id'];
            $_SESSION['user_type'] = "COMPANY";
            return True;
        }
        else{
            return False;
        }
    }
}
?>