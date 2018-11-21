<!--<pre><?=var_dump($_SERVER, true)?></pre>-->
<?php
$url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$r = pathinfo($url);
?>

			<footer class="mastfoot mt-auto">
				<div class="inner">
					<nav class="nav nav-masthead justify-content-center">
						<a class="nav-link" href="https://quinnheagy.com/" target="_blank">Me</a>
						<a class="nav-link" href="https://github.com/QHeagy/chatbox" target="_blank">GitHub</a>
						<? if($_SESSION['logged_in'] != true) { ?> 
						<a class="nav-link" href="signup.php">Sign Up</a>
						<a class="nav-link" href="login.php">Sign In</a>
						<? } else if($_SESSION['logged_in'] == true) { ?>
							<? if($r['filename'] == "account") { ?>
								<a class="nav-link" href="index.php">Home</a>
							<? } else { ?>
								<a class="nav-link" href="account.php">My Account</a>
							<? } ?>
						<a class="nav-link" href="logout.php">Sign Out</a>
						<? } ?>
					</nav>
				</div>
			</footer>