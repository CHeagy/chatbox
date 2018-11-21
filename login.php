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
								<? if($_GET['login'] == "true") { ?>
									<? $user = new User; $r = $user->loginUser($db, $_POST['username'], $_POST['password']); ?>
									<div class="alert alert-<?=$r[0]?>"><?=$r[1]?></div>
								<? } 

								if($r[0] == "danger") { ?>
									<form class="form-signin" action="login.php?login=true" method="POST">
										<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
										<label for="inputName" class="sr-only">Username</label>
										<input type="text" name="username" id="inputName" class="form-control" placeholder="Username" required autofocus>
										<label for="inputPassword" class="sr-only">Password</label>
										<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
										<div class="checkbox mb-3">
											<label>
												<input type="checkbox" name="remember-me" disabled> Remember me (Coming soon)
											</label>
										</div>
										<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
									</form>
								<? } ?>
							</div>
							<div class="col-md-4"></div>
						</div>
				</div>
			</main>
<? require("style/footer.php"); ?>
		</div>

	<? if($_GET['login'] == true && $r[0] == "success") { ?>
		<script type="text/javascript">
			function goHome() {
				window.location = "<?=$baseurl?>";
			}
			setTimeout(goHome, 3000);
		</script>
	<? } ?>
	</body>
</html>
