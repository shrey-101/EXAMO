<?php
session_start();
if(isset($_SESSION['ID'])){
$id = $_SESSION['ID'];
$email = $_SESSION['email'];

include 'database.php';
include 'function.php';
$sql = "SELECT * FROM USERINFO where id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$user_code = $row['usercode'];
$rolelevel = $row['rolelevel'];
if($rolelevel != 'proctor'){
    header("Location: dashboard-examinee.php");
}
$fullname = $row['fullname'];
$institute = $row['institute'];

$alert = "Sucessfully created";
if(isset($_POST['newclasssubmit'])){
    $newclassname = $_POST['newclassname'];
    $alert = createclass($newclassname, $email);
}

}
else{
   header("Location: index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style-after-registration.css">
    <title> Examo | Dashboard </title>
</head>

<body>
    <!-- <script>
        console.log("hello world");
document.addEventListener("visibilitychange", function() {
 var x = document.getElementById("submittest");
 x.click();
})
    </script> -->
    <!-- navbar -->
    <nav class="navbar">
        <ul class="nav-list background">
            <div class="logo"><a href="index.php">EXAMO </a></div>
            <div class="list-items">
                <div class="input">
                <li><a href="homepage.html" class="active">Home</a> </li>
                <li><a href="">About</a></li>
                <li><a href="">Services</a></li>
                <li><a href="">Contact Us</a></li>
                <li><a href="#"><?php echo "$fullname" ?></a></li>
                <li><a href="logout.php">Logout</a></li>
            </div>
        </ul>

    </nav>

    <center><a href="create-test.php" class="butt2">Create Test</a></center>
<!-- 
    <div class="butt2" onclick="pop()" type="button">Create New Class</div>
    
      <div id="box">
    
        <h1> Create Class </h1>
        <form action="" method="POST">
            <b><p> Class Name: <input type="text" name="newclassname" autocomplete="off" required></p></b>
      
        <div class="bt">
            <input class="btt" type="submit"  name="newclasssubmit" value="Create">
            <div class="btt" onclick="pop()" type="button">Cancel</div>
        </div>
        </form>
      </div> -->

    <section>
        <table class="table table-bordered border-light table-dark table-hover">
           
                <p id="classlist"> <i> <?php getexams($email) ?> </i> </p>
              
                
           
        </table>
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

    <?php
    if(isset($alert) && $alert!= ''){
        echo '<div id="snackbar">';
            echo $alert;
            echo '</div>';

    }
    ?>
    <script>
document.onload(myFunction());
        var modal = null

 function pop() {

   if(modal === null) {

     document.getElementById("box").style.display = "block";

     modal = true

   } else {

     document.getElementById("box").style.display = "none";

     modal = null

   }

 }
 function myFunction() {
  // Get the snackbar DIV
  var x = document.getElementById("snackbar");

  // Add the "show" class to DIV
  x.className = "show";

  // After 3 seconds, remove the show class from DIV
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
    </script>
</body>

</html>