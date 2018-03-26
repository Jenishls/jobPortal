<?php
	require_once 'jobseeker.php';

	$id = $_POST['id'];
	$profileId = $_POST['profile'];

	$jobseeker = new jobseeker();
	$jobseeker->setId($id);
	$jobseeker->setProfileId($profileId);
	if($jobseeker->delExp()){
		$list = $jobseeker->getExperience();
		echo json_encode($list);
	}