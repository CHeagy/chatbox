<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Chatbox</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/cover.css" rel="stylesheet">
	</head>

	<body>

		<div class="container d-flex h-100 p-3 mx-auto flex-column">
			<header class="masthead mb-auto">
				<div class="inner">
					<form id="new-message">
						<div class="row outer-container">
							<div class="col-md-1"></div>
							<div class="col-md-2">
								<label for="username" class="sr-only">Username</label>
								<input type="text" id="username" class="form-control" placeholder="Anonymous">
							</div>
							<div class="col-md-6">
								<label for="message" class="sr-only">Message</label>
								<input type="text" id="message" class="form-control" maxlength="300" autocomplete="off" placeholder="Message..." required autofocus>
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
			</header>

			<main role="main" class="inner cover">
			</main>

			<footer class="mastfoot mt-auto">
				<div class="inner">
					<nav class="nav nav-masthead justify-content-center">
						<a class="nav-link" href="https://quinnheagy.com/">Me</a>
						<a class="nav-link" href="https://github.com/QHeagy/chatbox" target="_blank">GitHub</a>
					</nav>
				</div>
			</footer>
		</div>


		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="js/jquery.min.js"></script>
		<script type="text/javascript">
			function update_chat() {
				$.get("chat.php?a=load", function(data, status) {
					if(status == "success") {
						$(".chat-messages").html(data);
					}
				});
			}

			$("#new-message").submit(function(e) {
				e.preventDefault();
				username = $("#username").val();
				message = $("#message").val();
				$("#message").val("");
				$.get("chat.php?a=submit&username=" + username + "&message=" + message);
				update_chat();
			});

			update_chat();
			window.setInterval(update_chat, 2000);
		</script>
	</body>
</html>
