<?php
session_start();
require("inc/config.php");

$q = $db->prepare("CREATE TABLE `chat` (`id` int(11) unsigned NOT NULL AUTO_INCREMENT, `username` varchar(20) NOT NULL DEFAULT 'Anonymous', `message` text NOT NULL, `date` int(11) NOT NULL, `user_id` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$q->execute();

$q = $db->prepare("CREATE TABLE `users` (`id` int(11) unsigned NOT NULL AUTO_INCREMENT, `username` varchar(255) NOT NULL DEFAULT '', `password` varchar(255) NOT NULL DEFAULT '', `email` varchar(255) NOT NULL DEFAULT '', `low_username` varchar(255) NOT NULL DEFAULT '', PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
$q->execute();

$q = $db->prepare("INSERT INTO `chat` (`id`, `username`, `message`, `date`, `user_id`) VALUES (?, ?, ?, ?, ?);");
$q->execute(array(1, "Lyfa", "Thanks for using my chat box", 1542472793, 1));

$q = $db->prepare("INSERT INTO `users` (`id`, `username`, `password`, `email`, `low_username`) VALUES (?, ?, ?, ?, ?);");
$q->execute(array(1, "Anonymous", "Anonymous", "Anonymous", "anonymous"));
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
								<div class="alert text-center alert-success">
									Your chat box has been installed.  
									<br />
									You can now create a new user.
									<hr />
									Please delete this install file.
								</div>
							</div>
							<div class="col-md-4"></div>
						</div>
				</div>
			</main>
<? require("style/footer.php"); ?>
		</div>
	</body>
</html>
