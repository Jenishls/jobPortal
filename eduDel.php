<?php
	require_once 'jobseeker.php';

	$id = $_POST['id'];
	$profileId = $_POST['profile'];

	$jobseeker = new jobseeker();
	$jobseeker->setId($id);
	$jobseeker->setProfileId($profileId);
	if($jobseeker->delEdu()){
		$list = $jobseeker->getEducation();
		echo json_encode($list);
	}