<?php 

require_once 'PersonalInfo.php';

class JobSeeker {
    private int $id;
    private PersonalInfo $personalInfo;

    /**
     * jobSeeker construct 
     * 
     * Create a new instance of the jobSeeker class.
     */
    public function __construct(int $id){
        $this->id = $id;
        $this->personalInfo = new PersonalInfo();
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

    public function getPersonalInfo():PersonalInfo {
        return  $this->personalInfo;
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

    public function fetchProfile():void {
        $this->personalInfo->fetchPersonalInfo($this->id);
    }
}
