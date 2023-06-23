<?php 

require_once 'PersonalInfo.php';
require_once 'Resume.php';

class JobSeeker {
    private int $id;
    private PersonalInfo $personalInfo;
    private Resume $resume;
    private ?string $profileUrl = null;

    /**
     * jobSeeker construct 
     * 
     * Create a new instance of the jobSeeker class.
     */
    public function __construct(int $id){
        $this->id = $id;
        $this->personalInfo = new PersonalInfo();
        $this->resume = new Resume();
    }

    /**
     * getter method for the jobSeeker id
     * 
     */
    public function getId():int {
        return $this->id;
    }

    /**
     * setter method for the jobSeeker id
     * 
     * @param int $id
     */
    public function setId(int $id):void {
        $this->id =$id;
    }

    /**
     * getter method for the personalInfo object
     * 
     * @return PersonalInfo
     */
    public function getPersonalInfo():PersonalInfo {
        return  $this->personalInfo;
    }

    /**
     * getter method for the Resume object
     * 
     * @return Resume
     */
    public function getResume():Resume {
        return $this->resume;
    }

    public function setProfileUrl(?string $profileUrl):void {
        if (isset($profileUrl)) {
            $this->profileUrl = $profileUrl;
        }
    }

    public function getProfileUrl():string|null {
        return $this->profileUrl;
    }

    /**
     * updateProfile: update personal information of the job seeker
     * 
     * @param array $data: the $_POST data
     * 
     * @return void
     */
    public function updateProfile(array $data):void {
        $this->personalInfo->setFromArray($data);
        $this->personalInfo->updatePersonalInfo($this->id);
    }

    /**
     * fetchProfile: retrieve the personal information from the database
     * 
     * @return void
     */
    public function fetchProfile():void {
        $this->personalInfo->fetchPersonalInfo($this->id);
    }   

    /**
     * saveLanguage a method to save the language in the database using method saveLanguage specified
     * in the Resume class
     * 
     * @param array $language
     * 
     * @return void
     */
    public function saveLanguage(array $language):void {
        $this->resume->addLanguage($this->id, $language);
    }

    /**
     * removeLanguage a method to delete a language from the database using the method deleteLanguage 
     * specified in the Resume class
     * 
     * @param int $languageId 
     * 
     * @return void
     */
    public function removeLanguage(int $languageId): void {
        $this->resume->deleteLanguage($this->id, $languageId);
    }

    /**
     * fetchLanguage a method to retrieve language from the database using fetchLanguage specified 
     * in the Resume class
     * 
     * @return void
     */
    public function fetchLanguage():void {
        $this->resume->fetchLanguage($this->id);
    }


    /**
     * uploadResume: upload resume file using the saveResume method from Resume class
     * 
     * @param array $data
     * 
     * @return void
     */
    public function uploadResume(array $data):void {
        $this->resume->saveResume($this->id, $data);
    }

    /**
     * fetchResume: retrieve the resume file path using fetchResumeUrl method from Resume class
     * 
     * @return void
     */
    public function fetchResume():void {
        $this->resume->fetchResumeUrl($this->id);
    }

    public function saveSkill(array $skill):void {
        $this->resume->addSkill($this->id, $skill);
    }

    public function fetchSKill():void {
        $this->resume->fetchSkill($this->id);
    }

    public function removeSkill(int $skillId): void {
        $this->resume->deleteSkill($this->id, $skillId);
    }

    public function saveEducation(string $degreeType, string $field, 
    string $institute, string $enrolledDate, string $graduatedDate) {
        $this->resume->addEducation($this->id, $degreeType, $field, $institute, $enrolledDate, $graduatedDate);
    }

    public function saveEmployment(string $position, string $company, 
    string $startedDate, string $dateLeft) {
        $this->resume->addEmployment($this->id, $position, $company, $startedDate, $dateLeft);
    }

    public function fetchEducation():array {
        return $this->resume->fetchEducation($this->id);
    }

    public function fetchEmployment():array {
        return $this->resume->fetchEmployment($this->id);
    }

    public function removeEducation(int $educationId) {
        $this->resume->deleteEducation($this->id, $educationId);
    }

    public function removeEmployment(int $employmentId) {
        $this->resume->deleteEmployment($this->id, $employmentId);
    }

    public function updateEducation(int $educationId, string $degreeType, string $field, 
    string $institute, string $enrolledDate, string $graduatedDate) {
        $this->resume->updateEducation($this->id, $educationId ,$degreeType, $field, $institute, $enrolledDate, $graduatedDate);
    }

    public function updateEmployment(int $employmentId, string $position, string $company, 
    string $startedDate, string $dateLeft) {
        $this->resume->updateEmployment($this->id, $employmentId ,$position, $company, $startedDate, $dateLeft);
    }

}
