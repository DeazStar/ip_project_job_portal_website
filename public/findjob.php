<?php
require '../src/controller/JobPosted.php';

$search = isset($_POST['search']) ? $_POST['search'] : '';
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'job_posted_date';

$jobPosting = new JobPosted();
$jobList = $jobPosting->getJobPostings($search, $sort);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>find job</title>
    <!--fontawsome-->
    <script src="https://kit.fontawesome.com/85dd05858a.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!--end fontawsome-->


    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Nunito:wght@400;900&family=Roboto&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
    <!--end google fonts-->

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--css  -->
    <link rel="stylesheet" href="css/findjob.css">

    <!-- web icon -->
    <link rel="icon" href="images/logo.png" type="image/icon type">
</head>

<body>
    <header>
        <!-- nav bar -->
        <div class="navbar-container" style="
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 100;">
            <nav>
                <ul class="nav-one">
                    <li>
                        <a href="index.html"><img src="images/logo.png"></a>
                    </li>
                    <li class="nav-item"><a href="index.html">Home</a> </li>
                    <li class="nav-item"> <a href="findtalent.html">Find Talent</a> </li>
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

    <!-- sunset -->
    <div class="sunset">
        <div style="display: inline-block;">
            <p style="padding-bottom: 0px;
                        margin: 0px;">

            <p id="date" style="padding: 0px; margin: 0px; font-size: 14px;"></p>
            <script>
                const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                const monthsOfYear = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

                var today = new Date();

                var date = today.getDate();
                var month = monthsOfYear[today.getMonth()];
                var day = daysOfWeek[today.getDay()];

                var dateString = day + ", " + month + ' ' + date;
                document.getElementById('date').innerHTML = dateString;
            </script>

            </p>
            <p style="padding: 0px; margin: 0px; font-size: 14px;">
                Have a nice day!
            </p>
        </div>
        <div class="sun">
            <img class="sun" src="images/sun.png" alt="">
        </div>
        <?php
                if (isset($_POST['jobId'])) 
                {
                    $jobId = $_POST['jobId'];

                    // Perform your PHP logic to retrieve the job detail using $jobId
                    $jobDetail = new JobPosted();
                    $jobDetail2 = $jobDetail->getJobDetail($jobId);

                    // Return the job detail as the response
                    echo "hi";
                }
                else{
                    echo "not set";
                }
                ?>
    </div>

    <!-- search -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="sortForm">

        <div class="search-div">

            <i class="glyphicon glyphicon-search" style="font-size:23px;"></i>
            <input type="text" class="search-input" placeholder="Search Job, Industry..." name="search" value="<?php echo ($search); ?>">

            <select class="sort" name="sort" id="sortSelect">
                <option value="job_posted_date" <?php if ($sort === 'job_posted_date') {
                                                    echo 'selected';
                                                }
                                                ?>>Sort by: Date</option>
                <option value="payment_amount" <?php if ($sort === 'payment_amount') {
                                                    echo 'selected';
                                                }
                                                ?>>Sort by: Payment Amount</option>
            </select>
        </div>
        <!-- <button type="submit" class="btn search-btn" >Search</button> -->

    </form>

                                        


    <!-- main page -->
    <section class="job-container container-fluid column">

        <!-- job-list left -->
        <div class="job-list col-12 col-lg-4">


            <!-- fetch with php -->
            <?php
            if (!empty($jobList)) {
                foreach ($jobList as $job) {
            ?>

                    <div class="job1">

                        <p class="hiddenId" style="visibility: hidden;"><?= $job['id'] ?></p>
                        <div class="job-pic-div">
                            <?php

                            $imagePath = "images/" . $job['company_logo'];
                            ?>
                            <!-- Output the logo image -->
                            <img class="job-pic" src="<?php echo $imagePath; ?>" alt="no images found">
                        </div>

                        <div class="job-name">

                            <div class="name">
                                <p style="
                                    padding: 0;
                                    color:black;
                                    margin: 6px;
                                    font-size: 16px;
                                 ">
                                    <?= $job['job_title'] ?></p>
                                <p style="
                                    font-size:12px;
                                    margin: 5px;
                                   ">
                                    <?= $job['company_location'] ?> </p>
                            </div>

                            <div class="status">
                                <!-- <?php

                                        $posted_time = strtotime($job['job_posted_date']);
                                        $time_diff = time() - $posted_time;

                                        if ($time_diff < 86400) { // less than 24 hours
                                            $job_posted_time = date('g:i a', $posted_time);
                                        } else { // more than 24 hours
                                            $job_posted_time = date('F j, Y', $posted_time);
                                        }

                                        ?> -->


                                <p><i class="glyphicon glyphicon-hourglass" style="font-size:13px;"></i> Posted : <?= $job_posted_time ?></p>
                                <p><i class="fas fa-chart-line capitalize" style="font-size:13px;"></i> Level : <?= $job['seniority_level'] ?></p>
                                <p><i class="glyphicon glyphicon-time capitalize" style="font-size:13px;"></i> Hours : <?= $job['employment_type'] ?></p>
                                <p><i class="glyphicon glyphicon-usd capitalize" style="font-size:13px;"></i> Budget : <?= $job['payment_amount'] . "birr per/" . $job['payment_frequency'] ?></p>
                            </div>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "<h3 style='padding: 5% 0 0 12%'> No More jobs found.</h3> ";
            }
            ?>
        </div>

        </div>


        </div>

        <!-- job details right -->
        <div class="job-details col-12 col-lg-8">
            <div class="details-top">
                <div class="job2">

                    <div class="job-pic-div">
                        <img class="job-pic" src="images/mobile-app.png" width="35px" alt="">
                    </div>

                    <div class="job-name">
                        <div class="name" style="width: 500px;">
                            <p style="
                            
                                    padding: 0;
                                    color:black;
                                    margin: 5px 75px 5px 5px;
                                    font-size: 17px;
                                    ">
                                <?= $job['job_title'] ?> : - <i class="fa-sharp fa-solid fa-user-tie"></i> Company: <?= $job['company_name'] ?> </p>
                            <p style="
                                    font-size:12px;
                                    margin: 5px;
                                ">
                                <?= $job['company_industry'] ?>, <?= $job['company_location'] ?></p>
                        </div>
                        <div class="status1">


                            <p><i class="glyphicon glyphicon-hourglass" style="font-size:13px;"></i> Posted : <?= $job_posted_time ?></p>
                            <p><i class="fas fa-chart-line capitalize" style="font-size:13px;"></i> Level : <?= $job['seniority_level'] ?></p>
                            <p><i class="glyphicon glyphicon-time capitalize" style="font-size:13px;"></i> Hours : <?= $job['employment_type'] ?></p>
                            <p><i class="glyphicon glyphicon-usd capitalize" style="font-size:13px;"></i> Budget : <?= $job['payment_amount'] . "birr per/" . $job['payment_frequency'] ?></p>

                            <button class="btn1">apply for the job</button>
                        </div>
                    </div>

                </div>

            </div>

            <div class="description">

                <p class="description">

                    <?= $job['job_description'] ?>

                </p>
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



    <script src="/script/findjob.js"></script>

    <!-- id submit form -->
    <form id="jobForm" method="POST" action="findjob.php">
        <input type="hidden" id="jobIdInput" name="jobId">
    </form>

    <script src="/script/findjob.js"></script>
    <script>
        /* JavaScript */
        /* JavaScript */

        // jobs scroller
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.navbar-container');
            if (window.pageYOffset > 0) {
                navbar.classList.add('nav-scrolled');
            } else {
                navbar.classList.remove('nav-scrolled');
            }
        });

        //sorting option
        // Submit the form when sort option is changed
        document.addEventListener('DOMContentLoaded', function() {
            var sortSelect = document.getElementById('sortSelect');
            sortSelect.addEventListener('change', function() {
                var sortForm = document.getElementById('sortForm');
                sortForm.submit();
            });
        });



        // Get all job elements in the left job list
        const jobElements = document.querySelectorAll('.job1');

        // Attach a click event listener to each job element
        jobElements.forEach((jobElement) => {
            jobElement.addEventListener('click', (event) => {
                // Get the selected job name
                const jobId = jobElement.querySelector('p').textContent;

                // Update the job name on the right side
                updateJobName(jobId);
            });
        });

        // Function to update the job name on the right side
        function updateJobName(jobId) {
            const jobDetailsContainer = document.querySelector('.job-details');

            // Make an AJAX request to send the jobId to the PHP script
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'findjob.php'); // Replace 'findjob.php' with the actual PHP script file name
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Get the response from PHP
                    const jobDetail2 = xhr.responseText;
                    jobDetailsContainer.innerHTML = `<h1>${jobId}</h1>`;
                }
            };
            xhr.send(`jobId=${encodeURIComponent(jobId)}`);
        }
    </script>

</body>

</html>