<?php 

require_once 'PersonalInfo.php';

class JobSeeker {
    private int $id;
    private PersonalInfo $personalInfo;
    public function __construct(int $id){
        $this->id = $id;
        $this->personalInfo = new PersonalInfo();
    }

    public function getId():int {
        return $this->id;
    }

    public function setId(int $id):void {
        $this->id =$id;
    }


    public function updateProfile(array $data) {
    }
}
