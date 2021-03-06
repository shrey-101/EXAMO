<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style-after-registration.css">
    <title>Examo</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar">
        <ul class="nav-list background">
            <div class="logo">EXAMO</div>
            <div class="list-items">
                <div class="input">
                <li><a href="homepage.html" class="active">Home</a> </li>
                <li><a href="">About</a></li>
                <li><a href="">Services</a></li>
                <li><a href="">Contact Us</a></li>
            </div>
        </ul>

    </nav>

    <div class="butt2" onclick="pop()" type="button">Create New Class</div>
    
      <div id="box">
    
        <h1>Create Class</h1>
        <form>
            <b><p>Class Name:<input type="text" required></p></b>
            <b><p>Date:<input type="date" required></p></b>
            <b><p>Time:<input type="time" required></p></b>
        </form>
        <div class="bt">
            <div class="btt" type="submit" >Create</div>
            <div class="btt" onclick="pop()" type="button">Cancel</div>
            
        </div>
      </div>

    <section>
        <table class="table table-bordered border-light table-dark table-hover">
            <thead>
                <tr>
                    <th scope="col">S. No.</th>
                    <th scope="col">Previous classes</th>
                    <th scope="col">Date-time</th>
                    <th scope="col">Create</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Maths UNIT-1</td>
                    <td>12/03/2021 - 02:00 PM</td>
                    <td>
                        
                            <button class="btn1">Join</button>
                        
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Maths UNIT-2</td>
                    <td>20/03/2021 - 04:30 PM</td>
                    <td>
                    
                            <button class="btn1">Join</button>
                        
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Maths UNIT-2</td>
                    <td>20/03/2021 - 04:30 PM</td>
                    <td>
                            <button class="btn1">Join</button>
                        
                    </td>
                </tr>
            </tbody>
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

    <script>
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
    </script>
</body>

</html>