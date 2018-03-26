<?php 
	require_once 'employer.php';

	$companyId = $_POST['company-id'];
	$companyName = $_POST['companyName'];
	$desc = $_POST['description'];
	$industry = $_POST['industry'];
	$address = $_POST['employer-address'];
	$phone = $_POST['phone'];
	$website = $_POST['website'];

	$employer = new Employer();
	$employer->setEmpId($companyId);
	$employer->setName($companyName);
	$employer->setDesc($desc);
	$employer->setIndustry($industry);
	$employer->setAddress($address);
	$employer->setPhone($phone);
	$employer->setWebsite($website);

	if($employer->updateGeneral()){
		echo "updated";
	}




