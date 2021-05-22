<?php


function checklogin($email, $psw)
{
    include 'database.php';
    $psw = md5($psw);
    $sql = "SELECT fullname,psw from userinfo WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result!= FALSE && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($psw == $row['psw']) {
           
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

function ifemailexiest($email){
    include 'database.php';
    $sql = "SELECT fullname,psw from userinfo WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result!= FALSE && $result->num_rows > 0) {
        return 1;
    }
    else {
    return 0;
    }
}

function createexam(){

}

function load_class($email){
    include 'database.php';
    $sql = "SELECT * FROM rooms WHERE proctor = '$email' ORDER BY room_id DESC";
    $result = $conn->query($sql);
    if($result!= FALSE && $result->num_rows > 0){
        $num = $result->num_rows - 1;
        echo '
        <thead>
        <tr>
            <th scope="col">S. No.</th>
            <th scope="col">Class Name</th>
            <th scope="col">Class Code</th>
            <th scope="col">Visit</th>
        </tr>
    </thead>
    <tbody>
        ';
        while($row = $result->fetch_assoc()){
            $room_name = $row['room_name'];
            $room_code = $row['room_code'];
                echo '<tr><th scope="row">';
                echo $result->num_rows - $num;
                 echo '</th><td>';
                echo $room_name;
                echo '</td><td>';
                echo $room_code;
                echo '</td><td><a href="room-proctor.php?room_code=';
                echo $room_code;
                echo '" class="btn1" style=" padding-right: 40px;padding-left: 40px;background-color: rgb(115, 247, 203);color: rgb(41, 41, 80);font-size:medium">Open</a></td></tr>';
            $num--;
        }
        echo '
        </tbody>
        ';
    }
    else{
        echo "<i> No Classes avilable </i>";
    }
}

function createclass($class_name, $email){
$class_code = createclasscode();
include 'database.php';

$sql4 = "SELECT * FROM userinfo WHERE email = '$email'";
$result2 = $conn->query($sql4);
$row2 = $result2->fetch_assoc();
$user_name = $row2['fullname'];
$user_code = $row2['usercode'];
$class_name = filter_var($class_name, FILTER_SANITIZE_STRING);
$sql = "INSERT into rooms (room_name, room_code, proctor) VALUES ('$class_name', '$class_code', '$email')";
if($conn->query($sql)){
    $sql2 = "CREATE TABLE $class_code ( ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, user_code VARCHAR(7) NOT NULL , user_name TEXT NOT NULL , rolelevel TEXT NOT NULL , datejoin DATE NOT NULL )";
    $sql3 = "INSERT INTO $class_code (user_code, user_name, rolelevel) values ('$user_code','$user_name', 'proctor')";
    if($conn->query($sql2) && $conn->query($sql3)){
    $alert = "class created sucessfully";
    }
    else{
    $alert = "Error creating table: " . mysqli_error($conn);
    }
}
else{
    echo "Error creating table: " . mysqli_error($conn);
    $alert = "Error in creating class please try after sometime";
}
return $alert;
}

function createclasscode(){
    include 'database.php';
    $n = 7;
    $result = bin2hex(random_bytes($n));
    
    $sql = "SELECT room_id FROM rooms where room_code = '$result'";
    if($conn->query($sql)->num_rows > 0){
        createclasscode();
    }
    else{
        return $result;
    }
}


function createusercode(){
    include 'database.php';
    $n = 8;
    $result = bin2hex(random_bytes($n));
    
    $sql = "SELECT id FROM userinfo where usercode = '$result'";
    if($conn->query($sql)->num_rows > 0){
        createusercode();
    }
    else{
        return $result;
    }
}



function createexamcode(){
    include 'database.php';
    $n = 12;
    $result = bin2hex(random_bytes($n));
    
    $sql = "SELECT id FROM userinfo where usercode = '$result'";
    if($conn->query($sql)->num_rows > 0){
        createexamcode();
    }
    else{
        return $result;
    }
}

function getexams($email){
    include 'database.php';
    $sql = "SELECT * FROM exams WHERE proctor = '$email' ORDER BY exam_id DESC";
    $result = $conn->query($sql);
    if( $result!= FALSE && $result->num_rows > 0){
        $num = $result->num_rows - 1;
        echo '
        <thead>
        <tr>
            <th scope="col">S. No.</th>
            <th scope="col">Exam Name</th>
            <th scope="col">Date</th>
            <th scope="col">Exam Code</th>
            <th scope="col">Visit</th>
        </tr>
    </thead>
    <tbody>
        ';
        while($row = $result->fetch_assoc()){
                echo '<tr><th scope="row">';
                echo $result->num_rows - $num;
                 echo '</th><td>';
                echo $row['exam_name'];
                echo '</td><td>';
                echo $row['dateOf']. " " . $row['timestart']. "-" . $row['timeend'];
                echo '</td><td>' . $row['exam_code'];
                echo '</td><td><a href="test-proctor.php?exam_code=';
                echo $row['exam_code'];
                echo '" class="btn1" style=" padding-right: 40px;padding-left: 40px;background-color: rgb(115, 247, 203);color: rgb(41, 41, 80);font-size:medium">Open</a></td></tr>';
            $num--;
        }
        echo '
        </tbody>
        ';
    }
    else{
        echo "<i> No Classes avilable </i>";
    }
}

