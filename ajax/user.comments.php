<?php
session_start();
require("../inc/config.php");
require("../inc/user.class.php");

if(isset($_GET['a'])) {
	if($_GET['a'] == "post" && $_GET['id'] == session_id()) {
		
		$user = new User;
		$user->getInfoById($db, $_GET['poster_id']);

		if($user->name == "Anonymous" && $anonymous_chatters == false) {
			$poster = false;
		} else {
			$poster = true;
		}


		if($_GET['message'] != "" && $user->name == $_SESSION['username'] && $poster == true) {
			$q = $db->prepare("INSERT INTO `user_comments` (`user_id`, `poster_id`, `post_date`, `comment`) VALUES (?, ?, ?, ?)");
			$q->execute(array($_GET['user_id'], $_GET['poster_id'], time(), $_GET['message']));
		}
	} else if($_GET['a'] == "load") {
		$output = "";
		$q = $db->prepare("SELECT * FROM `user_comments` WHERE `user_id` = ? ORDER BY `id` DESC LIMIT " . $max_user_comments);
		$q->execute(array($_GET['user_id']));
		$result = $q->fetchAll(PDO::FETCH_ASSOC);
		arsort($r);
		$user = new User;

		foreach($result as $r) {
			$c = $user->returnInfoByID($db, $r['poster_id']);
			$output .= '<div class="row outer-container">';
			$output .= 	'<div class="col-md-4"></div>';
			$output .=		'<div class="col-md-4">';
			$output .= 			'<div class="p-2 mb-2 bg-dark text-left text-white individual-message">';
			$output .=				'<span class="text-muted small">' . date("m/d/y", $r['post_date']) . ' @ ' . date("h:ia", $r['post_date']) . '</span>';
			$output .=							'<br /><strong><a href="user.php?id=' . $r['poster_id'] . '" target="_blank">[' . $c['username'] . ']</a></strong>: ' . htmlentities($r['comment']);
			$output .=						'</div>';
			$output .=					'</div>';
			$output .=					'<div class="col-md-4"></div>';
			$output .=				'</div>';
		}

		echo $output;
	}
}