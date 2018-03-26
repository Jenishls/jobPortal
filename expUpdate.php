<?php
	require_once 'jobseeker.php';

	$id = $_POST['id'];
	$profileId = $_POST['profile-id'];
	$startDate = $_POST['start-date'];
	$endDate = $_POST['end-date'];
	$companyName = $_POST['company-name'];
	$jobTitle = $_POST['job-title'];
	
	$job = new Jobseeker();
	$job->setId($id);
	$job->setProfileId($profileId);
	$job->setStartDate($startDate);
	$job->setEndDate($endDate);
	$job->setCompanyName($companyName);
	$job->setJobTitle($jobTitle);
	
	if($job->updateExperience()){
		$list = $job->getExperience();
		echo json_encode($list);
	}

	