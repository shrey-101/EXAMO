<?php
include 'database.php';
include 'function.php';
$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
$psw = filter_var($_POST['psw'], FILTER_SANITIZE_STRING);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Welcome | examo </title>
</head>
<body>
<?php
if(checklogin($email, $psw) > 0){
    $sql = "SELECT * FROM userinfo where email = '$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $id = $row['id'];
    session_start();
    $_SESSION['ID'] = $id;
    $_SESSION['email'] = $email;
    $rolelevel = $row['rolelevel'];
    if($rolelevel == 'proctor'){
     header("location: dashboard-proctor.php"); 
    }
    elseif($rolelevel == 'examinee') {
      header("location: dashboard-examinee.php"); 
    }

}
else{
    echo "incorrect Login Details";
    header("location: index.php");
}

?>
</body>
</html>