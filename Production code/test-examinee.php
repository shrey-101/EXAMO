<?php
include 'database.php';
include 'function.php';
session_start();

if(isset($_SESSION['ID'])){
    $id = $_SESSION['ID'];
    $fullname = getname($id);
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
if(checkProctor($id)){
    header("location: test-proctor.php?exam_id=$exam_code");
}

// CHECK IF EXAM CODE EXIEST OR NOT
// CHECK IF USER HAS JOINED THE TEST OR NOT
// CHECK IF TIME HAS COMMENCED OR NOT

if(examattempt($email,$exam_code)){
    header("location: dashboard-examinee.php");
 }
?>
<?php
  $sql = "SELECT * FROM exams WHERE exam_code = '$exam_code'";
  $result =$conn->query($sql);
  if($result->num_rows > 0){
  $row= $result->fetch_assoc();
  $dateshedule = $row['dateOf'];
  $timestart = $row['timestart'];
  $timeend = $row['timeend'];
  $qtype = $row['exam_type'];
  $exam_name =$row['exam_name'];
  if(checkifstart($dateshedule, $timestart, $timeend)){
    if($qtype == "mcq"){
        include 'test-obj.php';
        if(examattempt($email,$exam_code)){
           //  header("location: dashboard-examinee.php");
        }
        else{
            $SQL = "INSERT INTO exam_attempt (email, exam_code) VALUES ('$email', '$exam_code')";
            $conn->query($SQL);
        }
    }
    else{
        include 'test-sub.php';
        if(examattempt($email,$exam_code)){
          //  header("location: dashboard-examinee.php");
        }
        else{
            $SQL = "INSERT INTO exam_attempt (email, exam_code) VALUES ('$email', '$exam_code')";
            $conn->query($SQL);
        }
    }


  }
  else{
      echo "SORRY THIS CANNOT BE PROCEEDED DUE TO TIME LIMITATION";
  }


  }
  else{
      echo "Sorry Question not added";
  }

?>



</body>
</html>