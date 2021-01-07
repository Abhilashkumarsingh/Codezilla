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
$videoJson = json_encode([]);
$content = false;
if (isset($_GET['search_key']) && $_GET['search_key'] != "") {
  $subject_name = $_GET['search_key'];

  $subjectExists = $pdo->prepare("select subject_id from subject where subject_name=?");
  $getSubjectVideos = $pdo->prepare("select * from video where parent_subject=?");

  $subjectExists->execute([$subject_name]);
  $parent_subject = $subjectExists->fetch(PDO::FETCH_COLUMN);

  $getSubjectVideos->execute([$parent_subject]);
  $videos = $getSubjectVideos->fetchAll(PDO::FETCH_ASSOC);
  $videosJson = json_encode($videos);

  $content = true;
}

$all_subjects = $pdo->prepare("select subject_name from subject");
$all_subjects->execute();
$all_subjects = json_encode($all_subjects->fetchAll(PDO::FETCH_COLUMN));
?>
<!doctype html>
<html>

<head>
  <!-- <link rel="stylesheet" href="tutorial.css"> -->
  <script src="https://www.gstatic.com/firebasejs/7.15.5/firebase.js"></script>
  <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="firebase.js">
    // fire base page inclusion
  </script>
  <script src="tutorial.js"></script>
  <script src="lemon.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <style>
    p {
      color: black
    }

    .result:hover {
      background-color: lightcoral;
      transition-duration: 0.2s;
    }
  </style>
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

  <div class='container my-3'>
    <form action="tutorialpage.php" method='GET'>
      <div class='form-floating'>
        <input type="text" name="search_key" class='form-control border border-dark' id='search_key' placeholder="Search Here" oninput="updateSearchResults()" autocomplete="off">
        <label>Search Here</label>
      </div>
      <div class='border border-dark' id='search-results'>

      </div>
    </form>
  </div>
  <?php if ($content) { ?>
    <div class='container border border-dark'>

      <p class=''>The Main Content Pane</p>

      <div class='row'>
        <!-- The sidebar -->

        <div class="col-sm-2 border border-dark  p-2" id='leftbar'>
          <p class=''>Left Sidebar</p>
          <?php foreach ($videos as $x) {
            $video_name = $x['video_name'];
            $video_link = $x['video_link'];
            $notes_link = $x['notes_link'];
            $video_id = $x['video_id'];
          ?>

            <div class='container border border-dark result my-2' onclick="updateContent('<?= $video_id ?>','<?= addslashes($video_name) ?>','<?= addslashes($video_link) ?>','<?= addslashes($notes_link) ?>')"><?= $video_name ?></div>
          <?php } ?>
        </div>

        <!-- Page content -->
        <div class="col-sm-10 border border-dark ">
          <!-- <p class='display-1' id='video_title'>Middle Content</p> -->
          <div class="ratio ratio-16x9">
            <iframe id='video_link' src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" title="YouTube video" allowfullscreen></iframe>
          </div>
          <!-- <iframe id="video_link" src="https://www.youtube.com/embed/wJLftmfHVs8?rel=0&showinfo=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
          <!-- <div class="border border-dark " id='rightbar'>

          </div> -->
        </div>


      </div>
    </div>
  <?php } ?>
  </div>
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
  });


  let all_subjects = <?= $all_subjects ?>;

  function updateSearchResults() {
    console.log('lol')
    let key = $('#search_key')[0].value
    let re = new RegExp(key, 'i');
    let search_results_box = $('#search-results');
    search_results_box[0].innerHTML = "";
    if (key == "") {
      return
    }

    for (let i = 0; i < all_subjects.length; i++) {
      if (re.test(all_subjects[i]))
        search_results_box.append(`<div class='container-fluid p-2 m-2 border border-dark result ' onclick='submitForm("${all_subjects[i]}")'>${all_subjects[i]}</div>`)
    }
  }

  function submitForm(subject_id) {
    $('#search_key')[0].value = subject_id;
    $('form')[0].submit();
  }

  function updateContent(id, name, link, notes) {
    console.log(id, name, link, notes);
    $('#video_link')[0].src = link;
    $('#rightbar').append(`<a class='btn btn-alert' href='${notes}' >notes</a>`)
  }

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
</script>

</html