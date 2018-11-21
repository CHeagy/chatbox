<?php
session_start();
require("inc/config.php");
require("inc/user.class.php");
$r[0] = "danger";
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
								<? if($_GET['create'] == "true") { ?>
									<? $user = new User; $r = $user->createUser($db, $_POST['username'], $_POST['password'], $_POST['vpassword'], $_POST['email'], $_POST['vemail']); ?>
									<div class="alert alert-<?=$r[0]?>"><?=$r[1]?></div>
								<? } 

								if($r[0] == "danger") { ?>
									<form class="form-signin" action="signup.php?create=true" method="POST">
										<h1 class="h3 mb-3 font-weight-normal">Create your account</h1>
										<label for="inputName" class="sr-only">Username</label>
										<input type="text" name="username" id="inputName" class="form-control" placeholder="Username" value="<?=$_SESSION['new_username']?>" required autofocus>
										<label for="inputEmail" class="sr-only">Email</label>
										<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" value="<?=$_SESSION['new_email']?>" required>
										<label for="inputVEmail" class="sr-only">Email</label>
										<input type="email" name="vemail" id="inputVEmail" class="form-control" placeholder="Verify Email" value="<?=$_SESSION['new_vemail']?>" required>
										<label for="inputPassword" class="sr-only">Password</label>
										<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
										<label for="inputVPassword" class="sr-only">Verify Password</label>
										<input type="password" name="vpassword" id="inputVPassword" class="form-control" placeholder="Verify Password" required>
										<br />
										<button class="btn btn-lg btn-primary btn-block" type="submit">Create account</button>
									</form>
								<? } ?>
							</div>
							<div class="col-md-4"></div>
						</div>
				</div>
			</main>
<? require("style/footer.php"); ?>
		</div>

	<? if($_GET['create'] == true && $r[0] == "success") { ?>
		<script type="text/javascript">
			function goHome() {
				window.location = "<?=$baseurl?>";
			}
			setTimeout(goHome, 3000);
		</script>
	<? } ?>
	</body>
</html>
