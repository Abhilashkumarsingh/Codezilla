<!doctype HTML>
<html>
<head>
	<title>Memechat</title>
	<meta charset="utf-8">
	<script src="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.js"></script>
	<script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/7.15.5/firebase.js"></script>
	<link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.css" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="meme.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
<section>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-top:2%">
  <a class="navbar-brand" href="#" style="color:#FFC312;font-size:30px">Codezilla <span style="color:white;font-size:20px;">𝕾𝖒𝖊𝖑𝖑𝖘 𝖑𝖎𝖐𝖊 𝖘𝖒𝖆𝖗𝖙𝖓𝖊𝖘𝖘</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
	<li class="nav-item active mr-4 mt-3">
		<div class="dropdown">
			<button class="dropbtn">Dropdown</button>
		<div class="dropdown-content" style="position:absolute;right:1%">
		<iframe src="https://links.collect.chat/5ef7a36bb5e80f329e9a4e48"  width="400" height="400" frameBorder="0"></iframe>
		</div>
		</div>
		</div>
      </li>
	  
	  
	  
	  <li class="nav-item active">
        <a class="nav-link" href="#" id="time" style="border:1px solid #FFC312;
		border-radius:2%;color:#FFC312;padding:3px;font-size:15px">00:00:00<span class="sr-only">(current)</span></a>
      </li>
	<li class="nav-item active">
        <a class="nav-link" href="http://localhost/postman/signup.php"  style="border:1px solid #FFC312;
		border-radius:2%;color:#FFC312;padding:3%;font-size:15px;margin-left:5px">POSTMAN<span class="sr-only">(current)</span></a>
      </li>
	</ul>
  </div>
</nav>
</section>
<section>
<script src="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.js"></script>
<script src="firebase.js">// fire base page inclusion</script>
<script src="lemon.js"></script>
	<section class="need">
	<div class="container-fluid">
	<div class="mb-5"></div>
	<div class="row">
	<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card temp mt-5">
			<div class="card-header">
				<div class="d-flex justify-content-end social_icon">
					<span><img src="profile.png" class="modify mx-auto" alt="picture not available"></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body mt-2">
			<h3 class="text-center" style="color:white" id="disp1">Create Account</h3>
				<div id="firebaseui-auth-container" style="background:transparent"></div>
				<div id="loader">Loading...</div>	
			</div>
			<div class="card-footer">
				
			</div>
		</div>
	</div>
</div>
	</div>
	</div>
	</section>
	
	
	
	
	
	<div id="mySidenav" class="sidenav contact_info">
  <a href="#" id="fb"><span><i class="fab fa-facebook-square"></i></span></a>
  <a href="#" id="google"><span><i class="fab fa-google-plus-square"></i></span></a>
  <a href="#" id="twitter"><span><i class="fab fa-twitter-square"></i></span></a>
</div>
</section>
<div id="ball">
</div>
<footer id="sticky-footer" class=" bg-dark text-white-50">
    <div class="container text-center">
      <small>Copyright &copy; Team 12</small>
    </div>
 </footer>

</body>
<script>
	  window.setInterval(function(){
	  var date=new Date();
	  var time=((date.getHours()<10)?("0"+date.getHours()):date.getHours())+":"+((date.getMinutes()<10)?("0"+date.getMinutes()):date.getMinutes())+":"+((date.getSeconds()<10)?("0"+date.getSeconds()):date.getSeconds());
	  document.getElementById("time").innerText=time;
	  }, 1000);
	  </script>
</html>
