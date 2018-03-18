<?php
	
	require_once 'user.php';

	$username = $_POST['email'];
	$password = $_POST['psw'];

	$user = new User();
	$user->setEmail($username);
	$user->setPassword($password);

	$val = $user->login();
		echo $val;
	
	