<?php

require_once dirname(__DIR__) . '/core/DataBase.php';
class PersonalInfo
{
    private string $firstName;
    private string $lastName;
    private string $professionalTitle;
    private array $language;
    private DateTime $date;
    private string $phoneNumber;
    private string $email;
    private string $country;
    private int $postCode;
    private string $city;
    private string $address;
    private string $description;

    private DataBase $db;
    private PDO $connection;

    /**
     * PersonalInfo construct 
     * 
     * Create a new instance of the PersonalInfo class.
     */
    public function __construct()
    {
        $this->db = new DataBase();
        $this->connection = $this->db->getConnection();
    }


    /**
     * getter Method for firstName
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * getter Method for lastName
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * getter Method for professionalTitle
     */
    public function getProfessionalTitle(): string
    {
        return $this->professionalTitle;
    }

    /**
     * getter Method for date
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * getter Method for phoneNumber
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * getter Method for email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * getter Method for country
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * getter Method for postcode
     */
    public function getPostCode(): int
    {
        return $this->postCode;
    }

    /**
     * getter Method for city
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * getter Method for address
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * getter Method for description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * setter method for firstName
     * 
     * @param string $firstName 
     */
    // Setter methods
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * setter method for firstName
     * 
     * @param string $lastName 
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }


    /**
     * setter method for firstName
     * 
     * @param string $professionalTitle 
     */
    public function setProfessionalTitle(string $professionalTitle): void
    {
        $this->professionalTitle = $professionalTitle;
    }


    /**
     * setter method for firstName
     * 
     * @param DateTime $date 
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * setter method for firstName
     * 
     * @param string $phoneNumber 
     */
    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }


    /**
     * setter method for firstName
     * 
     * @param string $email 
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    /**
     * setter method for firstName
     * 
     * @param string $country 
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }


    /**
     * setter method for firstName
     * 
     * @param string $postcode 
     */
    public function setPostCode(int $postCode): void
    {
        $this->postCode = $postCode;
    }


    /**
     * setter method for firstName
     * 
     * @param string $city 
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }


    /**
     * setter method for firstName
     * 
     * @param string $address 
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }


    /**
     * setter method for firstName
     * 
     * @param string $description 
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * setFromArray: set the attribute from the form data
     * 
     * @param array $data
     * 
     * @throws Exception if the input date is not in the appropriate format 
     * @throws Exception if the postcode is not numeric 
     * 
     * @return void
     */
    public function setFromArray(array $data): void
    {
        $name = explode(' ', $data['fullname']);
        $this->firstName = $this->validateInput($name[0]);
        $this->lastName = $this->validateInput($name[1]);
        $this->professionalTitle = $this->validateInput($data['professional-title']);
        $dateObj = DateTime::createFromFormat('Y-m-d', $data['birth-date']);
        if ($dateObj === false) {
            throw new Exception('enter the date in appropriate format');
        } else {
            $this->date = $dateObj;
        }
        $this->phoneNumber = $this->validateInput($data['phone-number']);
        $this->email = filter_var($this->validateInput($data['email']), FILTER_VALIDATE_EMAIL);
        $this->country = $this->validateInput($data['country']);
        $this->postCode = intVal($this->validateInput($data['postcode']));

        if ($this->postCode === 0) {
            throw new Exception("Invalid PostCode");
        }

        $this->city = $this->validateInput($data['city']);
        $this->address = $this->validateInput($data['address']);
        $this->description = $this->validateInput($data['description']);
    }

    /**
     * validateInput: validate the data using htmlspecialchars() function
     * 
     * @param mixed $data: the data to be validated
     * 
     * @return string
     */
    public function validateInput(mixed $data)
    {
        return htmlspecialchars($data);
    }

    /**
     * updatePersonalInfo: update the database with the new personal information
     * 
     * @param int $id the id of the job seeker
     * @throws PDOException when it fails to update the database
     * 
     * @return void
     */
    public function updatePersonalInfo(int $id)
    {
        $sql = "UPDATE job_seeker SET first_name = :first_name, last_name = :last_name, professional_title = :professional_title,
        date_of_birth = :date_of_birth, email = :email, country = :country, postcode = :postcode, city = :city, address = :address, description =:description WHERE job_seeker_id = :job_seeker_id";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":first_name", $this->firstName);
            $stmt->bindParam(":last_name", $this->lastName);
            $stmt->bindParam(":professional_title", $this->professionalTitle);
            $birthDate = $this->date->format('Y-m-d');
            $stmt->bindParam(":date_of_birth", $birthDate);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":country", $this->country);
            $stmt->bindParam(":postcode", $this->postCode);
            $stmt->bindParam(":city", $this->city);
            $stmt->bindParam(":address", $this->address);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":job_seeker_id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "can't update database" . $e->getMessage();
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
