<?php
require_once 'connection.php';

		class User 
		{
			private $connect; 
			private$user_id;
			private $email;
			private $password;
			private $image;
			private $fname ;
			private  $mname;
			private  $lname;
			private  $dob;
			private  $gender;
			private  $address;
			private  $phone;
			private  $company_name;
			private  $description;
			private  $industry;
			private  $website;
			private  $user_type_id;
			


			function __construct()
			{
				$this->connect = new Connection();
			}

			/* setters */

			public function setUserTypeId($id){
				$this->user_type_id = $id;
			} 

			public function setUserId($id){
				$this->user_id = $id;
			} 

			public function setEmail($email){
				$this->email = $email;
			}

			public function setPassword($password){
				$this->password = $password;
			}

			public function setImage($image){
				$this->image = $image;
			}

			public function setFname($fname){
				$this->fname = $fname;
			}
			public function setMname($mname){
				$this->mname = $mname;
			}
			public function setLname($lname){
				$this->lname = $lname;
			}
			public function setDob($dob){
				$this->dob = $dob;
			}
			public function setGender($gender){
				$this->gender = $gender;
			}
			public function setAddress($address){
				$this->address = $address;
			}
			public function setPhone($phone){
				$this->phone = $phone;
			}
			public function setCompanyName($name){
				$this->company_name = $name;
			}
			public function setDescription($desc){
				$this->description = $desc;
			}
			public function setIndustry($industry){
				$this->industry = $industry;
			}
			public function setWebsite($website){
				$this->website = $website;
			}




			/* register function */

			function register(){
				$query = "INSERT INTO user_account (email,password,image,user_type_id) VALUES ('$this->email', '$this->password','$this->image','$this->user_type_id') ";

				$this->connect->Iud($query);

				// $id = $this->connect->getData("SELECT max(user_id) from user_account");
				// setUserId($id);
				

				if($this->user_type_id == 1){
					$query = "INSERT INTO jobseeker_profile(fname,mname,lname,dob,gender,address,phone,user_id) values ('$this->fname','$this->mname','$this->lname','$this->dob','$this->gender','$this->address','$this->phone',LAST_INSERT_ID())";
					return	$this->connect->Iud($query);
					

				}
				elseif ($this->user_type_id ==2) {
					$query = "INSERT into company (company_name,description,industry,address,phone,website,user_id) VALUES ('$this->company_name','$this->description','$this->industry','$this->address','$this->phone','$this->website',LAST_INSERT_ID())";
					return $this->connect->Iud($query);

					
				}
				else{

				}

			}


			/* login function */

			function login(){
				$query = "SELECT * FROM user_account WHERE email = '$this->email' AND password = '$this->password'";
				$data = $this->connect->getData($query);
				
				if(count($data) > 0){
					$userType = $data[0]['user_type_id'];
					$userId = $data[0]['user_id'];
					session_start();
					$_SESSION['permission']=true;
					$_SESSION['userType'] = $userType;
					$_SESSION['userId'] = $userId;
					return $userType;
					
				}
				else{
					return false;

				}
			}

			function checkEmail(){
				$query = "SELECT count(email) FROM user_account WHERE email='$this->email'";
				$data = $this->connect->getData($query);
				foreach ($data as $key) {
					$count = $key['count(email)'];
				}

				return $count;

			}

			function changeEmailPassword(){
			 // return $this->password;
				$query = "UPDATE user_account SET
									email = '$this->email',
									password = '$this->password'
									where user_id=$this->user_id ";
				return $this->connect->Iud($query);					
			}

			function changeEmail(){
				$query = "UPDATE user_account SET
									email = '$this->email'
									where user_id = $this->user_id";
				return $this->connect->Iud($query);

			}

			

			
			
			

		}


?>
