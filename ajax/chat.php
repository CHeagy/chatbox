<?php
session_start();
require("../inc/config.php");
require("../inc/user.class.php");

if(isset($_GET['a'])) {
	if($_GET['a'] == "submit" && $_GET['id'] == session_id()) {
		if($_GET['username'] == "") {
			$_GET['username'] = "Anonymous";
		}

		$user = new User;
		$user->getInfo($db, $_GET['username']);

		if($user->name == "Anonymous" && $anonymous_chatters == false) {
			$poster = false;
		} else {
			$poster = true;
		}


		if($_GET['message'] != "" && ($user->name == $_SESSION['username']) && $poster == true) {
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
			$output .= '<div class="p-2 mb-2 bg-dark text-left text-white individual-message"><span class="text-muted small">' . date("m/d/y", $result['date']) . ' @ ' . date("h:ia", $result['date']) . '</span> <strong><a href="user.php?id=' . $result['user_id'] . '" target="_blank">[' . $result['username'] . ']</a></strong>: ' . htmlentities($result['message']) . '</div>';
		}

		echo $output;
	}
}