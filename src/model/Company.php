<?php

require_once dirname(__DIR__) . '/core/DataBase.php';

class Company
{
    private string $companyName;
    private string $website;
    private DateTime $foundedDate;
    private string$email;
    private string $recoveryEmail;
    private string $password;
    private string $country;
    private string $phoneNumber;
    private ?string $address;
    private string $company_logo_url;
    private ?int $postalCode;
    private ?string $city;
    private ?string $description;
    private PDO $connection;
    private DataBase $db;

    public function __construct(int $id) {
        $this->id = $id;
        $this->db = new DataBase();
        $this->connection = $this->db->getConnection();
    }
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    public function setWebsite($website)
    {
        $this->website = $website;
    }

    public function setFoundedDate($foundedDate)
    {
        $this->foundedDate = $foundedDate;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setRecoveryEmail($recoveryEmail)
    {
        $this->recoveryEmail = $recoveryEmail;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getCompanyName()
    {
        return $this->companyName;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getRecoveryEmail()
    {
        return $this->recoveryEmail;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function getFoundedDate()
    {
        return $this->foundedDate;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }


    public function getAddress()
    {
        return $this->address;
    }

    public function getUrl() {
        return $this->company_logo_url;
    }

    public function getCity():string|null {
        return $this->city;
    }

    public function getDescription():string|null {
        return $this->description;
    }

    public function getPostalCode():int|null {
        return $this->postalCode;
    }

    public function updateProfile(array $data) {
        $this->companyName = $data['company-name'];
        $this->email = $data['email'];
        $this->website = $data['website'];
        
        $dateObj = DateTime::createFromFormat('Y-m-d', $data['founded-date']);
        if ($dateObj === false) {
            throw new Exception('enter the date in appropriate format');
        } else {
            $this->foundedDate = $dateObj;
        }

        $this->phoneNumber = $data['phone-number'];
        $this->country = $data['country'];
        $this->postalCode = $data['postcode'];
        $this->city = $data['city'];
        $this->address = $data['address'];
        $this->description = $data['description'];


        $sql = "UPDATE company SET company_name = :companyName, website = :website, founded_date = :foundedDate, 
        email = :email, phone_number = :phoneNumber, country = :country, address = :address, city = :city, postcode = :postcode, description = :description";

        try {
            $stmt = $this->connection->prepare($sql);

            $stmt->bindParam(":companyName",  $this->companyName);
            $stmt->bindParam(":website", $this->website);
            $date = $this->foundedDate->format('Y-m-d');
            $stmt->bindParam(":foundedDate", $date);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":phoneNumber", $this->phoneNumber);
            $stmt->bindParam(":country", $this->country);
            $stmt->bindParam(":address", $this->address);
            $stmt->bindParam(":city", $this->city);
            $stmt->bindParam(":postcode", $this->postalCode);
            $stmt->bindParam(":description", $this->description);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "can't update profile" . $e->getMessage();
        }
    }

    public function fetchProfile():void {
        $sql = "SELECT company_name, website, founded_date, email, phone_number, country, address, city,
        postcode, description FROM company WHERE company_id = :id";

        try {
            $stmt = $this->connection->prepare($sql);

            $stmt->bindParam(":id", $this->id);

            $stmt->execute();

            $profile = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->companyName = $profile['company_name'];
                $this->website = $profile['website'];
                $this->foundedDate = DateTime::createFromFormat('Y-m-d', $profile['founded_date']);
                $this->email = $profile['email'];
                $this->phoneNumber = $profile['phone_number'];
                $this->country = $profile['country'];
                $this->address = $profile['address'];
                $this->city = $profile['city'];
                $this->postalCode = $profile['postcode'];
                $this->description = $profile['description'];
        } catch (PDOException $e) {
            echo "can't fetch profile " . $e->getMessage();
        }
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
