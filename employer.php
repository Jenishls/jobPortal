<?php
	require_once 'connection.php';

	/**
	* 
	*/
	class Employer 
	{
		/*		Variables		*/
			private $id;
			private $empId;
			private $jobTitle;
			private $desc;
			private $education;
			private $openings;
			private $availability;
			private $salary;
			private $experience;
			private $level;
			private $deadline;
			private $name;
			private $industry;
			private $phone;
			private $address;
			private $website;

			private $vacancyId;

			private $connect;

		function __construct()
		{
			$this->connect = new Connection();
		}

		/*		Setters		*/
			function setId($id){
				$this->id = $id;
			}

			function setEmpId($empId){
				$this->empId = $empId;
			}

			function setJobTitle($title){
				$this->jobTitle = $title;
			}

			function setDesc($desc){
				$this->desc = $desc;
			}

			function setEducation($education){
				$this->education = $education;
			}
			
			function setOpenings($openings){
				$this->openings  = $openings;
			}			

			function setAvailability($availability){
				$this->availability = $availability;
			}

			function setSalary($salary){
				$this->salary = $salary;
			}

			function setExperience($experience){
				$this->experience = $experience;
			}

			function setLevel($level){
				$this->level = $level;
			}

			function setDeadline($deadline){
				$this->deadline = $deadline;
			}

			function setName($name){
				$this->name = $name;
			}

			function setIndustry($industry){
				$this->industry = $industry;
			}

			function setAddress($address){
				$this->address = $address;
			}

			function setPhone($phone){
				$this->phone = $phone;
			}

			function setWebsite($website){
				$this->website = $website;
			}

			function setVacancyId($vacancyId){
				$this->vacancyId = $vacancyId;
			}

			/*		Get Details of employee		*/
				function getDetails(){
					$query = "SELECT * 
										FROM company c, user_account a 
										WHERE c.user_id = a.user_id  
										AND c.user_id = '$this->id'";
					return $this->connect->getData($query);
				}

			/*		Post Vacancy		*/
			function postVacancy(){
				$date = date("Y-m-d");
				$query = "INSERT INTO vacancy(created_date, job_title, job_description, education, no_of_openings, job_availablity, salary, min_experience, job_level, deadline) Values ('$date','$this->jobTitle','$this->desc','$this->education','$this->openings','$this->availability','$this->salary','$this->experience','$this->level','$this->deadline') ";
				 $result = $this->connect->Iud($query);
				if($result)
				{
					$query1 = "INSERT INTO company_vacancy(company_id, vacancy_id) Values ($this->id,LAST_INSERT_ID())";
					return $this->connect->Iud($query1);
				}
				else{
					return $result;
				}
			}

			function listVacancies(){
				$query = "SELECT cv.company_id, c.company_name,cv.vacancy_id,v.job_title,v.created_date,v.job_level
									FROM company c, company_vacancy cv,vacancy v 
									WHERE cv.company_id = c.company_id
									AND cv.vacancy_id = v.vacancy_id
									AND c.company_id = $this->empId";
				return $this->connect->getData($query);					
			}

			function listCandidates(){
				$query = "SELECT jp.fname, jp.mname, jp.lname, u.email, jp.phone, jp.address, ja.profile_id , jp.user_id
				FROM jobs_applied ja, jobseeker_profile jp, user_account u
				WHERE ja.profile_id = jp.profile_id
				AND u.user_id = jp.user_id
				AND ja.vacancy_id = $this->vacancyId";
				return $this->connect->getData($query);

			}



			function updateGeneral(){
				$query = "UPDATE company SET
									company_name = '$this->name',
									description = '$this->desc',
									industry = '$this->industry',
									address = '$this->address',
									phone = '$this->phone',
									website = '$this->website'
									WHERE company_id = $this->empId ";
				return $this->connect->Iud($query);					
			}

			function getVacancy(){
				$query = "SELECT *
									FROM company c, company_vacancy cv, vacancy v 
									WHERE c.company_id = cv.company_id
									AND cv.vacancy_id = v.vacancy_id
									AND cv.company_id = $this->empId
									AND cv.vacancy_id = $this->vacancyId";
				return $this->connect->getData($query);					
			}





	}
