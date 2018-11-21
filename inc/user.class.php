<?php

class User {

	public $name;
	public $id;
	public $email;
	public $sid;
	public $date_created;

	function getInfo($db, $username) {
		$q = $db->prepare("SELECT * FROM `users` WHERE `low_username` = ?");
		$q->execute(array(strtolower($username)));
		$r = $q->fetch(PDO::FETCH_ASSOC);

		$this->name = $r['username'];
		$this->id = $r['id'];
		$this->email = $r['email'];
		$this->sid = session_id();

		$_SESSION['username'] = $this->name;
	}

	function getInfoById($db, $id) {
		$q = $db->prepare("SELECT * FROM `users` WHERE `id` = ?");
		$q->execute(array(strtolower($id)));
		$r = $q->fetch(PDO::FETCH_ASSOC);

		$this->name = $r['username'];
		$this->id = $r['id'];
		$this->email = $r['email'];
		$this->created = $r['date_created'];
	}

	function createUser($db, $username, $password, $vpassword, $email, $vemail) {
		$_SESSION['new_username'] = $username;
		$_SESSION['new_email'] = $email;
		$_SESSION['new_vemail'] = $vemail;

		if($password != $vpassword) {
			return array("danger", "Your passwords do not match.");
		}
		if($email != $vemail) {
			return array("danger", "Your email does not match.");
		}

		$q = $db->prepare("SELECT * FROM `users` WHERE `username` = ?");
		$q->execute(array($username));
		$r = $q->fetch(PDO::FETCH_ASSOC);

		if($r['username'] != null) {
			return array("danger", "That username is already in use.");
		}

		$q = $db->prepare("INSERT INTO `users` (`username`, `low_username`, `password`, `email`, `date_created`) VALUES (?, ?, ?, ?, ?)");
		$q->execute(array($username, strtolower($username), password_hash($password, PASSWORD_DEFAULT), $email, time()));

		return array("success", "Your account has been created");
	}

	function loginUser($db, $username, $password) {
		$q = $db->prepare("SELECT * FROM `users` WHERE `low_username` = ?");
		$q->execute(array(strtolower($username)));
		$r = $q->fetch(PDO::FETCH_ASSOC);

		if(password_verify($password, $r['password'])) {
			$this->getInfo($db, $username);
			$_SESSION['logged_in'] = true;
			return array("success", "Welcome " . $this->name . "!");
		} else {
			return array("danger", "The username or password is incorrect.");
		}
	}

	function updateUser($db, $username, $email, $password, $newpassword, $vnewpassword) {
		$q = $db->prepare("SELECT * FROM `users` WHERE `username` = ?");
		$q->execute(array($username));
		$r = $q->fetch(PDO::FETCH_ASSOC);

		if($password != "" || $newpassword != "" || $vnewpassword != "" ) {
			if(!password_verify($password, $r['password'])) {
				return array("danger", "Your current password is incorrect.");
			} else {
				if($newpassword != $vnewpassword && ($newpassword != "" || $vnewpassword != "")) {
					return array("danger", "Your new passwords do not match.");
				} else {
					$q = $db->prepare("UPDATE `users` SET `password` = ? WHERE `username` = ?");
					$q->execute(array(password_hash($newpassword, PASSWORD_DEFAULT), $username));
				}
			}
		}

		if($email != $r['email']) {
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return array("danger", "Please enter a valid email.");
			} else {
				$q = $db->prepare("UPDATE `users` SET `email` = ? WHERE `username` = ?");
				$q->execute(array($email, $username));
			}
		}

		return array("success", "Your account has been updated");
	}

}