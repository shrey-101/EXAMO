<?php
include'database.php';
include'function.php';
session_start();
if(!isset($_SESSION['ID'])){
    header("location: index.php");
}
$id = $_SESSION['ID'];
$email = $_SESSION['email'];
if(!checkProctor($id)){
    header("location: index.php");
}
if(isset($_POST['submit'])){
    $exam_code = createexamcode();
$examname = $_POST['examname'];
$starttime = $_POST['starttime'];
$endtime = $_POST['endtime'];
$dateofExam = $_POST['dateofExam'];
$qtype = $_POST['qtype'];
$noQuestion = $_POST['noQuestion'];

$sql = "INSERT INTO exams (exam_code, exam_name, exam_type, dateOf, timestart, timeend, proctor) values ('$exam_code', '$examname', '$qtype', '$dateofExam', '$starttime', '$endtime', '$email') ";
if($conn->query($sql)){
    $sqlcode = 'CREATE TABLE ' . $exam_code . '( ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, exam_name TEXT NOT NULL ,';
    if($qtype == 'mcq'){
        for($num = 1; $num <= $noQuestion; $num++){
            $sqlcode .= ' inputquestion'. $num . ' TEXT NOT NULL ,';
            $sqlcode .= ' inputoption'. ($num - 1) * 4 + 1 . ' TEXT NOT NULL ,';
            $sqlcode .= ' inputoption'. ($num - 1) * 4 + 2 . ' TEXT NOT NULL ,';
            $sqlcode .= ' inputoption'. ($num - 1) * 4 + 3 . ' TEXT NOT NULL ,';
            $sqlcode .= ' inputoption'. ($num - 1) * 4 + 4 . ' TEXT NOT NULL ,';
        }
    }
    else{
        for($num = 1; $num <= $noQuestion; $num++){
            $sqlcode .= ' inputquestion'. $num . ' TEXT NOT NULL ,';
        }
    }
    $sqlcode .= ' proctor TEXT NOT NULL)';


    $sql = "$sqlcode";
    if($conn->query($sql)){

    //     $sqlcode2 = "INSERT INTO " . $exam_code . "(examname, ";
    //     if($qtype == 'mcq'){
    //         for($num = 1; $num <= $noQuestion; $num++){
    //             $sqlcode2 .= ' inputquestion'. $num . ' ,';
    //             $sqlcode2 .= ' inputoption'. ($num - 1) * 4 + 1 . ' ,';
    //             $sqlcode2 .= ' inputoption'. ($num - 1) * 4 + 2 . ' ,';
    //             $sqlcode2 .= ' inputoption'. ($num - 1) * 4 + 3 . ' ,';
    //             $sqlcode2 .= ' inputoption'. ($num - 1) * 4 + 4 . ' ,';
    //         }
    //     }
    //     else{
    //         for($num = 1; $num <= $noQuestion; $num++){
    //             $sqlcode2 .= ' inputquestion'. $num . ' ,';
    //         }
    //     }
    //             $sqlcode2 .= ' proctor) VALUES ( ';

    //     if($qtype == 'mcq'){
    //         for($num = 1; $num <= $noQuestion; $num++){
    //             $sqlcode2 .= '\' inputquestion" . $num . \' ,';
    //             $sqlcode2 .= " inputoption". ($num - 1) * 4 + 1 . " ,";
    //             $sqlcode2 .= " inputoption". ($num - 1) * 4 + 2 . " ,";
    //             $sqlcode2 .= " inputoption". ($num - 1) * 4 + 3 . " ,";
    //             $sqlcode2 .= " inputoption". ($num - 1) * 4 + 4 . " ,";
    //         }
    //     }
    //     else{
    //         for($num = 1; $num <= $noQuestion; $num++){
    //             $sqlcode2 .= ' inputquestion'. $num . ' ,';
    //         }
    //     }
    //     $sqlcode2 .= '\' . $email) . \'';
    

        header("location: dashboard-proctor.php");
    }
    else{
        echo "Error creating table: " . mysqli_error($conn);
    }
}
else{
    echo "error occured";
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-create_test.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Create Exam</title>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar">
        <div class="logo"><a href="index.php" style="color: powerblue">EXAMO</a></div>
        <ul class="nav-list background">

            <div class="list-items">
                <li><a href="homepage.html" class="active">Home</a> </li>
                <li><a href="">About</a></li>
                <li><a href="">Services</a></li>
                <li><a href="">Contact Us</a></li>
            </div>
        </ul>

    </nav>
  
    <section class="firstsection">
        <div class="box-main">
            <h2>Create A New Exam</h2>
            <hr>
            <div class="info">

                <!--basic details form -->

                <div class="basic-details">
                    <span class="arrow">Basic Information</span>
                    <form action="" class="basic-info" method="POST">
                        <div>
                            <span class="form-details">Exam Name :</span>
                            <input type="text" class="detail-box" title="enter the exam name" placeholder="enter the exam name" name="examname" required>

                            <span class="form-details">Exam Duration :</span>
                            <input type="time" class="detail-box" title="Start of exam" name="starttime" required>to <input type="time" name="endtime" class="detail-box" title="End of exam" required>
                        </div>
                        <div>
                            <span class="form-details">Date of Exam :</span>
                            <input type="date" name="dateofExam" class="detail-box" placeholder="Enter date" style="width: 10rem;" id="dateOfExam" required >

                        </div>
                        <div>
                            <span class="form-details">Exam Type : </span>
                            <input type="radio" id="examtype1" name="qtype" value="mcq"><label for="examtype1" style="font-weight: 450;padding: 10px;">Multiple Choice
                                Questions(mcqs)</label>
                            <input type="radio" id="examtype2" name="qtype" value="subjective"><label for="examtype2" style="font-weight: 450;padding: 10px;">Subjective</label>
                        </div>
                        <div>
                            <span class="form-details">Number Of Questions :</span>
                            <input type="number" name="noQuestion" class="detail-box" placeholder="" style="width: 3rem;" id="noQuestions" required>
                            <a id="nextadd" style="padding: 5px 10px; background-color:red; color: white; font-size:medium"> Save </a>

                        </div>
                        <!-- <div>
                            <span class="form-details">Negative Marking :</span>
                            <input type="radio" id="n-mark1" name="negative-marking" class="radio"><label for="n-mark1" style="font-weight: 450;padding: 10px;">YES
                            </label>
                            <input type="radio" id="n-mark2" name="negative-marking" class="radio"><label for="n-mark2" style="font-weight: 450;padding: 10px;margin-right: 3rem;">NO</label>

                            <span class="form-details">Negative marks :</span>
                            <input type="number" class="detail-box" title="enter 0 for NO" id="marks" style="width: 3rem;"><label for="marks" style="background-color: rgb(19, 196, 196);
                            padding: 3px;
                            padding-inline: 10px;
                            margin-left: 1rem;
                            font-size: smaller;
                            border: none;
                            border-radius: 10px;
                            color: rgb(110, 100, 100);">enter
                                0 for NO</label>
                            <hr>

                         
                        </div>       -->
                            <center></center>
                            
                        <!-- Questions details  -->

                        <div class="ques-details">
                            <span class="arrow">Add Questions</span>
                            
                            <br><br>
                            <p id="question"> </p>
                            <br><br>
                            <center><input name="submit" type="submit" style="padding: 5px 10px; background-color:green; color: white; font-size:medium"></center>
                        </div>
                        
                    </form>
                </div>
            </div>
            <br><br><br><br><br><br><br>
        </div>
        
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
    function appendQuestionSub(num){
        
        var local = '<div style="border: 2px solid black" class="questioninput"> Question: '+ num +' <br> <textarea required style="width: 500px; font-size:medium; padding: 5px 15px" name="inputquestion'+num+'"> </textarea> <br> </div>';
        $("#question").append(local);            
    }

    function appendQuestionMcq(num){
        var local = '<div style="border: 2px solid black" class="questioninput"> Question: '+ num +' <br> <input required type="text" required style="width: 500px; font-size:medium; padding: 5px 15px" name="inputquestion'+num+'"> <br><br> Option1: <input type="text" name="inputoption' +((num-1)*4 + 1 )+ '" required> <br><br> Option2: <input type="text" name="inputoption' + ((num-1)*4 + 2 )+ '" required> <br><br> Option3: <input type="text" name="inputoption' + ((num-1)*4 + 3) + '" required> <br><br> Option4: <input type="text" name="inputoption' + ((num-1)*4 + 4) + '" required> <br> </div>';
        $("#question").append(local);  
    }

        var x = document.getElementById("noQuestions");
        var y = document.getElementById("nextadd");

        var q_type = 'unset';
            document.getElementById("examtype1").addEventListener("change", function(){
                q_type = 'mcq';
            })
            document.getElementById("examtype2").addEventListener("change", function(){
                q_type = 'subjective';
            })
          
        y.addEventListener("click", function() {
            $("#question").html(" ");
            if(q_type == 'subjective'){
            var i_max = x.value;
            for(var i = 1; i <= x.value; i++){
                appendQuestionSub(i);
            }
        }
        else{
            var i_max = x.value;
            for(var i = 1; i <= x.value; i++){
                appendQuestionMcq(i);
            }
            refreshCSS();
        
        }

        })


        refreshCSS = () => {
            let links = document.getElementsByTagName('link');
            for (let i = 0; i < links.length; i++) {
                if (links[i].getAttribute('rel') == 'stylesheet') {
                    let href = links[i].getAttribute('href').split('?')[0];
                      
                    let newHref = href + '?version=' + new Date().getMilliseconds();
                      
                    links[i].setAttribute('href', newHref);
                }
            }
        }
    // var d = new Date();
    // var z = document.getElementById("dateOfExam");
    // z.setAttribute("min", d.getFullYear + '-' + d.getMonth + '-' + d.getDate);
    // z.setAttribute("max", d.getFullYear + '-' + (d.getMonth+1) + '-' + d.getDate);
    </script>
</body>

</html>