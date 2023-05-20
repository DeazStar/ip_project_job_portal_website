<?php 

require_once 'PersonalInfo.php';
require_once 'Resume.php';

class JobSeeker {
    private int $id;
    private PersonalInfo $personalInfo;
    private Resume $resume;

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
}
