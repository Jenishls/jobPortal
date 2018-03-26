<?php
	require_once 'employer.php';

	$id = $_POST['id'];
	$jobTitle = $_POST['job-title'];
	$desc = $_POST['desc'];
	$education = $_POST['education'];
	$openings = $_POST['openings'];
	$availability = $_POST['job-availability'];
	$salary = $_POST['salary'];
	$experience = $_POST['exp'];
	$level = $_POST['level'];
	$deadline = $_POST['deadline'];

	$employer = new Employer();
	$employer->setId($id);
	$employer->setJobTitle($jobTitle);
	$employer->setDesc($desc);
	$employer->setEducation($education);
	$employer->setOpenings($openings);
	$employer->setAvailability($availability);
	$employer->setSalary($salary);
	$employer->setExperience($experience);
	$employer->setLevel($level);
	$date = date('Y-m-d', strtotime($deadline));
	$employer->setDeadline($date);
	if($employer->postVacancy()){
		echo "Vacancy Posted";
	}
	else{
		echo "Vacancy post failed!!";
	}


