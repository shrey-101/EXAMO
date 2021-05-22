<?php
if(isset($_POST['Submitanswer'])){
    $sqlobj = "SELECT * FROM question WHERE exam_code = '$exam_code' ORDER BY question_id ASC";
    $resultobj = $conn->query($sqlobj);
    $x = 1;
    $y = 0;
    while($rowobj = $resultobj->fetch_assoc()){
        $temp = $rowobj['question_id'];
        $bemp = $_POST['answerinput' . $x];

        $sqlint= "INSERT INTO answer (exam_code, email, question_id, answersub) VALUES ('$exam_code', '$email', '$temp', '$bemp')";
        if($conn->query($sqlint)){
            $y++;
        }
        else{
            echo mysqli_error($conn);
        }
        $x++;

    }
    if($y > 0) header("location: dashboard-examinee.php");

    
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
    <link rel="stylesheet" href="style-test-sub.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Newsreader:wght@300&display=swap" rel="stylesheet">
    <title>Examo</title>
</head>

<body>
<div class="container left">
    <section>
        <h2 class="headin1">  <?php  echo "$exam_name" ?> </h2>
        <form method="post">
            <div class="myContain">
                
                <h3 class="instruct">"Kindly Do Not change or minimize this TAB":</h3>
                <hr>


                <?php
                $sqlobj = "SELECT * FROM question WHERE exam_code = '$exam_code' ORDER BY question_id ASC";
                $resultobj = $conn->query($sqlobj);
                $x = 1;
                echo '
                <form action="" method="POST">
                ';
                while($rowobj = $resultobj->fetch_assoc()){
                    echo '
            <div class="test">
                
            <P class="que">' . $x . ': ' . $rowobj["questioninput"] . '<br>
                    
                        <input id="" name="answerinput'. $x . '" width="500px" height="100px" >            
                </p>
            </div>';
                        $x++;
                }


                
            ?>
            <!-- <div class="test">
                
                <P class="que">1. What will be the rank of naughty coders in devjam:<BR>
                    <form action="/action_page.php">
                        <input type="file" id="myFile" name="filename">
                        <input type="submit" value="Upload">
                      </form>
                </p>
            </div>
            
            <div class="test"><P class="que">2. The answer is really big:<BR>
                <form action="/action_page.php">
                    <input type="file" id="myFile" name="filename">
                    <input type="submit" value="Upload">
                  </form>
            </p>
            </div>
            
            <div class="test"><P class="que">3. What makes Aryan Tiwari so smart:<BR>
                <form action="/action_page.php">
                    <input type="file" id="myFile" name="filename">
                    <input type="submit" value="Upload">
                  </form>
            </p>
            </div> 

            <div class="test"><P class="que">4. What makes Aryan Tiwari so smart:<BR>
                <form action="/action_page.php">
                    <input type="file" id="myFile" name="filename">
                    <input type="submit" value="Upload">
                  </form>
            </p>
            </div>-->
            
            <hr cals>
            <br>
            <div class="Testbtn">
            <input class="Testbtn1" type="submit" value="Submit answer" name="Submitanswer" id="submit">
            </form>
            </div>

            </div>
            </form>
        </div>
    </section>
    </div>
<div class="container right">
 <center>
<div class="timer">
  You are being watched! please be carefull and dont try to cheat
</div>

<input type="file" accept="image/*;capture=camera" hidden>

<device type="media" onchange="update(this.data)"></device>
 <video autoplay width="320px" height="240px"></video> <br><br>
 <h3> <i><?php echo $fullname ?></i> </h3> <br>
 <h4><i> <?php echo $email ?> </i> </h4>


</center>






<script>
  function update(stream) {
    document.querySelector('video').src = stream.url;
  }

  function hasGetUserMedia() {
  return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
}
if (hasGetUserMedia()) {
  // Good to go!
} else {
  alert("getUserMedia() is not supported by your browser");
}
</script>

<video autoplay></video>

<script>
const constraints = {
  video: true,
};

const video = document.querySelector("video");

navigator.mediaDevices.getUserMedia(constraints).then((stream) => {
  video.srcObject = stream;
});

// const hdConstraints = {
//   video: { width: { min: 480 }, height: { min: 720 } },
// };

// navigator.mediaDevices.getUserMedia(hdConstraints).then((stream) => {
//   video.srcObject = stream;
// });
const vgaConstraints = {
  video: { width: { exact: 640 }, height: { exact: 480 } },
};

navigator.mediaDevices.getUserMedia(vgaConstraints).then((stream) => {
  video.srcObject = stream;
});
const videoElement = document.querySelector("video");
const audioSelect = document.querySelector("select#audioSource");
const videoSelect = document.querySelector("select#videoSource");

navigator.mediaDevices
  .enumerateDevices()
  .then(gotDevices)
  .then(getStream)
  .catch(handleError);

audioSelect.onchange = getStream;
videoSelect.onchange = getStream;

function gotDevices(deviceInfos) {
  for (let i = 0; i !== deviceInfos.length; ++i) {
    const deviceInfo = deviceInfos[i];
    const option = document.createElement("option");
    option.value = deviceInfo.deviceId;
    if (deviceInfo.kind === "audioinput") {
      option.text =
        deviceInfo.label || "microphone " + (audioSelect.length + 1);
      audioSelect.appendChild(option);
    } else if (deviceInfo.kind === "videoinput") {
      option.text = deviceInfo.label || "camera " + (videoSelect.length + 1);
      videoSelect.appendChild(option);
    } else {
      console.log("Found another kind of device: ", deviceInfo);
    }
  }
}

function getStream() {
  if (window.stream) {
    window.stream.getTracks().forEach(function (track) {
      track.stop();
    });
  }

  const constraints = {
    audio: {
      deviceId: { exact: audioSelect.value },
    },
    video: {
      deviceId: { exact: videoSelect.value },
    },
  };

  navigator.mediaDevices
    .getUserMedia(constraints)
    .then(gotStream)
    .catch(handleError);
}

function gotStream(stream) {
  window.stream = stream; // make stream available to console
  videoElement.srcObject = stream;
}

function handleError(error) {
  console.error("Error: ", error);
}

// var successCallback = function(error) {
//   // user allowed access to camera
// };
// var errorCallback = function(error) {
//   if (error.name == 'NotAllowedError') {
//    alert('Cannot proceed without camera permission');
//    document.style.display = "none";
//   }
// };
// navigator.mediaDevices.getUserMedia(constraints)
//   .then(successCallback, errorCallback);
</script>
</div>
    
    <script>
        window.addEventListener("beforeunload", function (e) {
            var confirmationMessage = 'It looks like you have been editing something. '
                                    + 'If you leave before saving, your changes will be lost.';
    
            (e || window.event).returnValue = confirmationMessage; //Gecko + IE
            return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
        });
    </script>
    


    <script>
        window.addEventListener("beforeunload", function (e) {
            var confirmationMessage = 'It looks like you have been editing something. '
                                    + 'If you leave before saving, your changes will be lost.';
    
            (e || window.event).returnValue = confirmationMessage; //Gecko + IE
            return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
        });
    </script>

<script>
var peer = new Peer();
peer.on('open', function(id) {
  console.log('My peer ID is: ' + id);
});

</script>

<script>

document.addEventListener("visibilitychange", function() {
  document.getElementById("submit").click();
 
})

</script>

<script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
<script src="main.js"></script>
</body>

</html>