

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<video id="myVidPlayer" controls muted autoplay></video>
<video id="remotevidplayer" controls muted autoplay></video>


<script type="text/javascript">
    //Selector for your <video> element
    const video = document.querySelector('#myVidPlayer');

    //Core
    window.navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            var local1 = stream;
            video.srcObject = stream;
            video.onloadedmetadata = (e) => {
                video.play();
            };
        })
        .catch( () => {
            alert('You have give browser the permission to run Webcam and mic ;( ');
        });

</script>

<script>
var peer = new Peer();
peer.on('open', function(id) {
  console.log('My peer ID is: ' + id);
});

var call = peer.call('47373e7e-9ac0-46fa-bb7b-b9724c2c15d5',
  local1);

call.on('stream', function(stream) {
  // `stream` is the MediaStream of the remote peer.
  // Here you'd add it to an HTML video/canvas element.
  const video2 = document.querySelector('#remotevidplayer');
  video2.srcObject = stream;
            video2.onloadedmetadata = (e) => {
                video2.play();
            };
});

</script>

</body>
</html>