<?php
include 'database.php';

$exam_code = $_GET['exam_code'];
$email = $_GET['email'];

$sql = "SELECT * FROM answer WHERE exam_code= '$exam_code' AND email ='$email'";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $question_id = $row['question_id'];
        $sql2 = "SELECT * FROM question where question_id = '$question_id'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        echo '
        Question : ' . $row2['questioninput'] . ' : <br>
        Answer :  ' . $row['answersub'] .  $row['answermcq'] . '<br>';
    }
}
else{
    echo 
    $email . ' has not submitted yet
    ';
}

?>