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

if(!checkProctor($id)){
    header("location: index.php");
}



?>