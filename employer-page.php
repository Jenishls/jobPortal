<?php
    session_start();
    require_once('employer.php');
    if(!isset($_SESSION['permission'])){
        header('location:index.php?msg=no-access');
    }
    $userId = $_SESSION['userId'];
    $user = $_SESSION['userType'];
    
    $employer = new Employer();
    $employer->setId($userId);
    $emp = $employer->getDetails();
    $employer->setEmpId($emp[0]['company_id']);
    $vacancies = $employer->listVacancies();
    
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
          <a class="navbar-brand" href="#" style="font-family: 'LOBSTER'">Job Portal</a>
          <ul class="navbar-nav">
          </ul>
          <ul class="navbar-nav ml-auto mr-auto">
             
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
   
    <header class="container-fluid" style="background-color: #7aced6">
          <!-- <img src="images/jobseeker.jpg" alt="job-seeker"> -->
          <div class=" py-5 text-white" >
              <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-10">
                      <h1> FIND THE RIGHT CANDIDATES  </h1>
                      <h1> YOU HAVE BEEN LOOKING FOR</h1>
                      <br />
                      <br />
                      
                  </div>
                  <div class="col-md-1"></div>
              </div>
          </div>
    </header>
    <section class="container-fluid">
      <div class="row">
        <div class="col-sm-2 py-3 sidebar" style="background-color: #add8c6">
          <ul>
            <li id="btn-postVacancies">Post Vacancies</li>
            <li id="btn-listVacancies">List Vacancies</li>
            <li id="btn-editProfile">Profile</li>
          </ul>
        </div>

        <div class="col-sm-10 ">
          <div class="py-5" id="postVacancies">
            <i class="fa fa-list-alt"></i> POST VACANCIES
              <hr>
            <form>
              <input type="hidden" name="id" value="<?php echo $emp[0]['company_id']; ?>">
              <div class="py-3">
                  <label>Job Title</label>
                  <input type="text" name="job-title" class="form-control">
              </div>

              <div class="py-3">
                  <label>Job Description</label>
                  <textarea rows="4" name="desc" class="form-control"></textarea>
              </div>

              <div class="py-3">
                  <label>Education</label>
                  <textarea rows="3" name="education" class="form-control"></textarea>
              </div>

              <div class="py-3">
                  <label>No of Openings</label>
                  <input type="number" name="openings" class="form-control">
              </div>

              <div class="py-3">
                  <label>Job Availablity</label>
                  <br>
                  <div class="row">
                      <div class="col-6">
                          <input type="radio" name="job-availability" id="full" value="">Full-time
                      </div>
                      <div class="col-6">
                          <input type="radio" name="job-availability" id="part" value="">Part-time
                      </div>
                  </div>
       
              </div>
              <div class="py-3">
                <label>Salary</label>
                <input type="text" name="salary" placeholder="Blank means 'negotiable' " class="form-control">
              </div>

              <div class="py-3">
                <label>Min-experience</label>
                <select class="form-control" name="exp">
                  <option value="">--</option>
                  <option>1 year</option>
                  <option>2 years</option>
                  <option>3 years</option>
                  <option>4 years</option>
                  <option>5 years</option>
                  <option>6 years</option>
                  <option>7 years</option>
                  <option>8 years</option>
                  <option>9 years</option>
                  <option>10 years</option>
                  <option>11 years</option>
                  <option>12 years</option>
                  <option>13 years</option>
                  <option>14 years</option>
                  <option>15 years</option>
                  <option>16 years</option>
                  <option>17 years</option>
                  <option>18 years</option>
                  <option>19 years</option>
                  <option>20 years</option>
                </select>
              </div>

              <div class="py-3">
                <label>Job level</label>
                <select class="form-control" name="level">
                  <option value="">--</option>
                  <option>Entry Level</option>
                  <option>Low Level</option>
                  <option>Mid Level</option>
                  <option>Senior Level</option>
                </select>
              </div>

              <div class="py-3">
                <label>Deadline</label>
                <input type="date" name="deadline" class="form-control">
              </div>

              <button id="post-vacancy" class="my-3 btn btn-lg btn-success">Post Vacancy</button>


            </form>
          </div>

          <div class="py-5" id="listVacancies">
            <i class="fa fa-list-alt"></i> LIST VACANCIES
            <hr>
            <?php foreach($vacancies as $vacancy){?>
            <div class="row container">
                <div class="col-8">
                    
                    <h5>
                        <?php echo $vacancy['job_title'] ?>
                            
                        </h5>
                    <p class="lead">
                        <?php echo $vacancy['company_name'] ?>
                            
                        </p>
                    <small>
                        <?php echo $vacancy['created_date'] ?>
                         
                    </small>
                </div>
                <div class="col-sm-4">
                    <?php echo $vacancy['job_level'] ?>

                    <a href="" class="my-4 btn btn-sm btn-primary" data-vacancy-id="<?php echo $vacancy['vacancy_id']?>">List Candidates</a>
                </div>
            </div>
            <hr />
            <?php } ?>
          </div>

          <div class="py-5" id="editProfile">
            <div class="px-4 py-4" id="general-btn">
              <h3>General</h3>

            </div>
            
            <div class="px-4 py-5" id="general">
              <h2><?php echo $emp[0]['company_name'] ?></h2>
              <h5 class="text-muted PY-3"> INDUSTRY : <?php echo $emp[0]['industry'] ?></h5>
              <p class="lead py-2">
                <?php echo $emp[0]['description'] ?>
              </p>
              <h5 class="text-muted"> CONTACT </h5>
              <table class="table">
                <tr>
                  <th>Address</th>
                  <td><?php echo $emp[0]['address'] ?></td>
                </tr>
                <tr>
                  <th>Phone</th>
                  <td><?php echo $emp[0]['phone'] ?></td>
                </tr>
                <tr>
                  <th>Website</th>
                  <td><?php echo $emp[0]['website'] ?></td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td><?php echo $emp[0]['email'] ?></td>
                </tr>
              </table>
              <button class="btn btn-lg btn-success my-4" id="">Edit Profile</button>
            </div>
            <div id="editForm">
              <button class="btn btn-md btn-info float-right">&laquo; Back</button>
              <form>
                <legend>Employer Form</legend>
                <input type="hidden" name="company-id" value="<?php echo $emp[0]['company_id'] ?>">
                  <div>
                    <label>Company Name</label>
                    <input type="text" name="companyName" class="form-control" value="<?php echo $emp[0]['company_name'] ?>">
                  </div>
                  <div>
                    <label>Description</label>
                    <textarea rows="4" name="description" class="form-control"><?php echo $emp[0]['description'] ?></textarea>
                  </div>
                  <div>
                    <label> Industry</label>
                    <input type="text" name="industry" class="form-control" value="<?php echo $emp[0]['industry'] ?>">
                  </div>
                  <div>
                    <label> Address</label>
                    <input type="text" name="employer-address" class="form-control" value="<?php echo $emp[0]['address'] ?>">
                  </div>
                  <div>
                    <label> Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo $emp[0]['phone'] ?>">
                  </div>
                  <div>
                    <label>Website</label>
                    <input type="text" name="website" class="form-control" value="<?php echo $emp[0]['website'] ?>">
                  </div>
                  
                  <div class="py-5">
                    <input type="submit" name="employer-update-btn" class="btn btn-success form-control" value="Update">
                  </div>
              </form>  
            </div>
            
            <div class="px-4 py-4" id="login-btn">
              <h3>Edit Security and Login</h3>
            </div>

            <div id="login-error-msg" class="alert alert-danger"></div>
            <div class="px-4 py-5" id="login">
              <form>
                <input type="hidden" name="id" value="<?php echo $emp[0]['user_id']?>">
                  <div class="py-3">
                    <label>Enter New Email</label>
                   
                      <input type="email" name="employer-email" id="employer-email" class="form-control" value="<?php echo $emp[0]['email']?>" placeholder="Old Email : <?php echo $emp[0]['email']?>">
                    
                  </div>
                  
                  <div class="py-3"> 
                    <label>New Password</label>
                   
                      <input type="password" name="employer-password" id="employer-password" class="form-control">
                    
                  </div>
                  <div class="py-3"> 
                    <label>Confirm New Password</label>
                   
                      <input type="password" name="employer-confirm-password" id="confirm-password" class="form-control">
                    
                  </div>  
                  <div class="py-3">
                    
                   
                      <input type="submit" name="emp-login-update" class="btn btn-md btn-success float-right" value="Edit Credentials">
                      
                  </div>
                  

                  
                
              </form>
            </div>
          </div>

          <div class="py-5 px-2" id="listCandidates">
            <i class="fa fa-list-alt"></i>
            LISTING CANDIDATES
            <button class="float-right btn btn-md" id="candidate-back">
                &laquo; Back
            </button>
            <hr>
            <div id="list-error-msg" class="alert alert-danger">
                
                <h5></h5>
            </div>
            <table class="table" >
              <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>

          <div class="py-5" id="candidateProfile">
            <button class="btn btn-md btn-info float-right">&laquo; Back</button>
            
            <h4>Personal Information</h4>
            <table class="table my-3" id="candidatePersonal">
                <tbody ></tbody>
            </table>
            
            <div class="py-3">
              <h4>Education Information</h4>
              <table class="table my-3">
                <thead>
                <tr>
                  <th>Level</th>
                  <th>Passed Year</th>
                  <th>Institute</th>
                  <th>Score</th>
                  <th>Major</th>
                  <th>Board</th>
                </tr>  
                </thead>
                
                <tbody id="candidateEducation"></tbody>  
              </table>
            </div>
            
            <div class="py-3">
              <h4>Experience Information</h4>
              <table class="table my-3">
                <tr>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Company Name</th>
                  <th>Job Title</th>
                </tr>
                <tbody id="candidateExperience"></tbody>
              </table>  
            </div>
            
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
    <script src="js/employer.js"></script>
    <script src="js/main.js"></script>
  </body>

</html>