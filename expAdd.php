<?php
require_once 'jobseeker.php';

$profileId = $_POST['profile-id'];
$startDate = date('Y-m-d', strtotime($_POST['start-date']));
$endDate = date('Y-m-d',strtotime($_POST['end-date']));
$companyName = $_POST['company-name'];
$jobTitle = $_POST['job-title'];

$job = new jobseeker();
$job->setProfileId($profileId);
$job->setStartDate($startDate);
$job->setEndDate($endDate);
$job->setCompanyName($companyName);
$job->setJobTitle($jobTitle);
if($job->insertExperience()){
	$list = $job->getExperience();
	echo json_encode($list);
}
