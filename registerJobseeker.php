<?php

	require_once('user.php');

	$fname = $_POST['jobseeker-fname'];
	$mname = $_POST['jobseeker-mname'];
	$lname = $_POST['jobseeker-lname'];
	$dob = $_POST['jobseeker-dob'];
	$address = $_POST['jobseeker-address'];
	$phone = $_POST['jobseeker-phone'];
	$email = $_POST['jobseeker-email'];
	$password = $_POST['jobseeker-password'];
	$user_type_id = $_POST['user-type-id'];

	$user = new User();
	$user->setFname($fname);
	$user->setMname($mname);
	$user->setLname($lname);
	$user->setDob($dob);
	$user->setAddress($address);
	$user->setPhone($phone);
	$user->setEmail($email);
	$user->setPassword($password);
	$user->setUserTypeId($user_type_id);

	if($user->register()){
		echo "Registration completed!!";
	}