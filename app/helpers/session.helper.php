<?php

session_start();

function showPopUp(string $name) {
	if (isset($_SESSION[$name])) {
		echo "
			<div class='alert alert-{$_SESSION[$name . 'Class']} alert-dismissible fade show' role='alert'>
			  <strong>$_SESSION[$name]</strong>
			  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			    <span aria-hidden='true'>&times;</span>
			  </button>
			</div>
		";
		unset($_SESSION[$name]);
		unset($_SESSION[$name . 'Class']);
	}
}

function setPopUp(string $name, string $message, string $class) {
	$_SESSION[$name] = $message;
	$_SESSION[$name . 'Class'] = $class;
}

function saveLoginInfo(object $user) {
	$_SESSION['user_id'] = $user->id;
	$_SESSION['user_username'] = $user->username;
	$_SESSION['user_email'] = $user->email;
}

function clearLoginInfo() {
	unset($_SESSION['user_id']);
	unset($_SESSION['user_username']);
	unset($_SESSION['user_email']);
	session_destroy();
}

function isLoggedIn() {
	return isset($_SESSION['user_id']);
}

function getLoginInfo() {
	return [
		'id' => $_SESSION['user_id'],
		'username' => $_SESSION['user_username'],
		'email' => $_SESSION['user_email']
	];
}