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



$sql = "SELECT * FROM exams WHERE exam_code = '$exam_code'";
$result = $conn->query($sql);
if($result->num_rows){
    $row = $result->fetch_assoc();
    $exam_name = $row['exam_name'];
    $start_time = $row['timestart'];
    $end_time = $row['timeend'];
    $dateOf = $row['dateOf'];
    $qtype = $row['exam_type'];
    $noQuestion = $row['noQuestion'];

// if(checkifstart($dateOf, $start_time, $end_time)){
//     header("location: proctor-stream.php?exam_code=$exam_code");
// }
}
else{
    header("location: dashboard-proctor.php");
}


?>

<?php
    if(isset($_POST['updateform'])){
        $sql = "UPDATE exams SET exam_name = '" . $_POST['examname'] . "', timestart = '" . $_POST['start_time'] . "', timeend = '" . $_POST['end_time'] . "', dateOf = '" . $_POST['dateOf'] ."' WHERE exam_code = '". $exam_code . "'";
        if($conn->query($sql)){
            $sql4 = "SELECT * FROM question WHERE exam_code = '$exam_code'";
            $res2 = $conn->query($sql4);
            if($res2->num_rows == 0){
        if($qtype == 'subjective'){
            for($x = 1; $x <= $noQuestion; $x++){
                $temp = $_POST['questioninput' . $x];
                 $sqlcode = "INSERT INTO question (questioninput, exam_code) VALUE ('$temp', '$exam_code')";
               if(!$conn->query($sqlcode)){
                echo mysqli_error($conn);
               }
            }
        }
        else{

            for($x = 1; $x <= $noQuestion; $x++){
                $temp = $_POST['questioninput' . $x];
                $temp1 = $_POST['optioninput' . ($x -1)*4 + 1 ];
                $temp2 = $_POST['optioninput' . ($x -1)*4 + 2 ];
                $temp3 = $_POST['optioninput' . ($x -1)*4 + 3 ];
                $temp4 = $_POST['optioninput' . ($x -1)*4 + 4 ];
                 $sqlcode = "INSERT INTO question (questioninput,optioninput1, optioninput2, optioninput3, optioninput4, exam_code) VALUE ('$temp', '$temp1', '$temp2', '$temp3', '$temp4', '$exam_code')";
               if(!$conn->query($sqlcode)){
                echo mysqli_error($conn);
               }
               else{
                   header("location: test-proctor.php?exam_code=$exam_code");
               }
            }

        }
    }
    else{
        if($qtype == 'subjective'){
            $rown = $res2->fetch_assoc();
            for($x = 1; $x <= $noQuestion; $x++){
                $temp = $_POST['questioninput' . $x];
                $bemp = $_POST['questionid' . $x];
                 $sqlcode = "UPDATE question SET questioninput = '" . $temp . "' WHERE question_id = '" . $bemp . "'";
               if(!$conn->query($sqlcode)){
                echo mysqli_error($conn);
               }
            }
        }
        else{

            for($x = 1; $x <= $noQuestion; $x++){
                $temp = $_POST['questioninput' . $x];
                $bemp = $_POST['questionid' . $x];
                $temp1 = $_POST['optioninput' . ($x -1)*4 + 1 ];
                $temp2 = $_POST['optioninput' . ($x -1)*4 + 2 ];
                $temp3 = $_POST['optioninput' . ($x -1)*4 + 3 ];
                $temp4 = $_POST['optioninput' . ($x -1)*4 + 4 ];
                 $sqlcode = "UPDATE question SET questioninput = '" . $temp . "', optioninput1 = '" . $temp1 . "' , optioninput2 = '" . $temp2 . "', optioninput3 = '" . $temp3 . "' , optioninput4 = '" . $temp4 . "' WHERE question_id = '" . $bemp . "'";
               if(!$conn->query($sqlcode)){
                echo mysqli_error($conn);
               }
               else{
                   
               }
            }

        }
        header("location: test-proctor.php?exam_code=$exam_code");
    }
    }
    else{
        echo "Database error  ". mysqli_error($conn);
    }
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
                <li><a href="index.php" class="active">Home</a> </li>
                <li><a href="">About</a></li>
                <li><a href="">Services</a></li>
                <li><a href="">Contact Us</a></li>
                <li><a href="dashboard-proctor.php" class="active"> DASHBOARD</a> </li>
            </div>
        </ul>

    </nav>


<div class="container left">
<div class="centered1">
    <!-- <?php getquestions($exam_code) ?> -->
  
    <form action="" method="POST">
       
    <label>  Exam Name :  </label>  <input type="text" name ="examname" value="<?php echo "$exam_name" ?>" > <br><br>
    <label>  Exam code :  </label>  <input type="text" value="<?php echo "$exam_code" ?>" readonly > <br><br>
    <label>  Start Time :  </label>  <input type="time" name= "start_time" value="<?php echo "$start_time" ?>" > <br><br>
    <label>  End Time :  </label>  <input type="time" name= "end_time" value="<?php echo "$end_time" ?>" > <br><br>
    <label>  Date of exam :  </label>  <input type="date" name= "dateOf" value="<?php echo "$dateOf" ?>" > <br><br>
    <label>  Question type :  </label>  <input type="text"  value="<?php echo "$qtype" ?>" readonly> <br><br><br><br>
    <center><h3 class="breakarrow">QUESTIONS</h3></center>
    <br><br>
    <?php

    $sql = "SELECT * FROM question WHERE exam_code = '$exam_code'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $x = 1;
       
         if($qtype == 'subjective'){
       while( $row2 = $result->fetch_assoc()){
            echo
            '
            <label> Question ' . $x . ': </label>
            <input type="text" name="questioninput' . $x . '" value="' . $row2['questioninput'] . '"> <br><br>
            <input type="text" name="questionid' . $x . '" value="' . $row2['question_id'] . '" hidden>
            ';
            $x++;
        }
    }
    else{
        while( $row2 = $result->fetch_assoc()){
            echo
            '
            <label> Question ' . $x . ': </label>
            <input type="text" name="questioninput' . $x .'" value="' .  $row2['questioninput'] .' "> <br><br>
            <input type="text" name="questionid' . $x . '" value="' . $row2['question_id'] . '" hidden>
            <label for="option"> Option ' . ($x -1)*4 + 1 . ': </label>
            <input type="text" name="optioninput' . ($x -1)*4 + 1 . '" value="' .  $row2['optioninput1'] . '"> <br><br>
            <label for="option"> Option ' . ($x -1)*4 + 2 . ': </label>
            <input type="text" name="optioninput' . ($x -1)*4 + 2 . '" value="' .  $row2['optioninput2'] . '"> <br><br>
            <label for="option"> Option ' . ($x -1)*4 + 3 . ': </label>
            <input type="text" name="optioninput' . ($x -1)*4 + 3 . '" value="' .  $row2['optioninput3'] . '"> <br><br>
            <label for="option"> Option ' . ($x -1)*4 + 4 . ': </label>
            <input type="text" name="optioninput' . ($x -1)*4 + 4 . '" value="' .  $row2['optioninput4'] . '"> <br><br>
          
            ';
            $x++;
        }
    }
}
else{
    if($qtype == 'subjective'){
        for($x = 1; $x <= $noQuestion; $x++){
            echo
            '
            <label> Question ' . $x . ': </label>
            <input type="text" name="questioninput' .$x .'" > <br><br>
            ';
        }
    }
    else{
        for($x = 1; $x <= $noQuestion; $x++){
            echo
            '
            <label> Question ' . $x . ': </label>
            <input type="text" name="questioninput' . $x . '" > <br><br>

            <label for="option"> Option 1 : </label>
            <input type="text" name="optioninput' . ($x -1)*4 + 1 . '" > <br><br>
            <label for="option"> Option 2 : </label>
            <input type="text" name="optioninput' . ($x -1)*4 + 2 . '" > <br><br>
            <label for="option"> Option 3 : </label>
            <input type="text" name="optioninput' . ($x -1)*4 + 3 . '" > <br><br>
            <label for="option"> Option 4 : </label>
            <input type="text" name="optioninput' . ($x -1)*4 + 4 . '" > <br><br>

            ';
        }
    }
}

    echo '
    <center><input type="submit" name="updateform" value="save"></center>
    ';
    ?>

    </form>

<br><br><br><br><br><br><br><br><br><br><br><br>

</div>
</div>
<div class="container right">

    
    <?php
    $sql = "SELECT * FROM exam_join WHERE exam_code = '$exam_code'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo '
        <h2> Joined students </h2> <br><br>
        ';
        while($row = $result->fetch_assoc()){
            $email = $row['email'];
            $sql2 = "SELECT fullname FROM userinfo WHERE email = '$email'";
            $result2 = $conn->query($sql2);
            if($result2->num_rows > 0){
            $row2 = $result2->fetch_assoc();
            $name  = $row2['fullname'];
            echo '
           <fieldset style="padding: 10px 20px"> <b style="font-size:large">' . $name . ' </b> &nbsp&nbsp <i>' . $email  . ' </i> <br>
           <center> <a href="answer-submissions.php?exam_code=' . $exam_code . '&email=' . $email . '"> View Answer </a> </center>
           </fieldset>
            ';}
            else{

            }
        }

    }
    else{
        echo '
       <i style="font-size:x-large"> No user has joined this test </i>
        ';
    }
    ?>
 
</div>


<!-- 
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
    </footer> -->
</body>
</html>