<?php
	require_once 'jobseeker.php';
	$vid = $_POST['id'];
	$pid = $_POST['pid'];

	$job = new Jobseeker();
	$job->setVacancyId($vid);
	$job->setProfileId($pid);
	echo ($job->insertJobApplied());