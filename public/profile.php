<?php
require_once '../src/model/ProfilePictureModel.php';
require_once '../src/model/JobSeeker.php';

$profilePicture = new ProfilePictureModel();
$jobSeeker = new JobSeeker(1);

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
    <link rel="stylesheet" href="css/profilestyle.css">
    <!--end custom css-->

    <!-- icons -->
    <link rel="icon" href="images/logo.png" type="image/icon type">
    <!--icon -->
    <title>Profile</title>
</head>

<body>
    <div class="background"></div>
    <header>
        <div class="navbar-container">
            <nav>
                <ul class="nav-one">
                    <li>
                        <img src="images/logo.png">
                    </li>
                    <li class="nav-item"><a href="index.html">Home</a></li>
                    <li class="nav-item"><a href="findjob.html">Find job</a></li>
                    <li class="nav-item"><a href="findtalent.html">About Us</a></li>
                </ul>

                <ul class="nav-two">
                    <div class="nav-icon">
                        <i class="fa fa-bell-o" aria-hidden="true"></i>
                    </div>

                    <div class="nav-icon">
                        <i class="fa fa-comments-o" aria-hidden="true"></i>
                    </div>

                    <div class="nav-icon">
                        <a href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                    </div>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container-fluid px-5 mt-5 mb-5">
            <div class="row pb-5 gap-5 justify-content-center">
                <div class="col-md-3">
                    <div class="row shadow-lg rounded  pb-5">
                        <div class="col pt-5 pd-b-5">
                            <div class="profile-container">
                                <form action="../src/controller/changeProfile.php" method="POST" enctype="multipart/form-data">
                                    <input type="file" name="profile-picture" class="profile-picture-input">
                                    <button type="submit" name="submit" class="profile-picture-upload-btn"></button>
                                </form>
                                <div class="profile-image-container d-flex flex-column">
                                    <?php
                                    if (isset($src)) {
                                        echo '<img class="img-fluid profile-image" src="' . $src . '" alt="profile-image">';
                                    } else {
                                        echo '<img class="img-fluid profile-image" src="uploads/jobseeker-profile/initail.png" alt="proflile-image">';
                                    }
                                    ?>
                                </div>
                                <div class="name-container text-center mt-4">
                                    <p class="name h3"><?= $firstName . " " . $lastName; ?></p>
                                </div>

                                <div class="occupation-container">
                                    <p class="occupation text-center h5">
                                        <?php
                                        if (isset($professionalTitle)) {
                                            echo $professionalTitle;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 pt-3 profile-btn-container border btn-lf is-clicked" data-filter="profile">
                            <p class="btn-name h5"><span>
                                    <i class="bi bi-file-person pe-1"></i>
                                </span>Profile</p>
                        </div>

                        <div class="col-12 pt-3 profile-btn-container border border-top-0 btn-lf" data-filter="resume">
                            <p class="btn-name h5"><span>
                                    <i class="bi bi-file-earmark-medical pe-1"></i>
                                </span>My Resume</p>
                        </div>

                        <div class="col-12 pt-3 profile-btn-container border border-top-0 btn-lf" data-filter="saved-job">
                            <p class="btn-name h5"><span>
                                    <i class="bi bi-box2-heart pe-1"></i>
                                </span>Saved Jobs</p>
                        </div>

                        <div class="col-12 pt-3 profile-btn-container border border-top-0 btn-lf">
                            <p class="btn-name h5"><span>
                                    <i class="bi bi-briefcase pe-1"></i>
                                </span>Applied Jobs</p>
                        </div>

                        <div class="col-12 pt-3 profile-btn-container border border-top-0 btn-lf">
                            <p class="btn-name h5"><span>
                                    <i class="bi bi-lock pe-1"></i>
                                </span>Change Password</p>
                        </div>

                        <div class="col-12 pt-3 profile-btn-container border border-top-0 btn-lf">
                            <p class="btn-name h5"><span>
                                    <i class="bi bi-box-arrow-right pe-1"></i>
                                </span>Log Out</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 profile shadow-lg px-3 py-5 rounded opt">
                    <!-- personal information container-->
                    <div class="container">
                        <p class="h2">Personal Information</p>
                        <hr class="text-center">
                        <form action="../src/controller/profileController.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Your First Name:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-person-bounding-box"></i>
                                        </span>
                                        <input type="text" name="firstname" class="form-control" id="name" placeholder="e.g Naod Ararsa" value="<?= $firstName; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="name" class="form-label">Your Last Name:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-person-bounding-box"></i>
                                        </span>
                                        <input type="text" name="lastname" class="form-control" id="name" placeholder="e.g Naod Ararsa" value="<?= $lastName; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="title" class="form-label">Professional title:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-briefcase-fill"></i>
                                        </span>
                                        <input type="text" name="professional-title" class="form-control" id="title" placeholder="e.g Software Engineer" value="<?= $professionalTitle; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="birth-date" class="form-label">Birth Date:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar-date-fill"></i>
                                        </span>
                                        <input type="date" name="birth-date" class="form-control" id="birth-date" value="<?= $birthDate->format('Y-m-d'); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="phonenumber" class="form-label">Phone Number:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-telephone-fill"></i>
                                        </span>
                                        <input type="text" name="phone-number" class="form-control" id="phonenumber" placeholder="e.g +555-555-555" value="<?= $phoneNumber ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="email" class="form-label">Email Address: </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-envelope-at-fill"></i>
                                        </span>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="e.g email@example.com" value="<?= $email; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="country" class="form-label">Country: </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-globe-europe-africa"></i>
                                        </span>
                                        <select name="country" id="country" class="form-control" data-selected="<?= $country ?>">
                                            <option value="">Select Country</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="postcode" class="form-label">Postcode </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-postcard"></i>
                                        </span>
                                        <input type="text" name="postcode" class="form-control" id="postcode" placeholder="e.g 1000" value="<?= $postcode; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="city" class="form-label">City: </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-globe-europe-africa"></i>
                                        </span>
                                        <input type="text" name="city" class="form-control" id="city" placeholder="e.g Addis Ababa" value="<?= $city; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="address" class="form-label">Address: </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-globe-europe-africa"></i>
                                        </span>
                                        <input type="text" name="address" class="form-control" id="address" placeholder="e.g Addis Ababa" value="<?= $address; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="description" class="form-label">Description:</label>
                                    <textarea name="description" name="description" id="description" class="form-control"><?= $description ?></textarea>
                                </div>
                            </div>

                            <button class="btn btn-primary mt-5 save-btn" type="submit" name="submit-personal-info">Save</button>

                            <!--end-->
                        </form>

                    </div>
                </div>

                <div class="col-md-7 resume opt is-visible">
                    <div class="container pt-3 pb-3 skills box-cn shadow-b-none  rounded">
                        <h2 class="px-3">Language</h2>
                        <div class="row gap-2 px-3">
                            <?php foreach ($languages as $language) : ?>
                                <div class="col-2 pin text-center rounded"> <?= $language['language'] ?> <a href="../src/controller/deleteLanguage.php?languageId=<?= $language['language_id'] ?>"><i class="bi bi-x"></i></a></div>
                            <?php endforeach ?>
                        </div>
                        <button class="add-btn add-language ps-2 pe-3 py-1 rounded"><i class="bi bi-pencil-fill"></i> Add</button>

                        <div class="language-dialog shadow-lg">
                            <div class="dialog-nav">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="nav-header">Add Language</div>
                                    <div class="close-btn-container">
                                        <i class="bi bi-x"></i>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="lang-selected-items-container">
                                <div class="row gap-2 lang-selected-items">
                                </div>
                            </div>

                            <form action="../src/controller/languageController.php" method="POST" class="language-form">
                                <input type="text" name="language" class="language-input">
                                <button type="submit" name="submit-language" class="language-submit-btn"></button>
                            </form>

                            <div class="language-input-container">
                                <input type="text" class="form-control fake-language-input">
                            </div>
                            <div class="save-btn-container text-end">
                                <button class="save-lng px-3 py-1 me-4 rounded">Save</button>
                            </div>
                        </div>
                    </div>

                    <div class="container pt-3 pb-3 mt-3 skills box-cn shadow-b-none  rounded">
                        <h2 class="px-3">Skills</h2>
                        <div class="row gap-2 px-3">
                            <?php foreach ($skills as $skill) : ?>
                                <div class="col-2 pin text-center rounded"> <?= $skill['skill'] ?><a href="../src/controller/deleteSkill.php?skillId=<?= $skill['skill_id'] ?>"><i class="bi bi-x"></i></a></div>
                            <?php endforeach ?>
                        </div>
                        <button class="add-btn add-skill ps-2 pe-3 py-1 rounded"><i class="bi bi-pencil-fill"></i> Add</button>

                        <div class="skill-dialog shadow-lg">
                            <div class="dialog-nav">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="nav-header">Add Skills</div>
                                    <div class="skill-close-btn-container">
                                        <i class="bi bi-x"></i>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="skill-selected-items-container">
                                <div class="row gap-2 skill-selected-items">
                                </div>
                            </div>

                            <form action="../src/controller/skillController.php" method="POST" class="skill-form">
                                <input type="text" name="skill" class="skill-input">
                                <button type="submit" name="submit-skill" class="skill-submit-btn"></button>
                            </form>

                            <div class="skill-input-container">
                                <input type="text" class="form-control fake-skill-input">
                            </div>
                            <div class="save-btn-container text-end">
                                <button class="save-skill px-3 py-1 me-4 rounded">Save</button>
                            </div>
                        </div>
                    </div>

                    <div class="container pt-3 pb-3 mt-3 skills box-cn shadow-b-none  rounded">
                        <h2 class="px-3">Education</h2>
                        <div class="row gap-2 px-3 pt-2">
                            <?php foreach ($educationData as $education) :
                                $educationId = $education->getId();
                                $degreeType = $education->getDegreeType();
                                $field = $education->getField();
                                $institute = $education->getInstitute();
                                $enrolledDate = $education->getEnrolledDate();
                                $graduatedDate = $education->getGraduatedDate();

                                $degree = $degreeType . " " . "in" . " " . $field;
                                $degree = ucfirst($degree);
                                $date = $enrolledDate . "-" . $graduatedDate;


                            ?>
                                <div class="row gap-5 pb-3 education-view">
                                    <div class="col-9">
                                        <div class="education-level h5 fx-medium pt-3"><?= $degree ?></div>
                                        <div class="institute fw-light text-secondary"><?= $institute ?></div>
                                        <div class="year fw-light text-secondary"><?= $date ?></div>
                                    </div>
                                    <div class="col-2 d-flex gap-5">
                                        <div class="resume-delete-container">
                                            <a class="resume-delete-btn education-delete-btn" href="../src/controller/deleteEducation.php?educationId=<?= $educationId ?>">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </div>

                                        <div class="resume-edit-container">
                                            <div class="resume-edit-btn education-edit-btn">
                                                <i class="bi bi-pen-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach ?>
                        </div>
                        <div class="add-btn-container text-center pt-2">
                            <button class="add-btn add-education ps-2 pe-3 py-1 rounded"><i class="bi bi-pencil-fill"></i> Add</button>
                        </div>

                        <div class="education-dialog shadow-lg">
                            <div class="dialog-nav">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="nav-header">Add Education</div>
                                    <div class="education-close-btn-container">
                                        <i class="bi bi-x"></i>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="ps-3">
                                <form autocomplete="off" action="../src/controller/educationController.php" method="POST" class="education-form">
                                    <div class="degree-type-container d-flex gap-3 pt-5 align-items-center">
                                        <label class="text form-label ">Degree Type</label>
                                        <select name="degree-type" id="degree-type" class="form-control degree-type">
                                            <option value="associates">Associate's Degree</option>
                                            <option value="bachelors">Bachelor's Degree</option>
                                            <option value="masters">Master's Degree</option>
                                            <option value="doctoral">Doctoral Degree</option>
                                            <option value="professional">Professional Degree</option>
                                            <option value="diploma">Diploma</option>
                                        </select>
                                    </div>

                                    <div class="field-container d-flex gap-3 pt-5 align-items-center">
                                        <label class="text form-label">Field</label>
                                        <select name="field" id="field" class="field form-control">

                                        </select>
                                    </div>

                                    <div class="institute-container d-flex gap-3 pt-5 align-items-start">
                                        <label class="text form-label">Institute</label>
                                        <div class="institute-input-container">
                                            <input type="text" name="institute" class="institute-input form-control">
                                        </div>
                                    </div>

                                    <div class="row date-container justify-content-center">
                                        <div class="col enrolled">
                                            <label for="enrolled-date display-block form-label">Enrolled Date</label>
                                            <select name="enrolled-date" id="enrolled-date" class="enrolled-date form-control mt-2"></select>

                                        </div>

                                        <div class="col graduated">
                                            <label for="graduated-date display-block form-label">Graduated Date</label>
                                            <select name="graduated-date" id="enrolled-date" class="graduated-date form-control mt-2"></select>
                                        </div>
                                    </div>

                                    <div class="operation-type">
                                        <input type="text" name="operation" value="insert" class="education-operation">
                                        <input type="text" name="education-id" value="<?= isset($educationId) ? $educationId : null ?>">
                                    </div>
                                    <div class="save-btn-container text-end">
                                        <button type="submit" name="submit-education" class="save-education px-3 py-1 me-4 rounded">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="container pt-3 pb-3 mt-3 skills box-cn shadow-b-none  rounded">
                        <h2 class="px-3">Employment</h2>
                        <div class="row gap-2 px-3 pt-2">
                            <?php foreach ($employmentData as $employment) :
                                $employmentId = $employment->getId();
                                $position = $employment->getPosition();
                                $company = $employment->getCompany();
                                $startedDate = $employment->getStartedDate();
                                $dateLeft = $employment->getDateLeft();

                                $date = $startedDate . "-" . $dateLeft;


                            ?>
                                <div class="row gap-5 pb-3 employment-view">
                                    <div class="col-9">
                                        <div class="position h5 fx-medium pt-3"><?= $position ?></div>
                                        <div class="company fw-light text-secondary"><?= $company ?></div>
                                        <div class="year fw-light text-secondary"><?= $date ?></div>
                                    </div>
                                    <div class="col-2 d-flex gap-5">
                                        <div class="resume-delete-container">
                                            <a class="resume-delete-btn employment-delete-btn" href="../src/controller/deleteEmployment.php?employmentId=<?= $employmentId ?>">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </div>

                                        <div class="resume-edit-container">
                                            <div class="resume-edit-btn employment-edit-btn">
                                                <i class="bi bi-pen-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                            <div class="add-btn-container text-center pt-2">
                                <button class="add-btn add-employment ps-2 pe-3 py-1 rounded"><i class="bi bi-pencil-fill"></i> Add</button>
                            </div>

                            <div class="employment-dialog shadow-lg">
                                <div class="dialog-nav">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="nav-header">Add Employment</div>
                                        <div class="employment-close-btn-container">
                                            <i class="bi bi-x"></i>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="ps-3">
                                    <form action="../src/controller/employmentController.php" method="POST" class="employment-form">
                                        <div class="position-container d-flex gap-3 pt-5 align-items-center">
                                            <label class="text form-label ">Position</label>
                                            <input class="position-input form-control" name="position">
                                        </div>

                                        <div class="company-container d-flex gap-3 pt-5 align-items-center">
                                            <label class="text form-label">Company</label>
                                            <input name="company" id="company" class="company-input form-control">
                                        </div>

                                        <div class="row date-container justify-content-center pt-5">
                                            <div class="col started">
                                                <label for="started-date display-block form-label">Date Stated</label>
                                                <select name="started-date" id="started-date" class="started-date form-control mt-2"></select>

                                            </div>

                                            <div class="col left">
                                                <label for="end-date display-block form-label">Date Left</label>
                                                <select name="end-date" id="end-date" class="end-date form-control mt-2"></select>
                                            </div>
                                        </div>

                                        <div class="operation-type">
                                            <input type="text" name="operation" value="insert" class="employment-operation">
                                            <input type="text" name="employment-id" value="<?= isset($employmentId) ? $employmentId : null ?>">
                                        </div>
                                        <div class="save-btn-container text-end">
                                            <button type="submit" name="submit-employment" class="save-employment px-3 py-1 me-4 rounded">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="container pt-3 pb-3 mt-3 skills box-cn shadow-b-none  rounded">
                        <h2 class="px-3">Attach Resume</h2>
                        <div class="row gap-2 px-3">
                            <div class="fw-light">Attach your resume to boost up your chance in getting a job offer</div>
                            <form action="../src/controller/resumeHandler.php" method="POST" enctype="multipart/form-data">
                                <input type="file" name="resume" class="resume-upload">
                                <button type="submit" name="submit_resume" class="resume-upload-button"></button>
                            </form>
                            <div class="upload-file-btn py-5 mt-2 d-flex justify-content-center">
                                <i class="bi bi-cloud-arrow-up-fill upload-file-icon"></i>
                            </div>
                            <div class="file-name pt-2"><?= $resumeSrc; ?></div>
                            <button class="resume-btn rounded p-1">Upload</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 saved-job opt shadow-b-none  rounded">
                    <div class="container">
                        <h2 class="saved-jobs-header py-4">Saved Jobs</h2>
                        <div class="job border-left-none py-4">
                            <div class="title h4">Position: Web Developer</div>
                            <div class="company h5">Company: Meta</div>
                            <div class="location">Location: Remote</div>
                        </div>

                        <div class="job py-4">
                            <div class="title h4">Position: Web Developer</div>
                            <div class="company h5">Company: Meta</div>
                            <div class="location">Location: Remote</div>
                        </div>

                        <div class="job py-4">
                            <div class="title h4">Position: Web Developer</div>
                            <div class="company h5">Company: Meta</div>
                            <div class="location">Location: Remote</div>
                        </div>

                        <div class="job py-4">
                            <div class="title h4">Position: Web Developer</div>
                            <div class="company h5">Company: Meta</div>
                            <div class="location">Location: Remote</div>
                        </div>

                        <div class="job py-4">
                            <div class="title h4">Position: Web Developer</div>
                            <div class="company h5">Company: Meta</div>
                            <div class="location">Location: Remote</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

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
    </footer>

    <script src="script/fetchCountry.js"></script>
    <script src="script/uploadFile.js"></script>
    <script src="script/filter.js"></script>
    <script src="script/profile.js"></script>
    <script type="module" src="script/resume.js"></script>
    <script src="https://kit.fontawesome.com/85dd05858a.js" crossorigin="anonymous"></script>
</body>

</html>