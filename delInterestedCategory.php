<?php
	require_once 'jobseeker.php';

	$profileId = $_POST['profile'];
	$id = $_POST['id'];

	$job = new Jobseeker();
	$job->setProfileId($profileId);
	$job->setId($id);

	if($job->delIntrestedCategory()){
		$list = $job->getInterestedCategory();
		echo json_encode($list);
	}