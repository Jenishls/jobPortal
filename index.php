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
    <a class="navbar-brand" href="#" style="font-family: 'lobster'">Job Portal</a>
    <ul class="navbar-nav">
    </ul>
    
    <ul class=" navbar-nav ml-auto">
      <li class="nav-item ">
        <a class="nav-link btn " href="#" data-toggle="modal" data-target="#myModal" role="button">
          <i class="fa fa-user"></i>
          Login
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn">
          <i class="fa fa-question-circle"></i>Help
        </a>
      </li>
    </ul>
  </nav>
  <!-- The Login Modal -->
  <div class="modal fade " id="myModal">
    <div class="modal-dialog  modal-sm modal-dialog-centered">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="text-center">LOGIN</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <form id="login-form">
            <label><b>Email</b></label>
            <div class="form-group">
              <input type="text" autofocus class="form-control" placeholder="Enter Email" name="email" required>
            </div>
            <label><b>Password</b></label>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Enter Password" name="psw" required>
            </div>
            <div class="form-group row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <a href="" tabindex="6" class="form-control btn btn-primary " data-toggle="modal" data-target="#register" )">Register</a>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <input type="submit" name="login" id="login-submit" tabindex="4" class="form-control btn btn-success" value="Log In" />
              </div>
            </div>
            <div class="form-group">
              <input type="checkbox" checked="checked"> Remember me
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- The Register Modal -->
  <div class="modal fade " id="register" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4>Register</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="row choose">
            <div class="col-6">
              <h4> Are you </h4>
              <button id="choose-jobseeker">
                <img src="images/reg-jobseeker.jpeg" alt="jobseeker-image">
              </button>
            </div>
            <div class="col-6">
              <h4> or </h4>
              <button id="choose-employer">
                <img src="images/reg-employer.jpeg" alt="employer-image">
              </button>
            </div>
          </div>
          <div class="container py-5">
            <div id="reg-jobseeker-form">
              <form>
                <legend>JobSeeker Form</legend>
                <input type="hidden" name="user-type-id" value="1">
                <div>
                  <label>First Name</label>
                  <input type="text" name="jobseeker-fname" class="form-control">
                </div>
                <div>
                  <label>Middle Name</label>
                  <input type="text" name="jobseeker-mname" class="form-control">
                </div>
                <div>
                  <label>Last Name</label>
                  <input type="text" name="jobseeker-lname" class="form-control">
                </div>
                <div>
                  <label> Date of Birth</label>
                  <input type="date" name="jobseeker-dob" class="form-control">
                </div>
                <div>
                  <label> Address</label>
                  <input type="text" name="jobseeker-address" class="form-control">
                </div>
                <div>
                  <label> Phone</label>
                  <input type="text" name="jobseeker-phone" class="form-control">
                </div>
                <div>
                  <label>Email</label>
                  <input type="email" name="jobseeker-email" class="form-control" id="jobseeker-email">
                </div>
                <div>
                  <label> Password</label>
                  <input type="password" name="jobseeker-password" id="jobseeker-password" class="form-control">
                </div>
                <div>
                  <label>Confirm Password</label>
                  <input type="password" name="jobseeker-confirm-password" id="jobseeker-confirm-password" class="form-control">
                </div>
                <div class="py-4">
                  <input type="submit" name="jobseeker-register-btn" class="btn btn-success form-control" value="Register">
                </div>
              </form>
            </div>
            <div id="reg-employer-form">
              <form>
                <legend>Employer Form</legend>
                <input type="hidden" name="user-type-id" value="2">
                <div>
                  <label>Company Name</label>
                  <input type="text" name="companyName" class="form-control">
                </div>
                <div>
                  <label>Description</label>
                  <textarea rows="4" name="description" class="form-control"></textarea>
                </div>
                <div>
                  <label> Industry</label>
                  <input type="text" name="industry" class="form-control">
                </div>
                <div>
                  <label> Address</label>
                  <input type="text" name="employer-address" class="form-control">
                </div>
                <div>
                  <label> Phone</label>
                  <input type="text" name="phone" class="form-control">
                </div>
                <div>
                  <label>Website</label>
                  <input type="text" name="website" class="form-control">
                </div>
                <div>
                  <label> Email</label>
                  <input type="email" name="employer-email" id="employer-email" class="form-control">
                </div>
                <div>
                  <label> Password</label>
                  <input type="password" name="employer-password" id="employer-password" class="form-control">
                </div>
                <div>
                  <label> Confirm Password</label>
                  <input type="password" name="employer-confirm-password" id="confirm-password" class="form-control">
                </div>
                <div class="py-5">
                  <input type="submit" name="employer-register-btn" class="btn btn-success form-control" value="Register">
                </div>
              </form>
            </div>
            <div id="error-msg"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <header class="container-fluid">
    <div class="row text-center">
      <div class="col-6 left">
        <!-- <img src="images/jobseeker.jpg" alt="job-seeker"> -->
        <div class="jumbotron jumbotron-red py-5">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              I'm a candidate
              <h3> LOOKING FOR </h3>
              <h3> A JOB</h3> From resume building to searching job we set you up
              <br />
              <br />
              <a href= 'beforeSearch.html' class="btn btn-red ">Search Jobs</a>
            </div>
            <div class="col-md-3"></div>
          </div>
        </div>
      </div>
      <div class="col-6 right">
        <!-- <img src="images/employer.jpg" alt="employer"> -->
        <div class="jumbotron jumbotron-blue py-5">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              I'm a employer
              <h3>    MANAGING </h3>
              <h3> AN OFFICE</h3> Range of products to help you manage your workplace
              <br />
              <br />
              <button data-toggle="modal" data-target="#myModal" class="btn btn-blue"> Recruit </button>
            </div>
            <div class="col-md-3"></div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="container">
    <section class="text-center py-5">
      <h1>
                            <i class="fas fa-briefcase"></i>    
                        </h1>
      <h3>We are helping to raise the bar for workforce management</h3>
      <h5>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <p class="text-secondary">
                                        We believe that when the right people come togehter creativity thrives, oppourtunities appear and business grows.                           
                                    </p>
                                    <p class="text-secondary">
                                        More&raquo;
                                    </p>

                                </div>
                                <div class="col-md-3"></div>
                            </div> 
                        </h5>
    </section>
    <section class="container banner text-center">
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
          <div class="jumbotron jumbotron-red text-left">
            <h1><strong>We know People</strong></h1>
            <h5>
                            Positive attitude can transform as an organization and it all start with the right people.
                        </h5>
            <br />
            <button class="btn btn-red">Learn More</button>
          </div>
        </div>
        <div class="col-2"></div>
      </div>
    </section>
    <section class="services text-center">
      <div class="py-4 container">
        <h5 class="text-secondary">Services</h5>
        <h4>
                                    <strong>MANAGE YOUR WORKFORCE</strong>
                                </h4>
      </div>
      <div class="row  py-3">
        <div class="col-md-4 py-5 color-default">
          <h1>
                                            <i class="fas fa-building"></i> 
                                        </h1>
          <h4>Professinal Staffing</h4>
          <p class="px-4">
            Lorem ipsum dolor sit amet, elit, sed do eiusmod tempor ut labore et dolore magna aliqua.
          </p>
          <small>More&raquo;</small>
        </div>
        <div class="col-md-4 py-5 color-default">
          <h1>
                                            <i class="fas fa-industry"></i> 
                                        </h1>
          <h4>Light Industrial Staffing</h4>
          <p class="px-4">
            Lorem ipsum dolor sit amet, elit, sed do eiusmod tempor ut labore et dolore magna aliqua.
          </p>
          <small>More&raquo;</small>
        </div>
        <div class="col-md-4 py-5 color-default">
          <h2>
                                            <i class="fas fa-search"></i>   
                                        </h2>
          <h4>Easy Search</h4>
          <p class="px-4">
            Lorem ipsum dolor sit amet, elit, sed do eiusmod tempor ut labore et dolore magna aliqua.
          </p>
          <small>More&raquo;</small>
        </div>
      </div>
    </section>
  </div>
  <section class="container-fluid">
    <div class="row py-5 text-center">
      <div class="col-6 py-5 text-white" style="background-color: red">
        <i>I'm ready to</i>
        <strong>
                        LOOK FOR A JOB  
                    </strong>
      </div>
      <div class="col-6 py-5 text-white " style="background-color: blue">
        <i>I'm ready to</i>
        <strong>
                        MANAGE WORKPLACE    
                    </strong>
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
  <script src="js/account.js"></script>
  <script>
  $('#choose-jobseeker').click(function() {
    $('#reg-employer-form').hide();

    $('#reg-jobseeker-form').show();


  });

  $('#choose-employer').click(function() {
    $('#reg-jobseeker-form').hide();
    $('#reg-employer-form').show();

  });

  
  </script>
</body>

</html>