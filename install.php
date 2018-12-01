<?php
session_start();
require("inc/config.php");
function sendIt($db, $username, $password, $email) {
	$q = $db->prepare("CREATE TABLE `chat` (`id` int(11) unsigned NOT NULL AUTO_INCREMENT, `username` varchar(20) NOT NULL DEFAULT 'Anonymous', `message` text NOT NULL, `date` int(11) NOT NULL, `user_id` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
	$try[] = $q->execute();

	$q = $db->prepare("CREATE TABLE `users` (`id` int(11) unsigned NOT NULL AUTO_INCREMENT, `username` varchar(255) NOT NULL DEFAULT '', `password` varchar(255) NOT NULL DEFAULT '', `email` varchar(255) NOT NULL DEFAULT '', `low_username` varchar(255) NOT NULL DEFAULT '', `date_created` int(20) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
	$try[] = $q->execute();

	$q = $db->prepare("INSERT INTO `chat` (`id`, `username`, `message`, `date`, `user_id`) VALUES (?, ?, ?, ?, ?);");
	$try[] = $q->execute(array(1, "Lyfa", "Thanks for using my chat box", 1542472793, 1));

	$q = $db->prepare("INSERT INTO `users` (`id`, `username`, `password`, `email`, `low_username`, `date_created`) VALUES (?, ?, ?, ?, ?, ?);");
	$try[] = $q->execute(array(1, "Anonymous", "Anonymous", "Anonymous", "anonymous", time()));

	$q = $db->prepare("INSERT INTO `users` (`username`, `password`, `email`, `low_username`, `date_created`) VALUES (?, ?, ?, ?, ?);");
	$stry[] = $q->execute(array($username, password_hash($password, PASSWORD_DEFAULT), $email, strtolower($username), time()));

	if(in_array(false, $try)) {
		$success = false;
	} else {
		$success = true;
	}

	return $success;
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
						<div class="row outer-container">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<? if($_GET['sendit'] == "true") {
										$success = sendIt($db, $_POST['username'], $_POST['password'], $_POST['email']);
										
										if($success == true) { ?>
										<div class="alert text-center alert-success">
											Your chat box has been installed.  
											<br />
											You can now create a new user.
											<hr />
											Please delete  <pre>install.php</pre> in order to use the chat box.
										</div>
										<? } else if ($success == false) { ?>
										<div class="alert text-center alert-danger">
											There has been an error while trying to install your chatbox.
											<br />
											<br />
											Please check the following
											<br />
											<br />
											<div class="text-left">
												<dl>
													<dt>inc/config.php</dt>
													<dd>Ensure everything is setup correctly.</dd>
													<dt>`<?=$dbdatabase?>`</dt>
													<dd>Ensure your database is empty</dd>
												</dl>
											</div>
											<br />
											If you continue to have errors<br />please <a href="mailto:quinn@quinnheagy.com?subject=Chatbox installation errors" class="text-muted">contact me.</a>
										</div>
										<? } ?>
									<? } else if($_GET['sendit'] == "db-error") { ?>
										<div class="alert text-center alert-danger">
											Database connection error.
											<br /><br />
											Please edit <pre>inc/config.php</pre> to update your database connection details.
											<br />
											<a href="install.php" class="text-muted">Try again</a>
										</div>
									<? } else { ?>
										<div class="alert text-center alert-success">Please remember to delete <pre>install.php</pre> after completing the install</div>
										<form action="install.php?sendit=true" method="POST">
											<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
											<input type="password" name="password" class="form-control" placeholder="password" required>
											<input type="email" name="email" class="form-control" placeholder="Email address" required>
											<br />
											<input type="submit" class="btn btn-lg btn-primary btn-block" value="Install">
										</form>
									<? } ?>
							</div>
							<div class="col-md-4"></div>
						</div>
				</div>
			</main>
<? require("style/footer.php"); ?>
		</div>
	</body>
</html>
