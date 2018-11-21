<?php
session_start();
require("inc/config.php");
require("inc/user.class.php");

if(isset($_GET['a'])) {
	if($_GET['a'] == "submit" && $_GET['id'] == session_id()) {
		if($_GET['username'] == "") {
			$_GET['username'] = "Anonymous";
		}

		$user = new User;
		$user->getInfo($db, $_GET['username']);

		if($_GET['message'] != "") {
			$q = $db->prepare("INSERT INTO chat (username, message, date, user_id) VALUES (?, ?, ?, ?)");
			$q->execute(array($user->name, $_GET['message'], time(), $user->id));
		}
	} else if($_GET['a'] == "load") {
		$output = "";
		$q = $db->prepare("SELECT * FROM chat ORDER BY id DESC LIMIT " . $load_limit);
		$q->execute();
		$r = $q->fetchAll(PDO::FETCH_ASSOC);
		arsort($r);

		foreach($r as $result) {
			/*$output .= '<div class="row p-2 mb-2 bg-dark text-white individual-message"><div class=" text-right col-md-2 text-muted small">' . date("m/d/y", $result['date']) . '<br />' . date("h:ia", $result['date']) . '</div> <div class="col-md-10 text-left"><strong>' . $result['username'] . '</strong>: ' . htmlentities($result['message']) . '</div></div>';*/
			$output .= '<div class="p-2 mb-2 bg-dark text-left text-white individual-message"><span class="text-muted small">' . date("m/d/y", $result['date']) . ' @ ' . date("h:ia", $result['date']) . '</span> <strong>' . $result['username'] . '</strong>: ' . htmlentities($result['message']) . '</div>';
		}

		echo $output;
	}
}