<?php
	require_once('user.php');

	$user_type_id = $_POST['user-type-id'];
	$companyName = $_POST['companyName'];
	$description = $_POST['description'];
	$industry = $_POST['industry'];
	$address = $_POST['employer-address'];
	$phone = $_POST['phone'];
	$website = $_POST['website'];
	$email = $_POST['employer-email'];
	$password = $_POST['employer-password'];

	$user = new User();
	$user->setUserTypeId($user_type_id);
	$user->setCompanyName($companyName);
	$user->setDescription($description);
	$user->setIndustry($industry);
	$user->setPhone($phone);
	$user->setWebsite($website);
	$user->setEmail($email);
	$user->setPassword($password);

	if($user->register()){
		echo "Registration completed!!";
	}
