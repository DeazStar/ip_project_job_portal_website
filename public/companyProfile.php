<?php 
session_start();
require_once '../src/model/Company.php';
require_once '../src/model/ProfilePictureModel.php';
require_once '../src/model/JobService.php';



$company = new Company($_SESSION['id']);

$profilePicture = new ProfilePictureModel();

$path = $profilePicture->fetchPicture($company) ?? null;
$uploadsDir = "uploads/";

$uploadsPos = strrpos($path, $uploadsDir);

if ($uploadsPos !== false) {
    $src = substr($path, $uploadsPos);
}

$company->fetchProfile();

$companyName = $company->getCompanyName();
$companyEmail = $company->getEmail();
$companyWebsite = $company->getWebsite();
$foundedDate = $company->getFoundedDate()->format("Y-m-d");
$phoneNumber =$company->getPhoneNumber();
$country = $company->getCountry();
$postCode = $company->getPostalCode();
$city = $company->getCity();
$address = $company->getAddress();
$description = $company->getDescription();

$tableRow = JobService::getPostedJobRow($_SESSION['id']);
$itemPerRow = 7;
$num = ceil($tableRow / $itemPerRow);
$start = (($_GET['page'] ?? 1) - 1) * $itemPerRow;
$jobs = JobService::getPostedJobById($_SESSION['id'], $start, $itemPerRow);
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
    <link rel="stylesheet" href="css/error-style.css">
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
                    <li class="nav-item"><a href="#">Home</a></li>
                    <li class="nav-item"><a href="findtalent.php">Find Talent</a></li>
                    <li class="nav-item"><a href="aboutus.html">About Us</a></li>
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
                                    <p class="name h3"><?=$company->getCompanyName()?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 pt-3 profile-btn-container border btn-lf is-clicked" data-filter="profile">
                            <p class="btn-name h5"><span>
                                    <i class="bi bi-file-person pe-1"></i>
                                </span>Company Profile</p>
                        </div>

                        <div class="col-12 pt-3 profile-btn-container border border-top-0 btn-lf" data-filter="manage-job">
                            <p class="btn-name h5"><span>
                                    <i class="bi bi-briefcase pe-1"></i>
                                </span>Manage Jobs</p>
                        </div>

                        <div class="col-12 pt-3 profile-btn-container border border-top-0 btn-lf">
                            <p class="btn-name h5"><span>
                                    <i class="bi bi-lock pe-1"></i>
                                </span>Change Password</p>
                        </div>

                        <div class="col-12 pt-3 profile-btn-container border border-top-0 btn-lf logout-btn">
                            <p class="btn-name h5"><span>
                                    <i class="bi bi-box-arrow-right pe-1"></i>
                                </span>Log Out</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 profile shadow-lg px-3 py-5 rounded opt is-visible">
                    <!-- personal information container-->
                    <div class="container">
                        <p class="h2">Company Information</p>
                        <hr class="text-center">
                        <form action="../src/controller/profileController.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="company-name" class="form-label">Company Name:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-person-bounding-box"></i>
                                        </span>
                                        <input type="text" name="company-name" class="form-control" id="name" placeholder="e.g DeadStar inc." value="<?= $companyName ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Company Email:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-person-bounding-box"></i>
                                        </span>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="e.g company@gamil.com" value="<?= $companyEmail ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="website" class="form-label">Website:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-briefcase-fill"></i>
                                        </span>
                                        <input type="text" name="website" class="form-control" id="website" placeholder="e.g www.company.com" value="<?= $companyWebsite ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="founded-date" class="form-label">Founded Date:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar-date-fill"></i>
                                        </span>
                                        <input type="date" name="founded-date" class="form-control" id="founded-date" value="<?= $foundedDate?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="" class="form-label">Phone Number:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-telephone-fill"></i>
                                        </span>
                                        <input type="text" name="phone-number" class="form-control" id="phonenumber" placeholder="e.g +555-555-555" value="<?= $phoneNumber ?>">
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
                                        <input type="text" name="postcode" class="form-control" id="postcode" placeholder="e.g 1000" value="<?= $postCode?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="city" class="form-label">City: </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-globe-europe-africa"></i>
                                        </span>
                                        <input type="text" name="city" class="form-control" id="city" placeholder="e.g Addis Ababa" value="<?= $city ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="address" class="form-label">Address: </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-globe-europe-africa"></i>
                                        </span>
                                        <input type="text" name="address" class="form-control" id="address" placeholder="e.g Addis Ababa" value="<?= $address ?>">
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="description" class="form-label">Description:</label>
                                    <textarea name="description" name="description" id="description" class="form-control"><?= $description ?></textarea>
                                </div>
                            </div>

                            <button class="btn btn-primary mt-5 save-btn" type="submit" name="submit-company-info">Save</button>

                            <!--end-->
                        </form>

                    </div>
                </div>

                <div class="col-md-7 manage-job opt">
                    <?php 
                        foreach($jobs as $job):
                    ?>
                    <div class="container pt-3 pb-3 job box-cn shadow-b-none  rounded">
                        <button class="add-btn add-language px-2 rounded"><i class="bi bi-eye"></i></button>
                        <div class="posted-job-container pb-3">
                            <div class="job-name h4"><?=$job->getJobTitle()?></div>
                            <div class="date"><?=$job->getJobPostedDate()->format('Y-m-d H:i:s') ?></div>
                            <div class="job-type"><?= $job->getEmploymentType() ?></div>
                        </div>
                        <a class="save-lng px-3 py-1 me-4 rounded" href="findtalent.php?job-id=<?= $job->getJobId() ?>">Manage Applicants</a>

                    </div>
                    <div class="d-flex gap=0 pagination-row text-center pb-5">
                    <?php
                    for ($i = 1; $i <= $num; $i++) {
                        if (isset($_GET['page'])) {
                            if ($i == $_GET['page']) {
                                echo '<a href="?page=' . $i . '">' . '<div class="pagination-style selected">' . $i . "</div></a>";
                            } else {
                                echo '<a href="?page=' . $i . '">' . '<div class="pagination-style">' . $i . "</div></a>";
                            }
                        } else if ($i == 1) {
                            echo '<a href="?page=' . $i . '">' . '<div class="pagination-style selected">' . $i . "</div></a>";
                        } else {
                            echo '<a href="?page=' . $i . '">' . '<div class="pagination-style">' . $i . "</div></a>";
                        }
                    }
                    ?>
                </div>

                    <?php endforeach ?>
                </div>


            </div>
    </main>

    <?php if (isset($_SESSION['required-personal-info'])) {
            echo '<div class="error-container text-danger pb-3 text-center">' . $_SESSION['required-personal-info'] . '</div>';
        }
    ?>

    <script src="script/filter.js"></script>
    <script src="script/fetchCountry.js"></script>
    <script src="script/uploadFile.js"></script>
</body>