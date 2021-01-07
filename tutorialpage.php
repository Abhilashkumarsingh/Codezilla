<?php
putenv("DATABASE_URL=postgres://kdckazomrgiobn:d46f5d4d598beef773b4229be5128dc9cc6d666a8975edf4e16b4dce5ca64e26@ec2-35-169-184-61.compute-1.amazonaws.com:5432/dbt8rsv4cu410p");
$db = parse_url(getenv("DATABASE_URL"));

$pdo = new PDO("pgsql:" . sprintf(
  "host=%s;port=%s;user=%s;password=%s;dbname=%s",
  $db["host"],
  $db["port"],
  $db["user"],
  $db["pass"],
  ltrim($db["path"], "/")
));
$displayAll = $pdo->prepare("select * from video");
$displayAll->execute();
$videos = json_encode($displayAll->fetchAll(PDO::FETCH_ASSOC));

?>
<!doctype html>
<html>

<head>
  <link rel="stylesheet" href="tutorial.css">
  <script src="https://www.gstatic.com/firebasejs/7.15.5/firebase.js"></script>
  <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="firebase.js">
    // fire base page inclusion
  </script>
  <script src="tutorial.js"></script>
  <script src="lemon.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <style>
    iframe#tutorial {
      width: 860px;
      height: 520px;
    }

    p {
      color: black
    }
  </style>
  <script>
    $(document).ready(function() {
      $(" .sidebar a").click(function(e) {
        e.preventDefault();
        if ($(this).attr("href") !== "#") {
          if ($(this).attr("href") !== "https://drive.google.com/file/d/1pthvZ42QEW-OTojFdkq9D9SFnQidfm_l/preview")
            document.getElementById('chapter').innerText = "LESSION 1:  Introduction to javascript, variables in js.";
          if ($(this).attr("href") !== "https://drive.google.com/file/d/16bk_wYWzvljFSUn-eBlN3shkou3_xUpM/preview")
            document.getElementById('chapter').innerText = "LESSION 2:  Operators in javascript with sample program.";
          $("#tutorial").attr("src", $(this).attr("href"));
        }
        //$("#tutorial").attr("src",$(this).attr("href"));
      })
    });
    let videos = <?= $videos ?>
  </script>
</head>

