<?php
require_once 'jobseeker.php';
	
	$category = $_POST['category'];
	$profileId = $_POST['profile-id'];
	$job = new Jobseeker();
	$job->setCategory($category);
	$job->setProfileId($profileId);
	if($job->insertInterestedCategory()){

		$list = $job->getInterestedCategory();
		echo json_encode($list);
	}

	// if($job->getInterestedCategory()){
	// 	echo json_encode($job);
	// }
