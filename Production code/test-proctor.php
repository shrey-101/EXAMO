<?php
include 'database.php';
include 'function.php';
session_start();

if(isset($_SESSION['ID'])){
    $id = $_SESSION['ID'];
    $email = $_SESSION['email'];
    if(isset($_GET['exam_code'])){
    $exam_code = $_GET['exam_code'];
    }
    else{
        header("location: index.php");
    }
}
else{
    header("location: index.php");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="room-proctor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title> Room | Examo </title>
</head>
<body>
<nav class="navbar">
        <div class="logo"><a href="">EXAMO</a></div>
        <ul class="nav-list background">

            <div class="list-items">
                <li><a href="homepage.html" class="active">Home</a> </li>
                <li><a href="">About</a></li>
                <li><a href="">Services</a></li>
                <li><a href="">Contact Us</a></li>
            </div>
        </ul>

    </nav>

<div class="container">
<div class="split left">
    <?php getquestions($exam_code) ?>
</div>
<div class="split right">
    
</div>
</div>


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