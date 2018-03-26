<?php
	require_once 'connection.php';
	
	/**
	* 
	*/
	class Jobseeker
	{
		/*		Variables		*/
			private $id;
			private $jobTitle;
			private $address;
			private $industry;
			private $profileId;
			private $level;
			private $passedYear;
			private $institute;
			private $score;
			private $major;
			private $board;
			private $startDate;
			private $endDate;
			private $companyName;
			private $category;
			private $vacancyId;
		
			private $connect;
		
		function __construct()
		{
			$this->connect = new Connection();
		}

		/*	setters  */
			function setId($id){
				$this->id = $id;
			}
			function setProfileId($id){
				$this->profileId = $id;
			}

			function setJobTitle($title){
				$this->jobTitle = $title;
			}

			function setLocation($location){
				$this->location = $location;
			}
			function setIndustry($industry){
				$this->industry = $industry;
			}

			function setLevel($level){
				$this->level = $level;
			}
			function setPassedYear($passedYear){
				$this->passedYear = $passedYear;
			}
			function setInstitute($institute){
				$this->institute = $institute;
			}
			function setScore($score){
				$this->score = $score;
			}
			function setMajor($major){
				$this->major = $major;
			}
			function setBoard($board){
				$this->board = $board;
			}
			function setStartDate($startDate){
				$this->startDate = $startDate;
			}
			function setEndDate($endDate){
				$this->endDate = $endDate;
			}
			function setCompanyName($companyName){
				$this->companyName = $companyName;
			}
			function setCategory($category){
				$this->category = $category;
			}
			function setVacancyId($vacancyId){
				$this->vacancyId = $vacancyId;
			}

		/*	Insert data  */

			function insertEducation(){
				$query = "INSERT INTO education_detail(level, passed_year, institute, score, major, board, profile_id) VALUES('$this->level','$this->passedYear','$this->institute','$this->score','$this->major','$this->board',$this->profileId)";
				return $this->connect->Iud($query);

			}

			function insertExperience(){
				$query = "INSERT INTO experience_detail(start_date, end_date, company_name, job_title, profile_id) VALUES('$this->startDate','$this->endDate','$this->companyName','$this->jobTitle',$this->profileId)";
				return $this->connect->Iud($query);

			}

			function insertInterestedCategory(){
				$query = "INSERT INTO interested_category(profile_id,category_id) VALUES ($this->profileId,$this->category)";
				return $this->connect->Iud($query);
			}

			function insertJobApplied(){
				$query = "INSERT INTO jobs_applied(vacancy_id,profile_id) VALUES ($this->vacancyId, $this->profileId)";
				return $this->connect->Iud($query);
			}

		/*	Retrive data  */
			function getProfile(){
				$query="SELECT * FROM jobseeker_profile where user_id = $this->id";
				return $this->connect->getData($query);
			}

			function getEducation(){
				
				$query = "SELECT * FROM education_detail where profile_id = $this->profileId";
				return $this->connect->getData($query);

			}

			function getExperience(){
				$query = "SELECT * FROM experience_detail where profile_id = $this->profileId";
				return $this->connect->getData($query);

			}

			function getCategory(){
				$query = "SELECT * from job_category WHERE job_category_id not in(SELECT category_id from interested_category WHERE profile_id = $this->profileId)";
				return $this->connect->getData($query);
			}

			function getInterestedCategory(){
				$query = "SELECT ic.category_id, ic.profile_id, c.job_category FROM interested_category ic, job_category c 
									WHERE ic.category_id = c.job_category_id 
									AND profile_id = $this->profileId";
				return $this->connect->getData($query);
			}

			// function getAppliedJobs(){
			// 	$query = "SELECT * FROM jobs_applied WHERE profile_id = $this->profileId";
			// 	return $this->connect->getData($query);
			// }

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
				 	return $this->connect->Iud($query);
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
				 	
				 	where edu_detail_id=$this->id";
				 	return $this->connect->Iud($query);
			}

			function updateExperience(){
				$query = "UPDATE experience_detail set
					start_date='$this->startDate',
				 	end_date='$this->endDate',
				 	company_name='$this->companyName',
				 	job_title='$this->jobTitle'
				 	where exp_detail_id=$this->id";
				 	return $this->connect->Iud($query);
			}

		/*	Delete data  */
			function delEdu(){
				$query = "DELETE FROM education_detail WHERE edu_detail_id = $this->id ";
				return $this->connect->Iud($query);
			}

			function delExp(){
				$query = "DELETE FROM experience_detail WHERE exp_detail_id = $this->id ";
				return $this->connect->Iud($query);
			}

			function delIntrestedCategory(){
				$query = "DELETE FROM interested_category WHERE profile_id = $this->profileId and category_id = $this->id";
				return $this->connect->Iud($query);
			}

		/*	 Find Relevant Jobs  */
			function relevantJobs(){
				$query = "SELECT c.company_name, c.company_id, v.vacancy_id, v.created_date, v.job_title,v.job_level
					FROM jobseeker_profile jp, interested_category ic, job_category jc, vacancy v, company_vacancy cv, company c
					WHERE jp.profile_id = ic.profile_id
					AND ic.category_id = jc.job_category_id
					AND jc.job_category_id = v.category_id
					AND v.vacancy_id = cv.vacancy_id
					AND cv.company_id = c.company_id
					AND jp.profile_id = $this->profileId
					ORDER BY v.created_date DESC
					LIMIT 25
					";
				return $this->connect->getData($query);
			}

		/*	Applied Jobs	*/
			function appliedJobs(){
				$query = "SELECT c.company_name,c.company_id, v.vacancy_id, v.created_date,v.job_title, v.job_level
									FROM jobs_applied ja, vacancy v, company_vacancy cv, company c 
									WHERE ja.vacancy_id = v.vacancy_id
									AND v.vacancy_id = cv.vacancy_id 
									AND cv.company_id = c.company_id
									AND ja.profile_id = $this->profileId";
				return $this->connect->getData($query);
			}

		/*	Job Search  */
			function jobSearch(){
				$query = "SELECT c.company_name, v.vacancy_id, v.created_date,v.job_title, v.job_level 
									from vacancy v, company c
									where v.job_title ='$this->jobTitle'
									OR c.industry = '$this->industry'
									OR c.address = '$this->address'";
				return $this->connect->getData($query);					
			}	

	}