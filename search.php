<?php
	require_once 'jobseeker.php';

	$title = $_POST['job-title'];
	$location = $_POST['location'];
	$industry = $_POST['industry'];

	$jobseeker = new jobseeker();
	$jobseeker->setJobTitle($title);
	$jobseeker->setLocation($location);
	$jobseeker->setIndustry($industry);

	$val = $jobseeker->jobSearch();
	echo json_encode($val);