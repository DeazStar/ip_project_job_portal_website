<?php

    class User {
        private $firstName;
        private $lastName;
        private $email;
        private $recoveryEmail;
        private $password;
        private $country;
        private $gender;
        private $dateOfBirth;
        private $phoneNumber;
        private $professionalTitle;
        private $postcode;
        private $city;
        private $address;

        public function __construct($firstName, $lastName , $email , $password, $country, $gender , $dateOfBirth , 
                                    $phoneNumber ,$recoveryEmail ,  $professionalTitle , $postcode , $city , $address  ) {
            
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->recoveryEmail = $recoveryEmail;
            $this->password = $password;
            $this->country = $country;
            $this->gender = $gender;   
            $this->dateOfBirth = $dateOfBirth;   
            $this->phoneNumber = $phoneNumber;
            $this->city = $city;
            $this->postcode = $postcode;
            $this->professionalTitle = $professionalTitle;
            $this->address = $address;
        }

        public function setFirstName($firstName) {
            $this->firstName = $firstName;
        }

        public function setLastName($lastName) {
             $this->lastName = $lastName;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setRecoveryEmail($recoveryemail) {
            $this->email = $email;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        public function setCountry($country) {
            $this->country = $country;
        }

        public function setGender($gender) {
            $this->gender = $gender;
        }

        public function setDateOfBirth($dateOfBirth) {
            $this->dateOfBirth = $dateOfBirth;
        }

        public function setPhoneNumber($phoneNumber) {
            $this->getPhoneNumber = $phoneNumber;
        }

        public function setCompanyName($companyName){
            $this->companyName = $companyName;
        }

        public function setProfessionalTitle($professionalTitle) {
            $this->professionalTitle = $professionalTitle;
        }

        public function setPostcode($postcode) {
            $this->postcode = $postcode;
        }

        public function setCity($city) {
            $this->city = $city;
        }

        public function setAddress($address) {
            $this->address = $address;
        }

        public function getFirstName() {
            return $this->firstName;
        }

        public function getLastName() {
            return $this->lastName;
        }
        public function getEmail() {
            return $this->email;
        }
        public function getRecoveryEmail() {
            return $this->recoveryEmail;
        }

        public function getPassword() {
            return $this->password;
        }

        public function getCountry() {
            return $this->country;
        }

        public function getGender() {
            return $this->gender;
        }

        public function getDateOfBirth() {
            return $this->dateOfBirth;
        }

        public function getPhoneNumber() {
            return $this->phoneNumber;
        }

        public function getProfessionTitle() {
            return $this->professionalTitle;
        }

        public function getPostcode() {
            return $this->postcode;
        }

        public function getCity() {
            return $this->city;
        }

        public function getAddress() {
            return $this->address;
        }

    }

?>