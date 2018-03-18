<?php
	require_once('user.php');

	if(isset($_POST['employer-email'])){
		$email = $_POST['employer-email'];	
	}

	if(isset($_POST['jobseeker-email'])){
		$email = $_POST['jobseeker-email'];
	}

	$user = new User();
	$user->setEmail($email);
	$count = $user->checkEmail();

	echo $count;