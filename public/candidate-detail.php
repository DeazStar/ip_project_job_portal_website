<?php

require_once '../src/model/ProfilePictureModel.php';
require_once '../src/model/JobSeeker.php';

if (isset($_GET['file'])) {

$file = $_GET['file'];

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file) . '"');
header('Content-Length: ' . filesize($file));

readfile($file);

}
if (isset($_GET['id'])) {
    $jobSeeker = new JobSeeker($_GET['id']);

    $profilePicture = new ProfilePictureModel();
    $path = $profilePicture->fetchPicture($jobSeeker) ?? null;
    $uploadsDir = "uploads/";

    $uploadsPos = strrpos($path, $uploadsDir);

    if ($uploadsPos !== false) {
        $src = substr($path, $uploadsPos);
    }

    $jobSeeker->fetchProfile();

    $firstName = $jobSeeker->getPersonalInfo()->getFirstName();
    $lastName = $jobSeeker->getPersonalInfo()->getLastName();
    $professionalTitle = $jobSeeker->getPersonalInfo()->getProfessionalTitle();
    $birthDate =  $jobSeeker->getPersonalInfo()->getDate();
    $phoneNumber = $jobSeeker->getPersonalInfo()->getPhoneNumber();
    $email = $jobSeeker->getPersonalInfo()->getEmail();
    $country = $jobSeeker->getPersonalInfo()->getCountry();
    $postcode = $jobSeeker->getPersonalInfo()->getPostCode();
    $city = $jobSeeker->getPersonalInfo()->getCity();
    $address = $jobSeeker->getPersonalInfo()->getAddress();
    $description = $jobSeeker->getPersonalInfo()->getDescription();
    $jobSeeker->fetchResume();
    $resumePath = $jobSeeker->getResume()->getResumeUrl();

    $jobSeeker->fetchLanguage();
    $jobSeeker->fetchSKill();

    $languages = $jobSeeker->getResume()->getLanguage();
    $skills = $jobSeeker->getResume()->getSkill();

    $educationData = $jobSeeker->fetchEducation();
    $employmentData = $jobSeeker->fetchEmployment();

    $resumeUploadsDir = "resume/";

    $resumeUploadPos = strpos($resumePath, $resumeUploadsDir);

    if ($uploadsPos !== false) {
        $resumeSrc = substr($resumePath, $resumeUploadPos);
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Nunito:wght@400;900&family=Roboto&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
    <!--end google fonts-->

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!--end-->

    <!--custom css-->
    <link rel="stylesheet" href="css/candidate-detail.css">
    <link rel="stylesheet" href="css/findjob.css">
    <!--end custom css-->

    <!-- icons -->
    <link rel="icon" href="images/logo.png" type="image/icon type">
    <!--icon -->
    <title>Candidate Detail</title>
</head>

<body>
<div class="navbar-container" style="
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 100;
                background-color: #fff;
                ">
            <nav>
                <ul class="nav-one">
                    <li>
                        <a href="index.html"><img src="images/logo.png"></a>
                    </li>
                    <li class="nav-item"><a href="index.php">Home</a> </li>
                    <li class="nav-item"> <a href="findtalent.php">Find Talent</a> </li>
                    <li class="nav-item"> <a href="aboutus.html">About Us</a> </li>
                </ul>

                <ul class="nav-two">
                    <div class="nav-icon">
                        <i class="fa fa-bell-o" aria-hidden="true" style="font-size: 20px;"></i>
                    </div>

                    <div class="nav-icon">
                        <i class="fa fa-comments-o" aria-hidden="true" style="font-size: 20px;"></i>
                    </div>

                    <div class="nav-icon">
                        <a href="../src/controller/linkController.php"><i class="fa fa-user-circle-o" aria-hidden="true" style="font-size: 24px; color: rgb(0, 0, 0);"></i></a>
                    </div>
                </ul>
            </nav>
        </div>
    </header>
    <hr style="
        margin:100px 0 0 0;
        border:none;
    ">

    <div class="container-lg pb-5">
        <div class="container-fluid">
            <div class="profile-contianer d-flex align-content-end pb-5 ps-3">
                <div class="profile-image-profile">
                    <img class="img-fluid" src="<?= $src ?? 'uploads/jobseeker-profile/initail.png' ?>" alt="">
                </div>
                <div class="name-container">
                    <div class="name fs-4"><?= $firstName . " " . $lastName ?></div>
                    <div class="professional-title text-secondary"><?= $professionalTitle ?></div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-7">
                    <div class="candidate-name h3"><?= $firstName . " " . $lastName ?></div>
                    <div class="candidate-description pt-2">
                        <?= $description ?>
                    </div>
                    <div class="candidate-language pt-5 h4">Language: </div>
                    <div class="language-row row">
                        <?php 
                            foreach($languages as $language):
                        ?>
                        <div class="col-6 pt-3"><i class="bi bi-check-lg pe-2 tick"></i><?= $language['language']?></div>
                        <?php endforeach ?>
                    </div>

                    <div class="candidate-language pt-5 h4">Skills: </div>
                    <div class="language-row row">
                        <?php 
                            foreach($skills as $skill):
                        ?>
                        <div class="col-6 pt-3"><i class="bi bi-check-lg pe-2 tick"></i><?= $skill['skill'] ?></div>

                        <?php endforeach ?>
                    </div>


                    <div class="candidate-education pt-5 h4">Education: </div>
                    <div class="education-row">
                        <?php
                            foreach ($educationData as $education) :
                                $degreeType = $education->getDegreeType();
                                $field = $education->getField();
                                $institute = $education->getInstitute();
                                $enrolledDate = $education->getEnrolledDate();
                                $graduatedDate = $education->getGraduatedDate();
                            
                                $degree = $degreeType . " " . "in" . " " . $field;
                                $degree = ucfirst($degree);
                                $date = $enrolledDate . "-" . $graduatedDate;
                        ?>
                        <div class="degree-type pt-3 fs-5"><i class="bi bi-check-lg pe-2 tick"></i><?= $degree ?></div>
                        <div class="university-attended ps-5 text-secondary pt-2"></i> <?= $institute ?></div>
                        <div class="duration ps-5 text-secondary pt-1"><?= $date ?></div>
                        <?php endforeach ?>
                    </div>

                    <div class="candidate-employment pt-5 h4">Employment: </div>
                    <div class="education-row">
                    <?php 
                        foreach ($employmentData as $employment) :
                                $position = $employment->getPosition();
                                $company = $employment->getCompany();
                                $startedDate = $employment->getStartedDate();
                                $dateLeft = $employment->getDateLeft();

                                $date = $startedDate . "-" . $dateLeft;
                    ?>
                        <div class="degree-type pt-3 fs-5"><i class="bi bi-check-lg pe-2 tick"></i> <?= $position ?></div>
                        <div class="university-attended ps-5 text-secondary pt-2"></i> <?= $company ?> </div>
                        <div class="duration ps-5 text-secondary pt-1"><?= $date ?></div>
                    <?php endforeach ?>
                    </div>
                </div>

                <div class="col-5">
                    <div class="container-fluid personal-info-container">
                        <div class="candidate-employment pt-5 h4">Personal Detail: </div>
                        <div class="candidate-email-container row  pt-3">
                            <div class="candidate-email-text col-6"><i class="bi bi-envelope pe-2"></i>Email:</div>
                            <div class="email col-6"><?= $email ?></div>
                        </div>
                        <div class="candidate-birthDate-container row pt-3">
                            <div class="candidate-birthDate-text col-6"><i class="bi bi-calendar pe-2"></i>D.O.B:</div>
                            <div class="birthDate col-6"><?= $birthDate->format('Y-m-d') ?></div>
                        </div>

                        <div class="candidate-phone-container row pt-3">
                            <div class="candidate-phone-text col-6"><i class="bi bi-telephone pe-2"></i>Phone Number: </div>
                            <div class="phone-number col-6"><?= $phoneNumber ?></div>
                        </div>

                        <div class="candidate-country-container row pt-3">
                            <div class="candidate-country-text col-6"><i class="bi bi-globe pe-2"></i>Country: </div>
                            <div class="country col-6"><?= $country ?> </div>
                        </div>

                        <div class="candidate-city-container row pt-3">
                            <div class="candidate-city-text col-6"><i class="bi bi-geo-alt pe-2"></i>City: </div>
                            <div class="city col-6"><?= $city ?></div>
                        </div>

                        <div class="candidate-phone-container row pt-3">
                            <div class="candidate-phone-text col-6"><i class="bi bi-mailbox pe-2"></i>Postal Code: </div>
                            <div class="postal col-6"><?= $postcode ?></div>
                        </div>

                        <div class="candidate-address-container row pt-3">
                            <div class="candidate-address-text col-6"><i class="bi bi-geo-alt pe-2"></i>Address:</div>
                            <div class="address col-6"><?= $address ?></div>
                        </div>
                        <div class="container-lg text-center pt-3 pe-2 mt-5 cv-container rounded">
                            <a class="download-cv px-3 mb-3 rounded py-3" href="?id=<?= $_GET['id']?>&file=<?=urlencode($resumePath) ?>"><i class="bi bi-file-earmark-pdf pe-3"></i>Download Resume</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="upper-footer-container">
            <div class="left-section">
                <div class="bottom-site-icon">
                    <img src="images/logo.png">
                </div>

                <div class="footer-social-media">
                    <span class="follow-us">Follow Us: </span>
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-square-twitter"></i>
                    <i class="fa-brands fa-square-instagram"></i>
                </div>

                <div class="subscribe">
                    <p>Subscribe to our news letter: </p>
                    <input type="email" placeholder="Subscribe" class="subscribe-input">
                    <button class="btn-subscribe">Subscribe</button>
                </div>
            </div>
            <div class="right-footer-section footer-links">
                <div class="footer-row-one">
                    <ul>
                        <li class="footer-title">For Recruiters</li>
                        <li class="footer-item">How to Hire</li>
                        <li class="footer-item">Talent Marketplace</li>
                        <li class="footer-item">Payroll Service</li>
                        <li class="footer-item">Hire Worldwide</li>
                        <li class="footer-item">Hire in Africa</li>
                    </ul>
                </div>

                <div class="footer-row-two">
                    <ul>
                        <li class="footer-title">For Talent</li>
                        <li class="footer-item">How to Find a Job</li>
                        <li class="footer-item">Find in Africa</li>
                    </ul>
                </div>

                <div class="footer-row-two">
                    <ul>
                        <li class="footer-title">Company</li>
                        <li class="footer-item">About Us</li>
                        <li class="footer-item">Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="footer-last">
            <p>&copy; 2022-2022 AfriHire inc</p>
            <p>Terms and Services</p>
            <p>Privacy Policy</p>
        </div>
        <!--finsh the footer-->
    </footer>
</body>

</html>