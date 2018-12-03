<?php
session_start();
require("inc/config.php");
require("inc/user.class.php");

if($_SESSION['logged_in'] == true) {
	$user = new User;
	$user->getInfo($db, $_SESSION['username']);
} else {
	$user = new User;
	$user->getInfo($db, "Anonymous");
}
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
					<form id="new-message">
						<div class="row outer-container">
							<div class="col-md-1"></div>
							<div class="col-md-8">
								<label for="message" class="sr-only">Message</label>
								<input type="text" id="message" class="form-control" maxlength="300" autocomplete="off" <? if ($user->name == "Anonymous" && $anonymous_chatters == false) { echo "disabled"; } else { echo "autofocus"; } ?> placeholder="Message..." required >
								<input type="hidden" name="id" value="<?=$user->id?>">
							</div>
							<div class="col-md-2">
								<button class="btn btn-md btn-primary btn-block" type="submit">Submit</button>
							</div>
							<div class="col-md-1"></div>

						</div>
					</form>
					<div class="row chat-container">
						<div class="col-md-1"></div>
						<div class="col-md-10 my-3">
							<div class="chat-messages">
								<!-- CHAT MESSAGES WILL APPEAR HERE -->
							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
					
				</div>
			</main>
<? require("style/footer.php"); ?>
		</div>


		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="<?=$baseurl?>js/jquery.min.js"></script>
		<script type="text/javascript">
			function update_chat() {
				$.get("ajax/chat.php?a=load", function(data, status) {
					if(status == "success") {
						$(".chat-messages").html(data);
					}
				});
			}

			$("#new-message").submit(function(e) {
				e.preventDefault();
				message = $("#message").val();
				$("#message").val("");
				$.get("ajax/chat.php?a=submit&username=<?=$user->name?>&message=" + message + "&id=<?=$user->sid?>");
				update_chat();
			});

			update_chat();
			window.setInterval(update_chat, 2000);
		</script>
	</body>
</html>