<body>
  <section>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <a class="navbar-brand" href="#" style="color:#FFC312;font-size:20px">Codezilla</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <img id="plot" src="https://img.icons8.com/bubbles/50/000000/sun.png" />
            <div style="color:white;font-size:20px;font-family:cursive" id="intro" onload="intro();"></div>
          </li>
          <li class="nav-item active">
            <button class="btn btn-outline-success my-2 my-sm-0 ml-4" onclick="logout()">LOGOUT</button>
          </li>
        </ul>
      </div>
    </nav>
  </section>
  <div class='container'>
    <div class='form-floating'>
      <input type="text" name="search_key" class='form-control' placeholder="Search Here">
      <label>Search Here</label>
    </div>
  </div>
  <section style="width:90%;margin:0px auto">
    <!-- The sidebar -->
    <div class="sidebar">
      <a class="active" href="https://www.youtube.com/embed/wJLftmfHVs8?rel=0&showinfo=0">
        <img src="https://img.icons8.com/color/48/000000/javascript-logo-1.png" />LESSON 1</a>
      <a href="https://www.youtube.com/embed/uMb3nD4bDAY?rel=0&showinfo=0">
        <img src="https://img.icons8.com/color/48/000000/javascript-logo-1.png" />LESSON 2</a>
      <a href="https://www.youtube.com/embed/E_1GsmPjuxc?rel=0&showinfo=0" class="active">
        <img src="https://img.icons8.com/color/48/000000/javascript-logo-1.png" />PART 2</a>
      <a href="#">
        <img src="https://img.icons8.com/color/48/000000/javascript-logo-1.png" />Coming soon...</a>
      <a href="#" class="active">
        <img src="https://img.icons8.com/color/48/000000/javascript-logo-1.png" />Coming soon...</a>
      <a href="#">
        <img src="https://img.icons8.com/color/48/000000/javascript-logo-1.png" />Coming soon...</a>
      <a href="#" class="active">
        <img src="https://img.icons8.com/color/48/000000/javascript-logo-1.png" />Coming soon...</a>
      <a href="#">
        <img src="https://img.icons8.com/color/48/000000/javascript-logo-1.png" />Coming soon...</a>
      <a href="#" class="active">
        <img src="https://img.icons8.com/color/48/000000/javascript-logo-1.png" />Coming soon...</a>
      <a href="#">
        <img src="https://img.icons8.com/color/48/000000/javascript-logo-1.png" />Coming soon...</a>
      <a href="#" class="active">
        <img src="https://img.icons8.com/color/48/000000/javascript-logo-1.png" />Coming soon...</a>


    </div>

    <!-- Page content -->
    <div class="content">
      <iframe id="tutorial_video" src="https://www.youtube.com/embed/wJLftmfHVs8?rel=0&showinfo=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <div style="width:100%;text-align:center;font-size:25px;padding-top:2%;padding-bottom:1%;border:3px solid black;border-top-right-radius:50%;border-bottom-left-radius:50%;font-family:Didot">
        <p id="chapter">Smells like smartness. Start learning now.</p>
      </div>
    </div>
    <div class="lsidebar" style="padding:1% 1%">
      <div>
        <a class="active" href="#home" style="text-align:center"><span style="color:#FFC312;font-size:20px">Notification</span></a>
        <marquee behavior="scroll" class="moving-body" direction="up" scrollamount="4" style="height:150px;">
          <p style="text-align:center"><img src="https://img.icons8.com/fluent/48/000000/code.png" />Online javascript
            code editor coming soon...</p>
          <hr />
          <p style="text-align:center"><img src="https://img.icons8.com/dotty/80/000000/management.png" />Online project
            submission feature coming soon...</p>
          <hr />
          <p style="text-align:center">Website is still in development phase. Your feedback is highly appreciated.
            Please fill the feedback form from Gmail</p>
          <hr />
          <p style="text-align:center"><img src="https://img.icons8.com/ios/50/000000/you-plural.png" /><br />Please
            check notice board regularily.</p>
          <hr />
        </marquee>
        <iframe id="content" src="https://docs.google.com/forms/d/e/1FAIpQLSezFTbKu1e_0BYcBPH2UAAmxVKXauc177fvPplhW0hO9D7UHg/viewform?embedded=true" width="315" height="400" frameborder="0" marginheight="0" marginwidth="0" style="overflow-x:hidden;">Loading…</iframe>
      </div>
    </div>
    </div>
  </section>
</body>
<script>
  $(document).ready(function(e) {
    var temp = null;
    firebase.auth().onAuthStateChanged(function(user) {
      var uid = null;
      var email = null;
      if (user) {
        uid = user.uid;
        email = user.email;
      } else {
        window.location.replace("index.php");
      }
    })

    // window.setInterval(function() {
    //   var date = new Date().getHours();
    //   if (date < 12 && date > 0) {
    //     document.getElementById("plot").src = "https://img.icons8.com/doodle/48/000000/sun--v1.png";
    //     document.getElementById("intro").innerText = "Good Morning";
    //   }
    //   if (date >= 12 && date < 18) {
    //     document.getElementById("plot").src = "https://img.icons8.com/doodle/48/000000/sun--v1.png";
    //     document.getElementById("intro").innerText = "Good Afternoon";
    //   }
    //   if (date >= 18 && date < 20) {
    //     document.getElementById("plot").src = "https://img.icons8.com/fluent/48/000000/sunset.png";
    //     document.getElementById("intro").innerText = "Good Evening";
    //   }
    //   if (date >= 21 && date < 24) {
    //     document.getElementById("plot").src = "https://img.icons8.com/dotty/48/000000/moon.png";
    //     document.getElementById("intro").innerText = "Good Night";
    //   }

    // }, 1000);
  });
</script>

</html