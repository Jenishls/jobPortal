<?php
require_once 'employer.php';
	$cid = $_POST['cid'];
	$vid = $_POST['vid'];

	$emp = new Employer();
	$emp->setEmpId($cid);
	$emp->setVacancyId($vid);
	if($list = $emp->getVacancy()){
		echo json_encode($list);
	}

