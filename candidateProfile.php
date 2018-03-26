<?php
	require_once 'jobseeker.php';
	$pid = $_POST['pid'];
	$uid = $_POST['uid'];

	$job = new Jobseeker();
	$job->setId($uid);
	$job->setProfileId($pid);
	
	// $job->getExperience();
	// $job->getEducation();
	$list = array();
	array_push($list,$job->getProfile());
	array_push($list,$job->getEducation());
	array_push($list,$job->getExperience());
	echo json_encode($list);
