<?php
session_start();
require("inc/config.php");
require("inc/user.class.php");

if($_SESSION['logged_in'] != true) {
	header('location: login.php');
}

$r[0] = "danger";
$user = new User;
$user->getInfoById($db, $_GET['id']);
$user->postCount($db, $user->id);
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
								<h1 class="h3 mb-3 font-weight-normal"><?=$user->name?></h1>
								<h6>Joined on <?=date("l, F jS Y", $user->created)?></h6>
								<h6><?=$user->name?> has posted <?=$user->count?> time<? if($user->count != 1) { ?>s<? } ?>.</h6>
							</div>
							<div class="col-md-4"></div>
						</div>
				</div>
			</main>
<? require("style/footer.php"); ?>
		</div>
	</body>
</html>
