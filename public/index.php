<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--custom css-->
    <link rel="stylesheet" href="css/homestyle.css">
    <!--end custom css-->

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

    <link rel="icon" href="images/logo.png" type="image/icon type">
    <!--icon -->
    <title>AfriHire</title>
</head>

<body>
    <header>
        <div class="navbar-container">
            <nav class="main-nav">
                <ul class="nav-one">
                    <li class="navbrand">
                        <img src="images/logo.png">
                    </li>
                    <li class="nav-item"><a href="#">Home</a></li>
                    <li class="nav-item"><a href="findjob.php">Find job</a></li>
                    <li class="nav-item"><a href="findtalent.html">Find Talent</a></li>
                    <li class="nav-item"><a href="aboutus.html">About Us</a></li>
                </ul>

                <ul class="nav-two">
                    <li class="nav-item">
                        <i class="fa-solid fa-globe"></i>
                        <span>English</span>
                    </li>

                    <li class="nav-item nav-button-container">
                        <a href="login.php">
                        <div class="nav-button">
                            Log in
                        </div>
                        </a>
                    </li>

                    <li class="nav-item nav-button-container">
                        <a href="choose.php">
                        <div class="nav-button">
                            Sign up
                        </div>
                    </a>
                    </li>
                </ul>
            </nav>

            <div class="hamburger">
                <div class="bar bar-one"></div>
                <div class="bar bar-one"></div>
                <div class="bar bar-one"></div>
            </div>
        </div>

        <div class="mobile-link-container">
            <nav class="mobile-nav">
                <ul class="mobile-link">
                    <div class="mobile-link-header-container">
                        <i class="close-btn fa-sharp fa-solid fa-square-xmark"></i>
                        <li class="mobile-link-header">Navigation</li>
                    </div>
                    <li><a href="#">Home</a></li>
                    <li><a href="findjob.php">Find job</a></li>
                    <li><a href="findtalent.html">Find Talent</a></li>
                    <li><a href="aboutus.html">About Us</a></li>
                    <li><a href="choose.php">Sign up</a></li>
                    <li><a href="login.php">Log in</a></li>
                </ul>
            </nav>
        </div>
        
        <div class="head-container">
            <div class="slogan">
                <h1>Discover And Get Your Dream Job</h1>
                <p class="slogan-paragraph">There are over 10,000 job around the world waiting for you</p>
                <div class="search-bar-container">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input class="search-bar" type="text" placeholder="Job Title">
                    <button class="search-button">Search</button>
                </div>
                <p class="searches">Popular searches: Web development, design</p>
            </div>

            <div class="image-container">
                <img src="images/home.png">
            </div>
        </div>
    </header>

    <section id="section-one">
        <h2>Popular job catagories</h2>
        <div class="row-one">
            <div class="boxes">
                <div class="box-image-container">
                    <img src="images/coding.png">
                </div>
                <p>WEB DEVELOPMENT</p>
            </div>

            <div class="boxes">
                <div class="box-image-container">
                    <img src="images/app-development.png">
                </div>
                <p>MOBILE DEVELOPMENT</p>
            </div>

            <div class="boxes">
                <div class="box-image-container">
                    <img src="images/document.png">
                </div>
                <p>ACCOUNTING</p>
            </div>


            <div class="boxes">
                <div class="box-image-container">
                    <img src="images/notes.png">
                </div>
                <p>WRITING</p>
            </div>
        </div>

        <div class="row-two">
            <div class="boxes">
                <div class="box-image-container">
                    <img src="images/customer-service.png">
                </div>
                <p>CUSTOMER SERVICE</p>
            </div>

            <div class="boxes">
                <div class="box-image-container">
                    <img src="images/acquisition.png">
                </div>
                <p>SALES</p>
            </div>

            <div class="boxes">
                <div class="box-image-container">
                    <img src="images/project-management.png">
                </div>
                <p>MANAGEMENT</p>
            </div>

            <div class="boxes">
                <div class="box-image-container">
                    <img src="images/web-design.png">
                </div>
                <p>DESIGN</p>
            </div>
        </div>
    </section>


    <section id="section-two">
        <div class="people-first-solution-container">
            <div class="people-fist-solution">
                <h3>People FIrst Solutions</h3>
                <p>What Ever the problem your facing in your business people are the solution,
                    we have great skilled people waiting to give a value to your company
                </p>
            </div>

            <div class="people-first-solution-img">
                <img src="images/people-first-solutions.png">
            </div>
        </div>
    </section>

    <section id="section-three">
        <div class="fast-and-flexible-container">
            <div class="fast-and-flexible-img">
                <img src="images/fast-and-flexible-recruiting.png">
            </div>

            <div class="fast-and-flexible">
                <h3>Fast And Flexible For Your Job Haunting</h3>
                <p>Are you looking for a job, and not having much luck?
                    Are you tired of sending out resumes and cover letters,
                    only to hear nothing back? It may be time to try something different,
                    try us. we can help you get your dream job
                </p>
            </div>
        </div>
    </section>

    <section id="section-four">
        <div class="find-job-container">
            <h3>FIND JOBS</h3>
            <ol>
                <li>Create an account</li>
                <li>Explore job opportunities</li>
                <li>Find the most suitable job</li>
                <li>Finally apply for it</li>
            </ol>
            <div class="start-btn">
                <a href="findjob.php">START</a>
            </div>
        </div>

        <div class="find-talent-container">
            <h3>FIND TALENT</h3>
            <ol>
                <li>Create an account</li>
                <li>Explore resume of candidates</li>
                <li>Find the most suitable candidate</li>
                <li>Negotiate and hire</li>
            </ol>
            <div class="start-btn">
                <a href="findtalent.html">START</a>
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


    <script src="script/hamburger.js" charset="utf-8"></script>
</body>

</html>