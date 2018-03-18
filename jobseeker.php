<?php
	require_once 'connection.php';
	
	/**
	* 
	*/
	class Jobseeker
	{

		private $connect;
		
		function __construct()
		{
			$this->connect = new Connection();
		}

		/*	Insert data  */

			// function insertSkills(){
			// 	$query = "INSERT INTO skills(skill_name,skill_level,profile_id) VALUES('$this->skillName','$this->skillLevel',$this->id)";

			// }

			function insertEducation(){
				$query = "INSERT INTO education_detail(level, passed_year, institute, score, major, board, profile_id) VALUES('$this->level','$this->passedYear','$this->institute','$this->score','$this->major','$this->board',$this->id)";

			}

			function insertExperience(){
				$query = "INSERT INTO experience_detail(start_data, end_date, company_name, job_title, profile_id) VALUES('$this->startDate','$this->endDate','$this->companyName','$this->jobTitle',$this->id)";

			}

		/*	Retrive data  */
			function getProfile(){
				$query="SELECT * FROM jobseeker_profile where profile_id = $this->id";
				return $this->connect->getData($query);

			}

			// function getSkills(){
			// 	$query = "SELECT * FROM skills where profile_id = $this->id";
			// 	return $this->connect->getData($query);

			// }

			function getEducation(){
				$query = "SELECT * FROM education_detail where profile_id = $this->id";
				return $this->connect->getData($query);

			}

			function getExperience(){
				$query = "SELECT * FROM experience_detail where profile_id = $this->id";
				return $this->connect->getData($query);

			}

		/*	Update data*/
			function updateProfile(){
				$query = "UPDATE jobseeker_profile set
					fname='$this->fname',
				 	mname='$this->mname',
				 	lname='$this->lname',
				 	dob='$this->dob',
				 	gender='$this->gender',
				 	address = '$this->address',
				 	phone = '$this->phone'
				 	where profile_id=$this->id";
			}

			// function updateSkills(){
			// 	$query = "UPDATE skills set
			// 		skill_name='$this->skillName',
			// 	 	skill_level='$this->skillLevel'
			// 	 	where profile_id=$this->id";
			// }

			function updateEducation(){
				$query = "UPDATE education_detail set
					level='$this->level',
				 	passed_year='$this->passedYear',
				 	institute='$this->institute',
				 	score='$this->score',
				 	major='$this->major',
				 	board = '$this->board'
				 	
				 	where profile_id=$this->id";
			}

			function updateExperience(){
				$query = "UPDATE experience_detail set
					start_data='$this->startDate',
				 	end_date='$this->endDate',
				 	company_name='$this->companyName',
				 	job_title='$this->jobTitle'
				 	where profile_id=$this->id";
			}

		/*	Delete data  */

		/*	 Find Relevant Jobs  */
			// function jobs(){
			// 	$query1 = "SELECT * from jobseeker_profile_skills where profile_id = $this->id";
			// 	$skill = $this->connect->getData($query1);

			// 	$jobs= [];
			// 	foreach ($skill as $key) {
			// 		$query2 = "SELECT * from skills_vacancy where skill_id = $key['skill_id'] ";
			// 		$data = $this->connect->getData($query2);
			// 	}
			// }

		/*	Applied Jobs	*/
			function appliedJobs(){
				$query = "SELECT * FROM jobs_applied where profile_id=$this->id";
				return $this->connect->getData($query);
			}

	}