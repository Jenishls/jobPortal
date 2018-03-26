<?php
	require_once 'jobseeker.php';
	$vid = $_POST['vid'];
	$pid = $_POST['pid'];

	$job = new jobseeker();
	$job->setProfileId($pid);
	$job->setVacancyId($vid);
	$list = $job->appliedJobs();
	echo json_encode($list);
