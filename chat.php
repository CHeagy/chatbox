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
		$q = $db->prepare("SELECT * FROM chat ORDER BY id DESC LIMIT 25 ");
		$q->execute();
		$r = $q->fetchAll(PDO::FETCH_ASSOC);
		arsort($r);

		foreach($r as $result) {
			$output .= '<div class="p-2 mb-2 bg-dark text-white text-left individual-message"><span class="text-muted small">' . date("h:i:sa", $result['date']) . '</span> <strong>' . $result['username'] . '</strong>: ' . htmlentities($result['message']) . '</div>';
		}

		echo $output;
	}
}