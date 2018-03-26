<?php
  session_start();
  require_once('jobseeker.php');
  if(!isset($_SESSION['permission'])){
      header('location:index.php?msg=no-access');
  }
  $userId = $_SESSION['userId'];
  
  $user = $_SESSION['userType'];
  
  $jobseeker = new Jobseeker();
  $jobseeker->setId($userId);
  $profile = $jobseeker->getProfile();  
  $profileId = $profile[0]['profile_id'];
  $jobseeker->setProfileId($profileId);
  $edu = $jobseeker->getEducation();
  $exp = $jobseeker->getExperience();  
  $jobs = $jobseeker->relevantJobs();
  $applied = $jobseeker->appliedJobs();
  $interested = $jobseeker->getInterestedCategory();
  $category = $jobseeker->getCategory();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Online Job Portal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-light navbar-light">
    <a class="navbar-brand"  href="#" style="font-family: 'lobster'">Job Portal</a>
    <ul class="navbar-nav">
    </ul>
    
    <ul class=" navbar-nav ml-auto">
      <li class="nav-item ">
        <a class="nav-link btn " href="logout.php" >
          <i class="fa fa-user"></i>
          Logout
        </a>
        <li class="nav-item">
          <a class="nav-link btn">
            <i class="fa fa-question-circle"></i>Help
          </a>
        </li>
      </li>
    </ul>
  </nav>
  <header class="container-fluid" style="background-color: red">
  
    <div class="text-white py-5">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <h1> WELCOME</h1>
          <h2>
            <?php echo $profile[0]['fname']; 
                echo "&nbsp;";
             if(isset($profile[0]['mname'])){
                echo $profile[0]['mname'];
                echo "&nbsp;";   
             }
              
             echo $profile[0]['lname'];?>
          </h2>
          <br />
          <br />
        </div>
        <div class="col-md-1"></div>
      </div>
    </div>
  </header>
  <section class="container-fluid">
    <div class="row">
      <div class="col-sm-2 py-3 sidebar" style="background-color: #7bced6">
        <ul>
            <li id="btn-jobsForYou">Jobs For You</li>
            <li id="btn-appliedJobs">Applied Jobs</li>
            <li id="btn-searchJobs">Search Jobs</li>
            <li id="btn-editProfile">Edit Profile</li>
        </ul>
      </div>
      <div class="col-sm-10">
        <!-- Personal Profile -->
        <div class="row" id="jobsForYou">
          <div class="col-sm-8 py-5" >
            <i class="fa fa-list-alt"></i> JOBS FOR YOU
            <hr>
            <?php 
              if(count($jobs)==0)
                echo "<p class='lead'> Fill all your information to see relevant jobs.</p>";
          
              else{
            foreach ($jobs as $job) {
              
             ?>
            <div class="row container" id="vacancyList">
                <div class="col-8">
                    <h5><?php echo $job['job_title']?></h5>
                    <p class="lead"><?php echo $job['company_name']?></p>
                    <small><?php echo $job['created_date']?></small>
                </div>
                <div class="col-sm-4">
                    <?php echo $job['job_level']?><br />
                    <button class='btn btn-md btn-info px-2' data-vacancy-id="<?php echo $job['vacancy_id']?>" data-company-id='<?php echo $job["company_id"]?>' data-profile='<?php echo $profileId?>'> View Detail</button>
                </div>
            </div>
            <hr />
            <?php } }?>
          </div>
          
          <div class="col-sm-4 my-4 py-2 px-2 border " id="interested"> 
            <p class="lead text-center">
              Interested <br> Job Categories 
            </p>
            <hr />
            <button class="btn btn-primary my-2 ">+ Add category</button>
            <div class="py-2 alert alert-info">
              <form class="form-inline">
                <input type="hidden" name="profile-id" value="<?php echo $profileId?>">
                <select name="category" class="form-control">
                  <option value="">-</option>
                  <?php foreach($category as $cat){?>
                  
                  <option value="<?php echo $cat['job_category_id'] ?>">
                    <?php echo $cat['job_category']?>
                  </option>
                  <?php } ?>
                </select>
                <button class="btn btn-sm btn-success mx-2" data-id="<?php echo $profileId?>">Add</button>
              </form>
            </div>
            
            <table class="table alert alert-info text-center">
              <tbody id="showInterested">
                <?php foreach($interested as $interest){?>
                <tr>
                  <td>
                    <?php echo $interest['job_category']?>
                  </td>
                  <td>
                    <button class="btn btn-danger btn-sm" 
                            data-id="<?php echo $interest['category_id']?>" 
                            data-profile="<?php echo $profileId?>">-</button>
                  </td>
                </tr>
                <?php }?>
              </tbody>
            </table>
            <small class="text-muted">(Helps in showing relevant jobs)</small>
          </div>
        </div>
        <div class="py-5" id="appliedJobs">
          <i class="fa fa-list-alt"></i>APPLIED JOBS
          <hr>
          <?php
          
          if(count($applied)==0)
            echo "<p class='lead'> You havent applied any jobs </p>";
          
          else{
          foreach($applied as $apply){
            ?>
          <div class="row container">
              <div class="col-8">
                  <h5><?php echo $apply['job_title']?></h5>
                  <p class="lead"><?php echo $apply['company_name']?></p>
                  <small> <?php echo $apply['created_date']?></small>
              </div>
              <div class="col-4">
                  <?php echo $apply['job_level']?>
                  <br />
                  <button class='btn btn-md btn-info px-2' data-vacancy-id='<?php echo $apply['vacancy_id']?>' data-company-id='<?php echo $apply["company_id"]?>' data-profile='<?php echo $profileId?>'> View Detail</button>
              </div>
          </div>
          <hr />
            <?php } }?>
        </div>
        <div class="py-5" id="searchJobs">
          <i class="fa fa-list-alt"></i> SEARCH JOBS
          <hr>
          <form>
              <div class="row">
                  <div class="col-md-6">
                      <label>
                          <h4>Job Title</h4></label>
                      <input type="text" name="job-title" class="form-control">
                  </div>
                  <div class="col-md-6">
                      <label>
                          <h4>Location</h4></label>
                      <input type="text" name="location" class="form-control">
                  </div>
              </div>
              <div class="row py-3">
                  <div class="col-md-6">
                      <label>
                          <h4>Industry</h4></label>
                      <input type="text" name="industry" class="form-control">
                  </div>
              </div>
              <hr />
              <div class="row">
                <div class="container" id="error-msg"><h3></h3></div>
                  <div class="ml-auto">
                      <input type="submit" name="search" class="btn btn-lg btn-red" value="Begin Searching&raquo;">
                  </div>
              </div>
          </form>
          <div  class ="py-5" id="search-result">
              <i class="fa fa-list-alt"></i> SEARCH RESULTS
              <hr>
              <div id="result"></div>
          </div>
        </div>
        <div class="py-5" id="editProfile">
          <div class="py-4 px-4" id="personal-btn">
            <h3>Personal Information</h3>
          </div>
                
          <div class="py-4 px-4" id="personal">
            <form>
              <legend>Update Personal Information</legend>
              <input type="hidden" name="profile-id" value="<?php echo $profileId?>">
              <div>
                <label>First Name</label>
                <input type="text" name="jobseeker-fname" class="form-control" value="<?php echo $profile[0]['fname']?>">
              </div>
              <div>
                <label>Middle Name</label>
                <input type="text" name="jobseeker-mname" value="<?php echo $profile[0]['mname']?>" class="form-control">
              </div>
              <div>
                <label>Last Name</label>
                <input type="text" name="jobseeker-lname" value="<?php echo $profile[0]['lname']?>" class="form-control">
              </div>
              <div>
                <label> Date of Birth</label>
                <input type="date" name="jobseeker-dob" value="<?php echo $profile[0]['dob']?>" class="form-control">
              </div>
              <div>
                  <label>Gender</label>
                  <select class="form-control" value="<?php echo $profile[0]['gender']?>">
                      <option value="">--</option>
                      <option value="Male">
                          Male
                      </option>
                      <option value="Female">
                          Female
                      </option>
                      <option value="Others">
                          Others
                      </option>
                  </select>
                
              </div>  
              <div>
                <label> Address</label>
                <input type="text" name="address" value="<?php echo $profile[0]['address']?>" class="form-control">
              </div>
              <div>
                <label> Phone</label>
                <input type="text" name="phone" value="<?php echo $profile[0]['phone']?>" class="form-control">
              </div>
              
              <div class="py-4">
                <input type="submit" name="personal-submit" class="btn btn-success form-control" value="Submit">
              </div>
            </form>
          </div>

          <div class="py-4 px-4" id="education-btn">
            <h3>Education Information</h3>
          </div>
          <div class="py-4 px-4" id="education">
            <div id="edu-show">
              <button class="btn btn-primary btn-lg float-right " id="add-edu">+ Add Education Detail</button>
              <table class="table">
                <tr>
                  <th>Level</th>
                  <th>Passed Year</th>
                  <th>Institute</th>
                  <th>Score</th>
                  <th>Major</th>
                  <th>Board</th>
                  <th>Action</th>
                </tr>
                <tbody id="showTable">
                <?php if(isset($edu)){
                  foreach($edu as $ed){ ?>
                
                <tr>
                  <td><?php echo $ed['level'] ?></td>
                  <td><?php echo $ed['passed_year'] ?></td>
                  <td><?php echo $ed['institute'] ?></td>
                  <td><?php echo $ed['score'] ?></td>
                  <td><?php echo $ed['major'] ?></td>
                  <td><?php echo $ed['board'] ?></td>
                  <td>
                    <button class="btn btn-md btn-success"
                    data-id="<?php echo $ed['edu_detail_id'] ?>"
                    data-level="<?php echo $ed['level'] ?>"
                    data-passed-year="<?php echo $ed['passed_year'] ?>"
                    data-institute="<?php echo $ed['institute'] ?>"
                    data-score="<?php echo $ed['score'] ?>"
                    data-major="<?php echo $ed['major'] ?>"
                    data-board="<?php echo $ed['board'] ?>"  > Edit </button> 
                    <button class="btn btn-md btn-danger" data-id="<?php echo $ed['edu_detail_id'] ?>" data-profile="<?php echo $profileId ?>"> Delete </button>
                  </td>
                </tr>  
                <?php } } ?>  
                </tbody>
                      
              </table>
            </div>
            <div id="edu-add">
              <button class="btn btn-md btn-info float-right">&laquo; Back</button>
              <form>
                <legend>Add Education Detail</legend>
                <input type="hidden" name="profile-id" value="<?php echo $profileId?>">
                <div>
                  <label>Level</label>
                  <input type="text" name="level" class="form-control" autofocus="">
                </div>
                <div>
                  <label>Passed-year</label>
                  <input type="text" name="passed-year" class="form-control">
                </div>
                <div>
                  <label>Institute</label>
                  <input type="text" name="institute" class="form-control">
                </div>
                <div>
                  <label>Score</label>
                  <input type="text" name="score" class="form-control">
                </div>
                <div>
                  <label>Major</label>
                  <input type="text" name="major" class="form-control">
                </div>
                <div>
                  <label>Board</label>
                  <input type="text" name="board" class="form-control">
                </div>
                <div class="py-3">
                  
                  <input type="button" name="edu-add-submit" class="form-control btn btn-md btn-success" value="Submit">
                </div>
              </form>  
            </div>
            <div id="edu-update">
              <button class="btn btn-md btn-info float-right">&laquo; Back</button>
              <form>
                <legend>Update Education Detail</legend>
                <input type="hidden" name="edu-id" value="">
                <input type="hidden" name="profile-id" value="<?php echo $profileId;?>">
                <div>
                  <label>Level</label>
                  <input type="text" name="level" class="form-control">
                </div>
                <div>
                  <label>Passed-year</label>
                  <input type="text" name="passed-year" class="form-control">
                </div>
                <div>
                  <label>Institute</label>
                  <input type="text" name="institute" class="form-control">
                </div>
                <div>
                  <label>Score</label>
                  <input type="text" name="score" class="form-control">
                </div>
                <div>
                  <label>Major</label>
                  <input type="text" name="major" class="form-control">
                </div>
                <div>
                  <label>Board</label>
                  <input type="text" name="board" class="form-control">
                </div>
                <div class="py-3">
                  
                  <input type="button" name="edu-update-submit" class="form-control btn btn-md btn-success" value="Submit">
                </div>
              </form>
            </div>
                
          </div>
          <div class="py-4 px-4" id="experience-btn">
              <h3>Experience Information</h3>
          </div>
          <div class="py-4 px-4" id="experience">
            <div id="exp-show">
              <button class="btn btn-md btn-primary float-right">
                + Add Experience Information
              </button>
              <table class="table">
                <tr>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Company Name</th>
                  <th>Job Title</th>
                  <th>Action</th>
                </tr>
                <tbody id="table">
                  <?php if(isset($exp)){
                    foreach ($exp as $ex) {
                  ?>
                  <tr>
                    <td><?php echo $ex['start_date'] ?></td>
                    <td><?php echo $ex['end_date'] ?></td>
                    <td><?php echo $ex['company_name'] ?></td>
                    <td><?php echo $ex['job_title'] ?></td>
                    <td>
                      <button class="btn btn-md btn-success"  
                        data-id="<?php echo $ex['exp_detail_id'] ?>" 
                        data-start-date="<?php echo $ex['start_date'] ?>" 
                        data-end-date="<?php echo $ex['end_date'] ?>" 
                        data-company-name="<?php echo $ex['company_name'] ?>" 
                        data-job-title="<?php echo $ex['job_title'] ?>" 
                         data-profile="<?php echo $profileId;?>">Edit</button> 
                      <button class="btn btn-md btn-danger" data-id="<?php echo $ex['exp_detail_id'] ?>" data-profile="<?php echo $profileId;?>">Delete</button>
                    </td>
                  </tr>
                  <?php } } ?>

                </tbody>
              </table>
            </div>
            <div id="exp-add">
              <button class="btn btn-info btn-md float-right">&laquo; Back</button>
              <br>
              <form>
                <legend>Add Experience Detail</legend>
                  <input type="hidden" name="profile-id" value="<?php echo $profileId?>">
                  <div class="py-2">
                    <label>Start Date</label>
                    <input type="date" name="start-date" class="form-control" value="">
                  </div>
                  <div>
                    <label>End Date</label>
                    <input type="date" name="end-date" class="form-control" value="">
                  </div>
                  <div>
                    <label>Company Name</label>
                    <input type="text" name="company-name" class="form-control" value="">
                  </div>
                  <div>
                    <label>Job Title</label>
                    <input type="text" name="job-title" class="form-control" value="">
                  </div>
                  <div class="py-3">
                    
                    <input type="button" name="exp-add-submit" class="form-control btn btn-md btn-success" value="Submit">
                  </div>
              </form>
            </div>
            <div id="exp-update">
              <button class="btn btn-md btn-info float-right">&laquo; Back</button>
              <form>
                <legend>Update Experience Detail</legend>
                  <input type="hidden" name="profile-id" value="<?php echo $profileId?>">
                  <input type="hidden" name="id">
                  <div>
                    <label>Start Date</label>
                    <input type="text" name="start-date" class="form-control" value="">
                  </div>
                  <div>
                    <label>End Date</label>
                    <input type="text" name="end-date" class="form-control" value="">
                  </div>
                  <div>
                    <label>Company Name</label>
                    <input type="text" name="company-name" class="form-control" value="">
                  </div>
                  <div>
                    <label>Job Title</label>
                    <input type="text" name="job-title" class="form-control" value="">
                  </div>
                  <div class="py-3">
                    
                    <input type="button" name="exp-update-submit" class="form-control btn btn-md btn-success" value="Submit">
                  </div>
              </form>
            </div>
              
          </div>
        </div>
        <div class="py-5" id="vacancy"></div>
        <div class="py-5" id="appliedJobDetail"></div>

      </div>
              
        
      </div>
      
    </div>
  </section>
    <footer>
        <div class="row">
            <div class="col-md-3 col-sm-1">
                <h4><strong>Information</strong></h4> About
                <br> Terms & Conditions
                <br> Privacy Policy
                <br> FAQ
                <br>
            </div>
            <div class="col-lg-3 col-sm-12">
                <h4><strong>Candidates</strong></h4> Find a Job
                <br /> Apply for a Job
                <br />
            </div>
            <div class="col-md-3 col-sm-12">
                <h4><strong>Follow Us</strong> </h4>
                <br>
                <div class="row">
                    <div class="col-md-2">
                        <i class="fab fa-facebook-square" style='font-size:25px;'></i>
                    </div>
                    <div class="col-lg-2">
                        <i class="fab fa-twitter-square" style='font-size:25px;'></i>
                    </div>
                    <div class="col-lg-2">
                        <i class="fab fa-instagram" style='font-size:25px;'></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <h4><strong>Contact Us</strong></h4>
                <i class="fa fa-flag"></i> Kathmandu, Nepal
                <br>
                <i class="fa fa-envelope-open"></i> lookforjobs@gmail.com
                <br>
                <i class="fa fa-phone"></i> +422226, +977-9867111111
                <br>
                <br>
            </div>
        </div>
    </footer>
    <script src="js/jquery.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jobseeker.js"></script>

</body>

</html>