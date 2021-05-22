<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Examo</title>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar">
        <ul class="nav-list background">
        <div class="logo"><a href="index.php" style="color: powerblue">EXAMO </a></div>
        <div class="list-items">
            <div class="input"> <form action="http://localhost/ext/script.php" method="POST"><input type="email" placeholder="USER-ID" name="email">
                <input type="password" placeholder="Password" name="psw">
            
            <input type="submit" name="submit" value="log In" style="background-color: green; color: white; padding: 0px 15px;"></form></div>
                <li><a href="homepage.html" class="active" style="color: powerblue">Home</a> </li>
                <li><a href="about.html">About</a></li>
                <li><a href="">Services</a></li>
                <li><a href="contact-us.html">Contact Us</a></li>
            </div>
        </ul>

    </nav>

    <section class="firstsection ">
        <div class="box-main">
            <div class="firsthalf">
                <p class="text-big">The Best Exam Site</p>
                <hr>
                <p class="text-small">With online education reaching every corner, our web app that provides a platform
                    for users to conduct and give exams in a secure environment.
                    Our features include camera and microphone detection, making sure that the examine
                    does not open other search tabs or use similar applications, providing ease of control for the
                    proctor and many more
                    This web-app can be easily used by schools, colleges, companies, etc
                    for conducting fair examinations/interviews. So join us with our journey here at EXAMO.
                </p>
                <div class="buttons">
                    <a href="register-as-proctor.php" class="btn">Register as proctor</a>
                    <a href="register-as-examinee.php" class="btn">Register as student</a>
                </div>
            </div>
            <div class="secondhalf">
                <img src="exam.jpg" alt="image">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="foot">
        <div class="icons">
            <ul class="icons-list">
                <li><a href="#" class="fa fa-facebook"></a></li>
                <li><a href="#" class="fa fa-twitter"></a></li>
                <li><a href="#" class="fa fa-github"></a></li>
                <li><a href="#" class="fa fa-linkedin"></a></li>
            </ul>
        </div>
        <div class="copyRight">
            Copyright - @NaughtyCoders 2021
        </div>
    </footer>
</body>

</html>
