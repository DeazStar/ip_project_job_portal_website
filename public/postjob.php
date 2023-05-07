<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--fontawsome-->
    <script src="https://kit.fontawesome.com/85dd05858a.js" crossorigin="anonymous"></script>
    <!--end fontawsome-->

    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Nunito:wght@400;900&family=Roboto&family=Ubuntu:wght@700&display=swap"
        rel="stylesheet">
    <!--end google fonts-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        <link rel="stylesheet" href="css/post_job.css">
    <link rel="icon" href="images/logo.png" type="image/icon type">
    <!--icon -->

    <title>AfriHire Post Job</title>
</head>

<body>
    <header>
        <!-- nav bar -->
        <div class="navbar-container">
            <nav>
                <ul class="nav-one">
                    <li>
                      <a href="index.html"><img src="images/logo.png"></a>  
                    </li>
                    <li class="nav-item"><a href="index.html">Home</a> </li>
                    <li class="nav-item"> <a href="findtalent.html">Find Talent</a> </li>
                    <li class="nav-item">  <a href="aboutus.html">About Us</a> </li>
                </ul>

                <ul class="nav-two">
                    <div class="nav-icon">
                        <i class="fa fa-bell-o" aria-hidden="true" style="font-size: 20px;"></i>
                    </div>

                    <div class="nav-icon">
                        <i class="fa fa-comments-o" aria-hidden="true" style="font-size: 20px;"></i>
                    </div>

                    <div class="nav-icon">
                       <a href="profile.html"><i class="fa fa-user-circle-o" aria-hidden="true" style="font-size: 24px; color: rgb(0, 0, 0);"></i></a> 
                    </div>
                </ul>
            </nav>
        </div>
    </header>
    <hr>


    <section class="section-one mt-5">
        <div class="container-fluid">
            <h1 class="text-center display-4 fw-light mb-5">Post Job</h1>

            <div style="
                display: flex; 
                justify-content: space-between;
                margin-left:17%;
            ">
            <?php

            if(isset($_SESSION['error'])){
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
            ?>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-8">
                <div class="text-start">
            
                 <form action="php/postjob.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="company-logo" class="form-label">Company Logo: </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-folder2-open"></i>
                            </span>
                            <input type="file" class="form-control" name="company-logo" id="company-logo">
                        </div>
                    </div>
                    <!--  -->
                    <div class="mb-3">
                        <label for="company-name" class="form-label">Company Name:</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-cursor-text"></i>
                            </span>
                            <input type="text" class="form-control" id="company-name" name="company-name" required>
                        </div>
                    </div>
                    <!--  -->
                    <div class="mb-3">
                        <label for="company-location" class="form-label">Company Location:</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-cursor-text"></i>   
                            </span>
                            <input type="text" class="form-control" id="company-name" name="company-location" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="job-title" class="form-label">Job Title:</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-cursor-text"></i>
                            </span>

                            <input type="text" class="form-control" id="job-title" name="job-title" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="company-industry" class="form-label">Company Industry</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-building-gear"></i>
                            </span>
                            <select name="company-industry" id="company-industry" class="form-control" name="Company-Industry" required>
                                <option value="" selected>Choose company Industry</option>
                                <option value="information_tecnology">Information Technology</option>
                                <option value="manufacturing">Manufacturing</option>
                                <option value="entertainment">Entertainment</option>
                                <option value="agriculture_and_forestry">Agriculture & Forestry/Wildlife</option>
                                <option value="business_and_information">Business & Information</option>
                                <option value="construction">Construction/Utilities/Contracting</option>
                                <option value="education">Education</option>
                                <option value="finace_and_insurance">Finance & Insurance</option>
                            </select>
                        </div>
                    </div>
                
                    <div class="mb-3">
                        <label for="employment-type" class="form-label">Employment Type</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-video2"></i>
                            </span>
                            <select name="employment-type" id="employment-type" class="form-control" required>
                                <option value="" selected>Choose Employment Type</option>
                                <option value="fulltime">Full-Time</option>
                                <option value="parttime">Part-Time</option>
                                <option value="contract">Contract</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="seniority-level" class="form-label">Seniority Level</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-video2"></i>
                            </span>
                            <select name="seniority-level" id="Seniority" class="form-control" required>
                                <option value="" selected>Choose Seniority Level</option>
                                <option value="entrylevel">Entery-Level</option>
                                <option value="midlevel">Mid-Level</option>
                                <option value="seniorlevel">Senior Level</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="payment-amount" class="form-label">Budget / Payment Amount</label>
                        <div class="input-group">
                          <span class="input-group-text">$</span>
                          <input type="number" name="payment-amount" id="payment-amount" class="form-control" placeholder="Enter payment amount" required>
                          <select name="payment-frequency" id="payment-frequency" class="form-select" required>
                            <option value="" selected>Payment Frequency</option>
                            <option value="hourly">Per Hour</option>
                            <option value="daily">Per Day</option>
                            <option value="daily">Per Week</option>
                            <option value="monthly">Per Month</option>
                          </select>
                        </div>
                      </div>
                    

                    <div class="mb-3">
                        <label for="job-description" class="form-label">Job Description:</label>
                        <div class="form-floating">
                            <textarea name="job-description" id="job-description" style="height: 15.5rem" class="form-control"></textarea>
                            <label for="job-description">Your job description ...</label>
                        </div>
                    </div>

                    
                    <button class="btn btn-primary btn-md me-5 reset-btn px-4" type="reset">Reset</button>
                    <button class="btn btn-primary btn-md submit-btn px-4" type="submit" name="submit">Post</button>
                    </form>
                    </div>
            </div>
        </div>
        </div>
        </div>
    </div>
    </section>


    <!-- footer -->
    <footer class="mt-5">
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
    <script src="script/post_job.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
    </body>


   </html>
