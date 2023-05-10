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
    public function __construct() {
        $this->db = new DataBase();
    }

    // Getter methods
    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function getProfessionalTitle(): string {
        return $this->professionalTitle;
    }

    public function getLanguage(): array {
        return $this->language;
    }

    public function getDate(): DateTime {
        return $this->date;
    }

    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getCountry(): string {
        return $this->country;
    }

    public function getPostCode(): int {
        return $this->postCode;
    }

    public function getCity(): string {
        return $this->city;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getDescription(): string {
        return $this->description;
    }

    // Setter methods
    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void {
        $this->lastName = $lastName;
    }

    public function setProfessionalTitle(string $professionalTitle): void {
        $this->professionalTitle = $professionalTitle;
    }

    public function setLanguage(array $language): void {
        $this->language = $language;
    }

    public function setDate(DateTime $date): void {
        $this->date = $date;
    }

    public function setPhoneNumber(string $phoneNumber): void {
        $this->phoneNumber = $phoneNumber;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setCountry(string $country): void {
        $this->country = $country;
    }

    public function setPostCode(int $postCode): void {
        $this->postCode = $postCode;
    }

    public function setCity(string $city): void {
        $this->city = $city;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setFromArray(array $data) {
        $name = explode(' ', $data['fullname']);
        $this->firstName = $name[0];
        $this->lastName = $name[1];
        $this->professionalTitle = $data['title'];
        $this->language = $data['language'];
        $this->date = $data['birth_date'];
        $this->phoneNumber = $data['phone_number'];
        $this->email = $data['email'];
        $this->country = $data['country'];
        $this->postCode = $data['postcode'];
        $this->city = $data['city'];
        $this->address = $data['address'];
        $this->description = $data['description'];
    }

    public function updatePersonalInfo() {

    }

    public function __destruct() {
        $this->db->close();
    }
}
