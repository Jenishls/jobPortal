<?php 
	require_once 'user.php';

	$id = $_POST['id'];
	$password = $_POST['employer-password'];
	$email = $_POST['employer-email'];

	$user = new User();
	$user->setUserId($id);
	$user->setEmail($email);
	if($password != ""){
		$user->setPassword($password);
		
		if($user->changeEmailPassword()){
			echo "successfully changed";
		}
	}
	else{
		if ($user->changeEmail()) {
			echo "successfully changed";
		}


	}
	
	
	

