<?php
require_once "../core/DataBase.php";
require_once "../model/person.php";
require_once "../model/company.php";

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
        $sql = "SELECT COUNT(*) FROM user WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute(array(
            ':email' => $email
        )); 
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return True;
        }

        //CHECK IF EMAIL EXISTS IN COMPANY TABLE
        $sql = "SELECT COUNT(*) FROM user WHERE email = :email";
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
     * @param User $user The User object to save. The object should include the following properties:
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
    public function saveUser(User $user) {
       
        $sql = "INSERT INTO user 
                    (firstName, lastName, email , password, country, gender, phoneNumber, recovery_email 
                    , professional_title , postcode , city , address ) 
                VALUES 
                    (:firstName, :lastName, :email, :password, :country, :gender, :phoneNumber , :recovery_email,
                     :professional_title , :postcode , :city , :address)";
        $stmt = $this->pdo->prepare($sql);
        
        $result = $stmt->execute(array(
            
            ':firstName' => $user->getFirstName(),
            ':lastName' => $user->getLastName(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':country' => $user->getCountry(),
            ':gender' => $user->getGender(),
            ':phoneNumber' => $user->getPhoneNumber(),
            ':recovery_email' => $user->getRecoveryEmail(),
            ':professional_title' =>$user->getProfessionTitle(),
            ':postcode' =>$user->getPostcode(),
            ':city' => $user->getCity(),
            ':address' => $user->getAddress()

        ));
        
        if ($result) {
            return True;
        }
        return False;
    }
    /**
     * Saves user data to the database.
     *
     * @param Company $company The company object to save.
     * @return bool Returns True if the user is added to the database, else False.
     *
     * @link #saveCompany
     */
    public function saveCompany(Company $company) {
       
        $sql = "INSERT INTO company 
                (company_name, website, founded_date ,email , recovery_email, password, phone_number ,country, address ) 
                VALUES 
                (:companyName, :website , :foundedDate , :email,  :recovery_email , :password , :phoneNumber , :country ,  :address)";
        
        $stmt = $this->pdo->prepare($sql);
        
        $result = $stmt->execute(array(
            ':companyName' => $company->getCompanyName(),
            ':website' => $company->getWebsite(),
            'foundedDate' => $company->getFoundedDate(),
            ':email' => $company->getEmail(),
            ':password' => $company->getPassword(),
            ':country' => $company->getCountry(),
            ':recovery_email' => $company->getRecoveryEmail(),
            ':phoneNumber' => $company->getPhoneNumber(),
            ':address' => $company->getAddress()
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
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = :email and password = :password" );
        $stmt->execute(array(
            ':email'=>$email,
            ':password'=>md5($password)
        ));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            
            
            $_SESSION['id'] = $user['id'];
            $_SESSION['user'] = "YES";
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
            $_SESSION['user'] = "NO";
            return True;
        }
        else{
            return False;
        }
    }
}
?>