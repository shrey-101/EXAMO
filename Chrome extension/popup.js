$("#submit").click(function(){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/ext/index.php", true);
    xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      alert('This is the response from the server: '+ xhr.responseText );
    }
}})
