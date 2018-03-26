<?php
	require_once 'employer.php';

	$vacancyId = $_POST['vacancy-id'];
	
	$employer= new Employer();
	$employer->setVacancyId($vacancyId);
	$array = $employer->listCandidates();
	echo json_encode($array);