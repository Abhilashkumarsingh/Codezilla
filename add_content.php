<?php
if (isset($_POST['submit'])) {
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

    $subjectExists = $pdo->prepare("select * from subject where subject_name=?");
    $addSubject = $pdo->prepare("insert into subject(subject_name) values(?)");
    $addVideo = $pdo->prepare("insert into video(video_name,video_link,notes_link,parent_subject) values(?,?,?,?)");


    $video_name = $_POST['video_name'];
    $video_link = $_POST['video_link'];
    $subject_name = strtolower($_POST['subject_name']);
    $notes_link = $_POST['note_link'];

    $subjectExists->execute([$subject_name]);
    //if subject exists,get its id
    if ($subjectExists->rowCount())
        $parent_subject = $subjectExists->fetch(PDO::FETCH_ASSOC)['subject_id'];
    //if subject does not exists, create new row, and get its id
    else {
        $addSubject->execute([$subject_name]);
        $parent_subject = $pdo->lastInsertId();
    }

    $success = false;
    $addVideo->execute([$video_name, $video_link, $notes_link, $parent_subject]);

    if ($addVideo->rowCount())
        $success = true;
}
?>

<!DOCTYPE html>
<html lang="en">

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
        /* body {
            background-image: url(background1.jpg);
            background-position: center;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        } */
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
    <div class='container'>
        <?php if ($success) { ?>
            <div class="alert alert-warning alert-dismissible fade show my-3 rounded" role="alert">
                <strong><?= $video_name ?></strong> added successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <form action="add_content.php" method="post" class=' shadow-lg border border-dark my-3 bg-white rounded p-3'>
            <h1>Fill her up</h1>

            <div class='row mb-3'>
                <div class='col'>
                    <div class='form-floating'>
                        <input type="text" class='form-control border border-dark' name='video_name' placeholder="Video Name" required>
                        <label for="">Video Name</label>
                    </div>
                </div>
            </div>

            <div class='row mb-3'>
                <div class='col'>
                    <div class='form-floating'>
                        <input type="url" class='form-control border border-dark' name='video_link' placeholder="Video URL" required>
                        <label for="">Video URL</label>
                    </div>
                </div>
                <div class='col'>
                    <div class='form-floating'>
                        <input type="text" class='form-control border border-dark' name='subject_name' placeholder="Subject Name" required>
                        <label for="">Subject name</label>
                    </div>
                </div>
            </div>

            <div class='row mb-3'>
                <div class='col'>
                    <div class='form-floating'>
                        <input type="url" class='form-control border border-dark' name='note_link' placeholder="Link Notes" required>
                        <label for="">Link Notes</label>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col'>
                    <input type="submit" name='submit' class='btn btn-lg w-100 btn-success'>
                </div>
            </div>
        </form>
    </div>
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
</body>

</html>