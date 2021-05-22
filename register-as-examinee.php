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
    $usercode = createusercode();
    $target_dir = "uploads/";
    $target_file = $target_dir . $email. '.png';
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



if(!ifemailexiest($email)){

// image upload script starts
// start

$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($check !== false) {
  echo "File is an image - " . $check["mime"] . ".";
  $uploadOk = 1;
} else {
  echo "File is not an image.";
  $uploadOk = 0;
}


// Check if file already exists
if (file_exists($target_file)) {
echo "Sorry, file already exists.";
$uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
echo "Sorry, your file is too large.";
$uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
$uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
} else {
  echo "Sorry, there was an error uploading your file.";
}
}

// image upload script ends
//end
if($uploadOk){
        $sql = "INSERT into userinfo (fullname, email, psw, institute, rolelevel, verified, usercode) VALUES ('$fullname', '$email', '$psw', '$institute', 'examinee', 'yes', '$usercode')";
        if($conn->query($sql)){
           $last_id = $conn->insert_id;
           session_start();
           $_SESSION['email'] = $email;
           $_SESSION['ID'] = $last_id;

           header("location: dashboard-examinee.php");
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        }
    else{
        $email_err = "email already Registered";
    }
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
    <title>Examo | Register as EXAMINEE</title>
</head>
<body>
    <!-- Navbar code here-->
<!-- navbar -->
<nav class="navbar">
    <ul class="nav-list background">
    <div class="logo"><a href="index.php">EXAMO </a></div>
        <div class="list-items">
            <div class="input"> <form action="http://localhost/ext/script.php" method="POST"><input type="email" placeholder="USER-ID" name="email">
                <input type="password" placeholder="Password" name="psw">
            </div>
            <li><input type="submit" name="submit"></li></form>
            <li><a href="homepage.html" class="active">Home</a> </li>
            <li><a href="">About</a></li>
            <li><a href="">Services</a></li>
            <li><a href="">Contact Us</a></li>
        </div>
    </ul>

</nav>

<!-- Form-->
    <section class="register-form">
        <h2><center>REGISTER AS EXAMINEE</center></h2> <br>
       <form action="" method="POST" enctype="multipart/form-data">
        <label for="name"> Name: </label> <br>
        <input type="text" id="fullname" name="fullname" required placeholder="Enter your full Name" autocomplete="name"/> <br><br>
        <label for="email">E-mail: </label> <br>
        <input type="email" id="email" name="email" required placeholder="Enter Email"/> <br>
        <span><?php echo "$email_err" ?></span> <br>
        <label for="psw">Password: </label> <br>
        <input type="password" id="psw" name="psw" required placeholder="Enter Password"/> <br><br>
        <label for="institute">Institute/company name: </label> <br>
        <input type="text" id="institute" name="institute" required placeholder="Enter your institute name"/> <br><br>
        <label for="institute">Upload photo: </label> <br><br>
        <input type="file" name="fileToUpload" id="fileToUpload" required> <br><br>
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

<script>
function login(){
    
}
</script>

</body>
</html>