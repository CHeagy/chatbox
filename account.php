<?php
session_start();
require("inc/config.php");
require("inc/user.class.php");
$r[0] = "danger";
$user = new User;
$user->getInfo($db, $_SESSION['username']);
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Chatbox</title>

		<!-- Bootstrap core CSS -->
		<link href="<?=$baseurl?>css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="<?=$baseurl?>css/cover.css" rel="stylesheet">
	</head>

	<body>

		<div class="container d-flex h-100 p-3 mx-auto flex-column">
			<main class="masthead mb-auto">
				<div class="inner">
						<div class="row outer-container">
							<div class="col-md-4"></div>
							<div class="col-md-4">
									<?php if($_GET['update'] == "true") {
										$r = $user->updateUser($db, $user->name, $_POST['email'], $_POST['password'], $_POST['newpassword'], $_POST['vnewpassword']);
										$user->getInfo($db, $user->name);
										?>
										<div class="alert alert-<?=$r[0]?>"><?=$r[1]?></div>
									<? } ?>


									<form class="form-signin" action="account.php?update=true" method="POST">
										<h1 class="h3 mb-3 font-weight-normal">My Account</h1>
										<h6>Username</h6>
										<label for="inputName" class="sr-only">Username</label>
										<input type="text" id="inputName" class="form-control" placeholder="Username" disabled value="<?=$user->name?>">
										<br />
										<h6>Email</h6>
										<label for="inputPassword" class="sr-only">Password</label>
										<input type="email" name="email" id="inputEmail" class="form-control" value="<?=$user->email?>">
										<br />
										<h6>Password</h6>
										<label for="inputPassword" class="sr-only">Password</label>
										<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Old Password">
										<label for="inputPassword" class="sr-only">Password</label>
										<input type="password" name="newpassword" id="inputNewPassword" class="form-control" placeholder="New Password">
										<label for="inputPassword" class="sr-only">Password</label>
										<input type="password" name="vnewpassword" id="inputVNewPassword" class="form-control" placeholder="Verify Password">
										<br />
										<button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
									</form>
							</div>
							<div class="col-md-4"></div>
						</div>
				</div>
			</main>

		

			<footer class="mastfoot mt-auto">
				<div class="inner">
					<nav class="nav nav-masthead justify-content-center">
						<!--<a class="nav-link" href="https://quinnheagy.com/" target="_blank">Me</a>
						<a class="nav-link" href="https://github.com/QHeagy/chatbox" target="_blank">GitHub</a>-->
						<? if($_SESSION['logged_in'] != true) { ?> 
						<a class="nav-link" href="signup.php">Sign Up</a>
						<a class="nav-link" href="login.php">Sign In</a>
						<? } else if($_SESSION['logged_in'] == true) { ?>
						<a class="nav-link" href="index.php">Home</a>
						<a class="nav-link" href="logout.php">Sign Out</a>
						<? } ?>
					</nav>
				</div>
			</footer>
		</div>
	</body>
</html>
