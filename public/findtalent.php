<?php
require_once '../src/model/JobSeeker.php';
require_once '../src/model/ProfilePictureModel.php';
require_once '../src/model/JobSeekerService.php';


if(isset($_GET['job-id'])) {
    $tableRow = JobSeekerService::getAppliedRow();

    $itemPerRow = 7;
    $num = ceil($tableRow / $itemPerRow);
    $start = (($_GET['page'] ?? 1) - 1) * $itemPerRow;
    $jobSeekers = JobSeekerService::getAppliedJobSeeker($_GET['job-id'], $start, $itemPerRow);


} else {
    $tableRow = JobSeekerService::getRows();

    $itemPerRow = 7;
    $num = ceil($tableRow / $itemPerRow);
    $start = (($_GET['page'] ?? 1) - 1) * $itemPerRow;
    $jobSeekers = JobSeekerService::getAllJobSeekers($start, $itemPerRow);
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--custom css-->
    <link rel="stylesheet" href="css/findtalentstyle.css">
    <!--end custom css-->

    <!--fontawsome-->
    <script src="https://kit.fontawesome.com/85dd05858a.js" crossorigin="anonymous"></script>
    <!--end fontawsome-->

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Nunito:wght@400;900&family=Roboto&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!--end-->

    <!--custom css-->
    <link rel="stylesheet" href="css/profilestyle.css">
    <!--end custom css-->
    <!--end google fonts-->
    <link rel="icon" href="images/logo.png" type="image/icon type">
    <!--icon -->
    <title>Find Talent</title>
</head>

<body>
    <header>
        <div class="navbar-container">
            <nav>
                <ul class="nav-one">
                    <li>
                        <img src="images/logo.png">
                    </li>
                    <li class="nav-item"><a href="findtalent.php">Home</a></li>
                    <li class="nav-item"><a href="postjob.php">Post Job</a></li>
                    <li class="nav-item"><a href="findtalent.php">Find Talent</a></li>
                </ul>

                <ul class="nav-two">
                    <div class="nav-icon">
                        <i class="fa fa-bell-o" aria-hidden="true"></i>
                    </div>

                    <div class="nav-icon">
                        <i class="fa fa-comments-o" aria-hidden="true"></i>
                    </div>

                    <div class="nav-icon">
                        <a href="../src/controller/linkController.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                    </div>
                </ul>
            </nav>
        </div>
    </header>
    <hr>


    <main>
        <div class="search-bar-container">
            <input type="text" placeholder="search" class="search-bar">
            <i class="fa fa-search" aria-hidden="true"></i>
        </div>


        <section id="section-one">
            <div class="left-part">
                <div class="location-container">
                    <p class="left-part-header">Location</p>
                    <input type="text" placeholder="Postcode or city">
                    <p class="location-selected">Addis Ababa, Ethiopia</p>
                </div>

                <div class="status-container">
                    <p class="left-part-header">Status</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-on">
                        <span class="slider"></span>
                    </label>
                    <label class="switch-label">Part time</label> <br>
                    <label class="switch">
                        <input type="checkbox" class="switch-on">
                        <span class="slider"></span>
                    </label>
                    <label class="switch-label">Full time</label> <br>
                    <label class="switch">
                        <input type="checkbox" class="switch-on">
                        <span class="slider"></span>
                    </label>
                    <label class="switch-label">Internship time</label> <br>
                    <label class="switch">
                        <input type="checkbox" class="switch-on">
                        <span class="slider"></span>
                    </label>
                    <label class="switch-label">Contract</label> <br>
                </div>

                <div class="experience-container">
                    <p left-part-header>Experience Level</p>
                    <select>
                        <option>All Levels</option>
                        <option value="entry-level">Entry Level</option>
                        <option value="intermediate-level">Intermediate Level</option>
                        <option value="Mid-level">Mid Level</option>
                        <option value="senior-level">Senior Level</option>
                        <option value="Technical-level">Technical Level</option>
                    </select>
                </div>

                <div class="catorgory-level">
                    <p class="left-part-header">Catagories</p>
                    <label class="checkbox-container">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-label">Science & Technology</label>
                    <label class="checkbox-container">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-label">Social Service</label>
                    <label class="checkbox-container">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-label">Architecture & Engineering</label>
                    <label class="checkbox-container">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-label">Education</label>
                </div>

                <div class="language-container">
                    <p class="left-part-header">Language</p>
                    <select>
                        <option>All Levels</option>
                        <option value="english">English</option>
                        <option value="amharic">Amharic</option>
                        <option value="oromifa">Oromifa</option>
                        <option value="french">French</option>
                        <option value="mandarin">Mandarin</option>
                    </select>
                </div>
            </div>


            <div class="right-part">
                <hr>
                <?php
                foreach ($jobSeekers as $jobSeeker) :
                    $jobSeekerId = $jobSeeker->getId();
                    $firstName = $jobSeeker->getPersonalInfo()->getFirstName();
                    $lastName = $jobSeeker->getPersonalInfo()->getLastName();
                    $fullName = $firstName . ' ' . $lastName;

                    $country = $jobSeeker->getPersonalInfo()->getCountry();
                    $professionalTitle = $jobSeeker->getPersonalInfo()->getProfessionalTitle();
                    $path = $jobSeeker->getProfileUrl();

                    $uploadsDir = "uploads/";

                    $uploadsPos = strrpos($path, $uploadsDir);

                    if ($uploadsPos !== false) {
                        $src = substr($path, $uploadsPos);
                    } else {
                        $src = 'uploads/jobseeker-profile/initail.png';
                    }



                ?>
                    <div class="profile-container d-flex justify-content-between">
                        <div class="profile-left">
                            <div class="profile-name-image-container">
                                <div class="profile-img-container">
                                    <img src="<?= $src ?>" class="profile-image img-fluid">
                                </div>
                                <div class="profile-name-container">
                                    <div class="name"><?= $fullName ?></div>
                                    <div class="country"><?= $country ?></div>
                                </div>
                            </div>
                            <div class="open-for-work-contianer">
                                <div class="role-description"><?= $professionalTitle ?></div>
                            </div>
                        </div>

                        <div class="profile-right">
                            <a class="see-btn btn btn-primary" href="candidate-detail.php?id=<?= $jobSeekerId ?>" role="button">See More</a>
                        </div>
                    </div>
                    <hr>
                <?php endforeach ?>
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

            </div>
            </div>

        </section>


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
    </main>
</body>

</html>