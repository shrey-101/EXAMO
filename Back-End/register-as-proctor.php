<?php
include 'database.php';
include 'function.php';

$email_err= '<br>'; 
$password_err = '<br>';
if(isset($_POST['register'])){

    $fullname = strtoupper($_POST['fullname']);
    $email = $_POST['email'];
    $institute = $_POST['institute'];
    $psw =  $_POST['psw'];
    $psw = md5($psw);

    if(!ifemailexiest($email)){
        $sql = "INSERT into userinfo (fullname, email, psw, institute, rolelevel, verified) VALUES ('$fullname', '$email', '$psw', '$institute', 'proctor', 'yes')";
        if($conn->query($sql)){
           $last_id = $conn->insert_id;
           session_start();
           $_SESSION['email'] = $email;
           $_SESSION['ID'] = $last_id;

           header("location: dashboard-proctor.php");
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        }
    else{
        $email_err = "email already exiest";
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
    <link rel="stylesheet" href="register-style.css">
    <title>Examo | Register as Proctor</title>
</head>
<body>
    <!-- Navbar code here-->
<!-- navbar -->
<nav class="navbar">
    <ul class="nav-list background">
        <div class="logo">EXAMO</div>
        <div class="list-items">
            <div class="input"> <form action="" method="POST"><input type="email" placeholder="USER-ID">
                <input type="password" placeholder="Password">
            </div>
            <li><a href="login()">Login</a></li></form>
            <li><a href="homepage.html" class="active">Home</a> </li>
            <li><a href="">About</a></li>
            <li><a href="">Services</a></li>
            <li><a href="">Contact Us</a></li>
        </div>
    </ul>

</nav>

<!-- Form-->
    <section class="register-form">
        <h2><center>REGISTER AS PROCTER</center></h2> <br>
       <form action="http://localhost/ext/register-as-proctor.php" method="POST">
        <label for="name"> Name: </label> <br>
        <input type="text" id="fullname" name="fullname" required placeholder="Enter your full Name" autocomplete="name"/> <br><br>
        <label for="email">E-mail: </label> <br>
        <input type="email" id="email" name="email" required placeholder="Enter Email"/> <br>
        <span><?php echo "$email_err" ?></span> <br>
        <label for="psw">Password: </label> <br>
        <input type="password" id="psw" name="psw" required placeholder="Enter Password"/> <br><br>
        <label for="institute">Institute/company name: </label> <br>
        <input type="text" id="institute" name="institute" required placeholder="Enter your institute name"/> <br><br>
        <input type="checkbox" required> <label>Agree to our <a href="#"> T & C</a></label> <br><br>
        <center><input type="submit" name="register" value="Register"></center>
       </form>
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