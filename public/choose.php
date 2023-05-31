<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/choose.css">
</head>
<body>
    <div class="nav_container">
        <nav>
            <ul class="nav_one">
                <li>
                    <a href="index.html">
                        <img class="logo_img" src="images/logo.png" alt="Afrihire Logo">
                    </a>
                </li>
				
                <li class="nav_item">
                    <a href="aboutus.html">About Us</a>
                </li>
            </ul>
        </nav>
    </div>
    <form action="../src/controller/seekerOrCompany.php" method="POST">
        <div class="main-container">
            <div>
                <h1>Join Us as a Company or Job Seeker</h1>
            </div>
            <div class="container">
                <label class="radio-label">
                    <input type="radio"  value="1" name="choice">
                    <div class="radio-image">
                        <img src="images/company.jpg" alt="">
                    </div>
                    <p>Company</p>
                </label>
                <label class="radio-label">
                    <input type="radio" value="2" name="choice">
                    <div class="radio-image">
                        <img src="images/seeker.jpg" alt="">
                    </div>
                    <p>Job Seeker</p>
                </label>
            </div>
            <div class="btn">
                <button type="submit">Next</button>
            </div>
        </div>
    </form>
    <div class="last">
        <p>Already have an account? <a href="Login.html">Log in →</a></p>
    </div>
</body>
</html>
