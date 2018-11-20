<?php
session_start();
$_SESSION = [];
session_destroy();
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
								<div class="alert alert-success">You have successfully logged out.</div>
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
						<a class="nav-link" href="account.php">My Account</a>
						<a class="nav-link" href="logout.php">Sign Out</a>
						<? } ?>
					</nav>
				</div>
			</footer>
		</div>

		<script type="text/javascript">
		function goHome() {
			window.location = "<?=$baseurl?>index.php";
		}
		setTimeout(goHome, 4000);
		</script>
	</body>
</html>