function checkProctor($id){
    include 'database.php';
    $sql = "SELECT rolelevel FROM userinfo WHERE id = '$id'";
    $result = $conn->query($sql);
    if($result->num_rows){
        $row= $result->fetch_assoc();
    }
    $rolelevel = $row['rolelevel'];
    if($rolelevel == 'proctor'){
        return 1;
    }
    else{
        return 0;
    }

}


function getquestions($exam_code){
    include 'database.php';
    $sql = "SELECT * FROM exams WHERE exam_code = '$exam_code'";
    if($conn->query($sql)){
        
    }
    else{

    }
}

function join_test($exam_code, $email){
    include 'database.php';
    $sql = "SELECT * FROM exam_join WHERE email = '$email' and exam_code = '$exam_code'";
    if($conn->query($sql)->num_rows > 0){
        return "Test already exiest";
    }
    else{
        $sql = "INSERT INTO exam_join (exam_code, email, rolelevel) VALUES ('$exam_code', '$email' , 'examinee')";
        if($conn->query($sql)){
            return "successfully added";
        }
        else{
            return "Error occured" . mysqli_error($conn);
        }
    }
}


function load_exam($email){
    include 'database.php';
    $sql = "SELECT * FROM exam_join WHERE email = '$email' ORDER BY id DESC";
    $result = $conn->query($sql);
    if( $result!= FALSE && $result->num_rows > 0){
        $num = $result->num_rows - 1 ;
        $num = $result->num_rows - 1;
        echo '
        <thead>
        <tr>
            <th scope="col">S. No.</th>
            <th scope="col">Exam Name</th>
            <th scope="col">Date</th>
            <th scope="col">Exam Code</th>
            <th scope="col">Visit</th>
        </tr>
    </thead>
    <tbody>
        ';
        while($row = $result->fetch_assoc()){
            $exam_code = $row['exam_code'];
            $sql2 = "SELECT * FROM exams WHERE exam_code = '$exam_code'";
            $result2 = $conn->query($sql2);
            if( $result2!= FALSE && $result2->num_rows > 0){
            $row2 = $result2->fetch_assoc();
                echo '<tr><th scope="row">';
                echo $result->num_rows - $num;
                 echo '</th><td>';
                echo $row2['exam_name'];
                echo '</td><td>';
                echo $row2['dateOf']. " " . $row2['timestart']. "-" . $row2['timeend'];
                echo '</td><td>' . $row2['exam_code'];
                echo '</td><td><a href="test-examinee.php?exam_code=';
                echo $row2['exam_code'];
                echo '" class="btn1" style=" padding-right: 40px;padding-left: 40px;background-color: rgb(115, 247, 203);color: rgb(41, 41, 80);font-size:medium">Open</a></td></tr>';
            $num--;}
            else{
                echo "error " . mysqli_error($conn); 
            }
        }
        echo '
        </tbody>
        ';
    }
    else{
        echo "<i> No Test avilable </i>";
    }
}

function checkifstart($dateOf, $timestart, $timeend){
    $mydate=getdate(date("U"));
    $todaydate = $mydate['year'] . "-" . $mydate['mon'] . "-" . $mydate['mday'];
    $dateOf = strtotime($dateOf);
    $todaydate = strtotime($todaydate);

    if($dateOf == $todaydate){
        $todaytime = $mydate['hours'] . ":" . $mydate['minutes'] . ":" . $mydate['seconds'];
        $todaytime = strtotime($todaytime) + 12601;
        $timestart = strtotime($timestart);
        $timeend = strtotime($timeend);
        if($todaytime >= $timestart && $todaytime < $timeend){
            return 1;
        }
        else{
            return 0;
        }

    }
    else{
        return 0;
    }
}

function examattempt($email, $exam_code){
    include 'database.php';
    $sql = "SELECT * FROM exam_attempt WHERE email = '$email' AND exam_code = '$exam_code'";
    $resul = $conn->query($sql);
    if($resul->num_rows  > 0){
        return 1;
    }
    else{
        return 0;
    }
}

function getname($id){
    include 'database.php';
    $sql = "SELECT fullname from userinfo WHERE id= '$id'";
    $resul = $conn->query($sql);
    $row = $resul->fetch_assoc();
    return $row['fullname'];
}
?>
