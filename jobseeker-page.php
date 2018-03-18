<?php
    session_start();
    require_once('jobseeker.php');
    if(!isset($_SESSION['permission'])){
        header('location:index.html?msg=no-access');
    }
    $userId = $_SESSION['userId'];
    $user = $_SESSION['userType'];
    
    $jobseeker = new Jobseeker();
    // $jobseeker->setId($userId);
    // $applied = $jobseeker->appliedJobs();

    ?>
<!DOCTYPE html>
<html>

<head>
    <title>Online Job Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/resume.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <a class="navbar-brand" href="#" style="font-family: 'lobster'">Job Portal</a>
        <ul class="navbar-nav">
        </ul>
        <ul class="navbar-nav ml-auto mr-auto">
            <form class="form-inline ">
                <input type="text" name="" class="form-control" style="width: 500px" placeholder="Search for Jobs..">
                <input type="button" name="search" value="search" class=" btn btn-success">
            </form>
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
        <!-- <img src="images/jobseeker.jpg" alt="job-seeker"> -->
        <div class="text-white py-5">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <h1> WELCOME</h1>
                    <h2>NAME</h2>
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
                <div class="py-5" id="jobsForYou">
                    <i class="fa fa-list-alt"></i> JOBS FOR YOU
                    <hr>
                    <div class="row container">
                        <div class="col-8">
                            <h5>Job Title</h5>
                            <p class="lead">Company name</p>
                            <small> posted date</small>
                        </div>
                        <div class="col-sm-4">
                            Location
                        </div>
                    </div>
                    <hr />
                </div>
                
                <div class="py-5" id="appliedJobs">
                    <i class="fa fa-list-alt"></i>APPLIED JOBS
                    <hr>

                    foreach($)
                    <div class="row container">
                        <div class="col-8">
                            <h5>Job Title</h5>
                            <p class="lead">Company name</p>
                            <small> posted date</small>
                        </div>
                        <div class="col-4">
                            Location
                        </div>
                    </div>
                    <hr />

                </div>
                <div class="py-5" id="searchJobs">
                    <i class="fa fa-list-alt"></i> SEARCH JOBS
                    <hr>
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <label>
                                    <h4>Job Title</h4></label>
                                <input type="text" name="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>
                                    <h4>Location</h4></label>
                                <input type="text" name="" class="form-control">
                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col-md-6">
                                <label>
                                    <h4>Industry</h4></label>
                                <input type="text" name="" class="form-control">
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="ml-auto">
                                <input type="submit" name="" class="btn btn-lg btn-red" value="Begin Searching&raquo;">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="py-5" id="editProfile">
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
    <script>
    $('#btn-jobsForYou').click(function() {
        $('#resume').hide();
        $('#appliedJobs').hide();
        $('#searchJobs').hide();
        $('#editProfile').hide();
        $('#jobsForYou').show();
    });

    $('#btn-resume').click(function() {

        $('#appliedJobs').hide();
        $('#searchJobs').hide();
        $('#editProfile').hide();
        $('#jobsForYou').hide();
        $('#resume').show();
    });

    $('#btn-appliedJobs').click(function() {

        $('#searchJobs').hide();
        $('#editProfile').hide();
        $('#jobsForYou').hide();
        $('#resume').hide();
        $('#appliedJobs').show();
    });

    $('#btn-searchJobs').click(function() {

        $('#editProfile').hide();
        $('#jobsForYou').hide();
        $('#resume').hide();
        $('#appliedJobs').hide();
        $('#searchJobs').show();
    });

    $('#btn-editProfile').click(function() {

        $('#jobsForYou').hide();
        $('#resume').hide();
        $('#appliedJobs').hide();
        $('#searchJobs').hide();
        $('#editProfile').show();
    });
    </script>
</body>

</html>