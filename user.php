<?php
session_start();
require("inc/config.php");
require("inc/user.class.php");

if($_SESSION['logged_in'] != true) {
	header('location: login.php');
}
$user = new User;
$user->getInfo($db, $_SESSION['username']);

$user_page = new User;
$user_page->getInfoById($db, $_GET['id']);
$user_page->postCount($db, $user_page->id);

if(isset($_POST['comment'])) {
	$user->post_comment($db, $_GET['id'], $user->id, $_POST['comment']);
	var_dump($_POST);
}

//$comments = $user_page->get_comments($db, $_GET['id']);
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
								<h1 class="h3 mb-3 font-weight-normal"><?=$user_page->name?></h1>
								<h6>Joined on <?=date("l, F jS Y", $user_page->created)?></h6>
								<h6><?=$user_page->name?> has posted <?=$user_page->count?> time<? if($user_page->count != 1) { ?>s<? } ?>.</h6>
							</div>
							<div class="col-md-4"></div>
						</div>
						<br /><br />
						<div class="row outer-container">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<form method="POST" id="new-message">
									<textarea name="comment" class="form-control" id="message" placeholder="New comment..."></textarea>
									<input type="submit" class="form-control" value="Submit" />
									<br />
								</form>
							</div>
							<div class="col-md-4"></div>
						</div>
						<div class="chat-container" id="chat-container">
							
						</div>
				</div>
			</main>
<? require("style/footer.php"); ?>
		</div>
	</body>
	<script src="<?=$baseurl?>js/jquery.min.js"></script>
	<script type="text/javascript">
		function update_comments() {
			$.get("ajax/user.comments.php?a=load&user_id=<?=$_GET['id']?>", function(data, status) {
					if(status == "success") {
						$("#chat-container").html(data);
					}
				});
		}

		$("#new-message").submit(function(e) {
			e.preventDefault();
			message = $("#message").val();
			$("#message").val("");
			$.get("ajax/user.comments.php?a=post&user_id=<?=$_GET['id']?>&poster_id=<?=$user->id?>&message=" + message + "&id=<?=$user_page->sid?>");
			update_comments();
		});

		update_comments();
	</script>
</html>
