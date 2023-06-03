<?php



class Company
{
    private $companyName;
    private $website;
    private $foundedDate;
    private $email;
    private $recoveryEmail;
    private $password;
    private $country;
    private $phoneNumber;
    private $address;

    private $company_logo_url;

    private $postalCode;
    private $city;

    private $description;

    public function __construct(int $id) {
        $this->id = $id;
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
}
