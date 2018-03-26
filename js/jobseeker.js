/*
 * After login js scripts
 *
 */

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
  $('#appliedJobDetail').hide();
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

$('#personal-btn').click(function() {
  $('#education').hide();
  $('#experience').hide();
  $('#personal').toggle();
});
$('#education-btn').click(function() {

  $('#experience').hide();
  $('#personal').hide();
  $('#education').toggle();
});
$('#experience-btn').click(function() {
  $('#education').hide();
  $('#personal').hide();
  $('#experience').toggle();
});

$("input[name='search']").on('click', function(e) {
  e.preventDefault();
  // console.log($('input[name="job-title"],input[name="location"],input[name="industry"]').val());
  if (($('input[name="job-title"]').val() == "" || $('input[name="job-title"]').val() == null) &&
    ($('input[name="location"]').val() == "" || $('input[name="location"]').val() == null) &&
    ($('input[name="industry"]').val() == "" || $('input[name="industry"]').val() == null)
  ) {
    $('#error-msg h3').html('You need to fill the fields to begin Search');
  } else {
    var searchData = $('#searchJobs form').serializeArray();
    sendAjax('search.php', searchData, 'post', function(data) {
      var array = JSON.parse(data);
      $('#search-result').show();
      $("#result").html("");
      $.each(array, function(index, value) {
        var row = "<div class='row container py-3'>" +
          "<div class='col-8'>" +
          "<h5 class='text-muted'>" + value.job_title + "</h5>" +
          "<p class='lead'>" + value.company_name + "</p>" +
          "<small>" + value.created_date + "</small>" +
          "</div>" +
          "<div class='col-sm-4'>" +
          value.job_level + "<br />" +
          "<button class='btn btn-md btn-info px-2' data-id='" + value.vacancy_id + "'> View Detail</button>" +
          "</div>" +
          "</div>" +
          "<hr />";
        $('#result').append(row);
      });



    });

  }
});

$("#add-edu").click(function() {
  $('#edu-show').hide();
  $('#edu-add').show();
});

$('#edu-add button').click(function() {
  $('#edu-add').hide();
  $('#edu-show').show();
});

$("input[name='edu-add-submit']").click(function() {


  var data = [];
  var valid = false;

  $('#edu-add form').find('input[type="text"]').each(function() {
    if ($(this).val() == "" || $(this).val() == null) {
      $(this).css("border", "1px solid red");
      // valid = true;
    } else {
      $(this).css("border", "");
      data.push({
        [$(this).attr('name')]: $(this).val()
      });
      valid = true;
    }
    console.log(valid);
  });
  if (valid) {
    var data = $('#edu-add form').serializeArray();
    sendAjax('eduAdd.php', data, 'post', function(response) {
      alert('Education Details are added to your Profile ');
      $('#edu-add').hide();
      $('#edu-show').show();

      var data = JSON.parse(response);
      $('#showTable').empty();
      //console.log(data);
      $.each(data, function(index, value) {
        var row = "<tr>" +
          "<td>" + value.level + "</td>" +
          "<td>" + value.passed_year + "</td>" +
          "<td>" + value.institute + "</td>" +
          "<td>" + value.score + "</td>" +
          "<td>" + value.major + "</td>" +
          "<td>" + value.board + "</td>" +
          "<td>" +
          "<button class='btn btn-md btn-success'" +
          "data-id='" + value.edu_detail_id + "'" +
          "data-level='" + value.level + "'" +
          "data-passed-year='" + value.passed_year + "'" +
          "data-institute='" + value.institute + "'" +
          "data-score='" + value.score + "'" +
          "data-major='" + value.major + "'" +
          "data-board='" + value.board + "'" +
          "> Edit </button>" +
          " <button class='btn btn-md btn-danger' data-id='" + value.edu_detail_id + "'> Delete </button>" +
          "</td>" +
          "</tr>";
        $('#showTable').append(row);
      });
    });
  }
});


$(document).on('click', '#showTable .btn-danger', function() {
  var id = $(this).data(id);
  var profile = $(this).data(profile);
  var data = {
    'id': id.id,
    'profile': profile.profile

  };

  sendAjax('eduDel.php', data, 'post', function(response) {
    alert('Deleted');
    var data = JSON.parse(response);
    $('#showTable').empty();
    //console.log(data);
    $.each(data, function(index, value) {
      var row = "<tr>" +
        "<td>" + value.level + "</td>" +
        "<td>" + value.passed_year + "</td>" +
        "<td>" + value.institute + "</td>" +
        "<td>" + value.score + "</td>" +
        "<td>" + value.major + "</td>" +
        "<td>" + value.board + "</td>" +
        "<td>" +
        "<button class='btn btn-md btn-success'" +
        "data-id='" + value.edu_detail_id + "'" +
        "data-level='" + value.level + "'" +
        "data-passed-year='" + value.passed_year + "'" +
        "data-institute='" + value.institute + "'" +
        "data-score='" + value.score + "'" +
        "data-major='" + value.major + "'" +
        "data-board='" + value.board + "'" +
        "> Edit </button>" +
        " <button class='btn btn-md btn-danger' data-id='" + value.edu_detail_id + "' data-profile='" + value.profile_id + "'> Delete </button>" +
        "</td>" +
        "</tr>";
      $('#showTable').append(row);
    });


  });
});

$(document).on('click', '#showTable .btn-success', function() {
  $('#edu-show').hide();
  $('#edu-update').show();
  var id = $(this).attr("data-id");
  var level = $(this).attr("data-level");
  var passedYear = $(this).attr('data-passed-year');
  var institute = $(this).attr('data-institute');
  var score = $(this).attr('data-score');
  var major = $(this).attr('data-major');
  var board = $(this).attr('data-board');
  console.log(id, level);
  $('input[name="edu-id"]').val(id);
  $('input[name="level"]').val(level);
  $('input[name="passed-year"]').val(passedYear);
  $('input[name="institute"]').val(institute);
  $('input[name="score"]').val(score);
  $('input[name="major"]').val(major);
  $('input[name="board"]').val(board);
});

$('#edu-update .btn-info').click(function() {
  $('#edu-update').hide();
  $('#edu-show').show();
});

$('input[name="edu-update-submit"]').click(function() {
  data = $('#edu-update form').serializeArray();
  console.log(data);
  sendAjax('eduUpdate.php', data, 'post', function(response) {
    alert('Education Details are added to your Profile ');
    $('#edu-update').hide();
    $('#edu-show').show();

    var data = JSON.parse(response);
    $('#showTable').empty();
    //console.log(data);
    $.each(data, function(index, value) {
      var row = "<tr>" +
        "<td>" + value.level + "</td>" +
        "<td>" + value.passed_year + "</td>" +
        "<td>" + value.institute + "</td>" +
        "<td>" + value.score + "</td>" +
        "<td>" + value.major + "</td>" +
        "<td>" + value.board + "</td>" +
        "<td>" +
        "<button class='btn btn-md btn-success'" +
        "data-id='" + value.edu_detail_id + "'" +
        "data-level='" + value.level + "'" +
        "data-passed-year='" + value.passed_year + "'" +
        "data-institute='" + value.institute + "'" +
        "data-score='" + value.score + "'" +
        "data-major='" + value.major + "'" +
        "data-board='" + value.board + "'" +
        "> Edit </button>" +
        " <button class='btn btn-md btn-danger' data-id='" + value.edu_detail_id + "'> Delete </button>" +
        "</td>" +
        "</tr>";
      $('#showTable').append(row);
    });
  });
});

$('#exp-show button').click(function() {
  $('#exp-show').hide();
  $('#exp-add').show();
});

$('#exp-add button').click(function() {
  $('#exp-add').hide();
  $('#exp-show').show();
});

$('#exp-update button').click(function() {
  $('#exp-update').hide();
  $('#exp-show').show();
});

$('input[name="exp-add-submit"').click(function() {
  var data = [];
  var valid = false;

  $('#exp-add form').find('input[type="text"],input[type="date"]').each(function() {
    if ($(this).val() == "" || $(this).val() == null) {
      $(this).css("border", "1px solid red");
      // valid = true;
    } else {
      $(this).css("border", "");
      data.push({
        [$(this).attr('name')]: $(this).val()
      });
      valid = true;
    }
    console.log(valid);
  });
  if (valid) {
    var data = $('#exp-add form').serializeArray();
    sendAjax('expAdd.php', data, 'post', function(response) {
      alert("Experience Data Inserted");
      $('#exp-add').hide();
      $('#exp-show').show();
      var data = JSON.parse(response);
      $('#table').empty();
      $.each(data, function(index, value) {
        var row = "<tr>" +
          "<td>" + value.start_date + "</td>" +
          "<td>" + value.end_date + "</td>" +
          "<td>" + value.company_name + "</td>" +
          "<td>" + value.job_title + "</td>" +
          "<td>" +
          "<button class='btn btn-md btn-success'" +
          "data-id='" + value.exp_detail_id + "'" +
          "data-start-date='" + value.start_date + "'" +
          "data-end-date='" + value.end_date + "'" +
          "data-company-name='" + value.company_name + "'" +
          "data-job-title='" + value.job_title + "'" +

          "> Edit </button>" +
          " <button class='btn btn-md btn-danger' data-id='" + value.exp_detail_id + "' data-profile='" + value.profile_id + "'> Delete </button>" +
          "</td>" +
          "</tr>";
        $('#table').append(row);
      });

    });
  }
});

$(document).on('click', '#table .btn-success', function() {
  $('#exp-show').hide();
  $('#exp-add').hide();
  $('#exp-update').show();
  var id = $(this).attr("data-id");
  var profile = $(this).attr("data-profile");
  var startDate = $(this).attr("data-start-date");
  var endDate = $(this).attr("data-end-date");
  var companyName = $(this).attr("data-company-name");
  var jobTitle = $(this).attr("data-job-title");
  console.log();

  $('#exp-update form input[name="id"]').val(id);
  $('#exp-update form input[name="profile-id"]').val(profile);
  $('#exp-update form input[name="start-date"]').val(startDate);
  $('#exp-update form input[name="end-date"]').val(endDate);
  $('#exp-update form input[name="company-name"]').val(companyName);
  $('#exp-update form input[name="job-title"]').val(jobTitle);

});

$(document).on('click', '#table .btn-danger', function() {

  var id = $(this).attr("data-id");
  var profile = $(this).attr("data-profile");

  var data = {
    "id": id,
    "profile": profile
  };

  sendAjax('expDel.php', data, 'post', function(response) {
    alert("Experience Data Inserted");
    $('#exp-add').hide();
    $('#exp-show').show();
    var data = JSON.parse(response);
    $('#table').empty();
    $.each(data, function(index, value) {
      var row = "<tr>" +
        "<td>" + value.start_date + "</td>" +
        "<td>" + value.end_date + "</td>" +
        "<td>" + value.company_name + "</td>" +
        "<td>" + value.job_title + "</td>" +
        "<td>" +
        "<button class='btn btn-md btn-success'" +
        "data-id='" + value.exp_detail_id + "'" +
        "data-start-date='" + value.start_date + "'" +
        "data-end-date='" + value.end_date + "'" +
        "data-company-name='" + value.company_name + "'" +
        "data-job-title='" + value.job_title + "'" +

        "> Edit </button>" +
        " <button class='btn btn-md btn-danger' data-id='" + value.exp_detail_id + "' data-profile='" + value.profile_id + "'> Delete </button>" +
        "</td>" +
        "</tr>";
      $('#table').append(row);
    });
  });

});

$('input[name="exp-update-submit"]').click(function() {
  var data = $('#exp-update form').serializeArray();
  sendAjax('expUpdate.php', data, 'post', function(response) {
    alert("Experience Data Updated");
    $('#exp-update').hide();
    $('#exp-show').show();
    var data = JSON.parse(response);
    $('#table').empty();
    $.each(data, function(index, value) {
      var row = "<tr>" +
        "<td>" + value.start_date + "</td>" +
        "<td>" + value.end_date + "</td>" +
        "<td>" + value.company_name + "</td>" +
        "<td>" + value.job_title + "</td>" +
        "<td>" +
        "<button class='btn btn-md btn-success'" +
        "data-id='" + value.exp_detail_id + "'" +
        "data-profile='" + value.profile_id + "'" +
        "data-start-date='" + value.start_date + "'" +
        "data-end-date='" + value.end_date + "'" +
        "data-company-name='" + value.company_name + "'" +
        "data-job-title='" + value.job_title + "'" +

        "> Edit </button>" +
        " <button class='btn btn-md btn-danger' data-id='" + value.exp_detail_id + "' data-profile='" + value.profile_id + "'> Delete </button>" +
        "</td>" +
        "</tr>";
      $('#table').append(row);
    });
  });

});

$('#interested .btn-primary').click(function() {
  $('#interested .btn-primary+div').toggle();
});

$('#interested form button').click(function(e) {
  e.preventDefault();


  $('#interested .btn-primary+div').show();


  var data = [];
  var valid = false;

  $('#interested form').find('select').each(function() {
    if ($(this).val() == "" || $(this).val() == null) {
      $(this).css("border", "1px solid red");
      // valid = true;
    } else {
      $(this).css("border", "");
      data.push({
        [$(this).attr('name')]: $(this).val()
      });
      valid = true;
    }
    console.log(valid);
  });
  if (valid) {
    data = $('#interested form').serializeArray();
    //console.log(data);
    sendAjax('jobCategory.php', data, 'post', function(response) {
      var list = JSON.parse(response);
      $('#showInterested').empty();
      $.each(list, function(index, value) {
        var row = "<tr>" +
          "<td>" + value.job_category + "</td>" +
          "<td>" +
          "<button class='btn btn-sm btn-danger' data-id='" + value.category_id + "' data-profile='" + value.profile_id + "'>-</button>" +
          "</td>" +
          "</tr>";
        $('#showInterested').append(row);

      });
    });
  }

});

$(document).on('click', '#showInterested .btn-danger', function() {
  var id = $(this).attr('data-id');
  var profile = $(this).attr('data-profile');

  var data = {
    'id': id,
    'profile': profile
  };

  sendAjax('delInterestedCategory.php', data, 'post', function(response) {

    var list = JSON.parse(response);
    $('#showInterested').empty();
    $.each(list, function(index, value) {
      var row = "<tr>" +
        "<td>" + value.job_category + "</td>" +
        "<td>" +
        "<button class='btn btn-sm btn-danger' data-id='" + value.category_id + "' data-profile='" + value.profile_id + "'>-</button>" +
        "</td>" +
        "</tr>";
      $('#showInterested').append(row);

    });

  });

});

$(document).on('click','#vacancyList .btn-info',function(){
  $('#vacancy').show();
  $('#jobsForYou').hide();
  var vid = $(this).attr('data-vacancy-id');
  var cid = $(this).attr('data-company-id');
  var pid = $(this).attr('data-profile');
  console.log(vid,cid);
  data = {
    'cid':cid,
    'vid':vid,
    'pid':pid
  };

  sendAjax('vacancy.php',data,'post',function(response){
    var data = JSON.parse(response);
    $('#vacancy').empty();
    $.each(data,function(index,value){
      var row = "<button class='btn btn-md btn-info float-right mx-2'>&laquo; Back</button>"+
                "<button class='btn btn-md btn-success float-right '"+
                  " data-id='"+value.vacancy_id+"' data-profile='"+pid+"'>"+
                  "<i class='fa fa-upload'></i>Apply"+
                "</button> "+
                "<button class='btn btn-md btn-primary float-right '"+
                  " data-id='"+value.vacancy_id+"' data-profile='"+pid+"'>"+
                  "<i class='fa fa-check'></i>Applied"+
                "</button> "+              
                
                "<h2>"+value.company_name+"</h2>"+
                "<h5 class='text-muted py-3'>INDUSTRY :"+value.industry+"</h5>"+
                "<p class='lead'>"+value.description+"</p>"+
                "<div class='alert alert-info py-3 my-3'>"+
                  "<h4>"+value.job_title+"</h4><hr />"+
                  "<h5 class='my-3'>Basic Information</h5>"+
                  "<table class='table'>"+
                    "<tr>"+
                      "<th>Job Category</th>"+
                      "<td>"+value.job_category+"</td>"+
                    "</tr>"+ 
                    "<tr>"+
                      "<th>Job Level</th>"+
                      "<td>"+value.job_level+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<th>No. of vacancy/s</th>"+
                      "<td>"+value.no_of_openings+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<th>Employement Type</th>"+
                      "<td>"+value.job_availablity+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<th>Job Location</th>"+
                      "<td>"+value.address+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<th>Salary</th>"+
                      "<td>"+value.salary+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<th>Deadline</th>"+
                      "<td>"+value.deadline+"</td>"+
                    "</tr>"+
                  "</table>"+
                  "<div class='my-3' py-3>"+
                    "<h5 class='my-3'>Job Specification</h5>"+
                    "<table class='table'>"+
                      "<tr>"+
                        "<th>Education</th>"+
                        "<td>"+value.education+"</td>"+
                      "</tr>"+  
                      "<tr>"+
                        "<th>Experience</th>"+
                        "<td>"+value.experience+"</td>"+
                      "</tr>"+
                    "</table>"+
                  "</div><hr />"+
                  "<div class='py-3 my-3'"+
                    "<h5 class='my-3'>Job Description</h5>"+
                    "<p>"+value.job_description+"</p>"+
                  "</div>"+
                "</div>"+
                "<button class='btn btn-md btn-success'"+
                  " data-id='"+value.vacancy_id+"' data-profile='"+pid+"'>"+
                  "<i class='fa fa-upload'></i>Apply"+
                "</button>"+
                "<button class='btn btn-md btn-primary'"+
                  " data-id='"+value.vacancy_id+"' data-profile='"+pid+"'>"+
                  "<i class='fa fa-check'></i>Applied"+
                "</button>";  
      $('#vacancy').append(row);              
    });
  });
  sendAjax('checkJobsApplied.php',data,'post',function(response){
    var data = JSON.parse(response);
    $.each(data,function(index,value){
      if(value.vacancy_id == vid){
        $('#vacancy .btn-success').hide();
        $('#vacancy .btn-primary').show();
        
      }
    });
  });

});

$(document).on('click','#vacancy .btn-info',function(){
  $('#jobsForYou').show();
  $('#vacancy').hide();
});

$(document).on('click','#vacancy .btn-success',function(){
  $('#vacancy .btn-success').hide();
  $('#vacancy .btn-primary').show();
  var vid = $('#vacancy .btn-success').attr('data-id');
  var pid = $('#vacancy .btn-success').attr('data-profile');
  data= {
    'id':vid,
    'pid':pid
  };
  sendAjax('applyVacancy.php',data,'post',function(response){
      // alert('Job Applied');
      // window.location = "jobseeker-page.php";
  });
  
});

$(document).on('click','#appliedJobs .btn-info',function(){
  $('#appliedJobDetail').show();
  $('#appliedJobs').hide();
  var vid = $(this).attr('data-vacancy-id');
  var cid = $(this).attr('data-company-id');
  var pid = $(this).attr('data-profile');
  data = {
    'vid':vid,
    'pid':pid,
    'cid':cid
  };
  sendAjax('vacancy.php',data,'post',function(response){
    var data = JSON.parse(response);
    $('#appliedJobDetail').empty();
    $.each(data,function(index,value){
      var row = "<button class='btn btn-md btn-info float-right mx-2'>&laquo; Back</button>"+
                
                "<button class='btn btn-md btn-primary float-right '"+
                  " data-id='"+value.vacancy_id+"' data-profile='"+pid+"'>"+
                  "<i class='fa fa-check'></i>Applied"+
                "</button> "+              
                
                "<h2>"+value.company_name+"</h2>"+
                "<h5 class='text-muted py-3'>INDUSTRY :"+value.industry+"</h5>"+
                "<p class='lead'>"+value.description+"</p>"+
                "<div class='alert alert-info py-3 my-3'>"+
                  "<h4>"+value.job_title+"</h4><hr />"+
                  "<h5 class='my-3'>Basic Information</h5>"+
                  "<table class='table'>"+
                    "<tr>"+
                      "<th>Job Category</th>"+
                      "<td>"+value.job_category+"</td>"+
                    "</tr>"+ 
                    "<tr>"+
                      "<th>Job Level</th>"+
                      "<td>"+value.job_level+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<th>No. of vacancy/s</th>"+
                      "<td>"+value.no_of_openings+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<th>Employement Type</th>"+
                      "<td>"+value.job_availablity+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<th>Job Location</th>"+
                      "<td>"+value.address+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<th>Salary</th>"+
                      "<td>"+value.salary+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<th>Deadline</th>"+
                      "<td>"+value.deadline+"</td>"+
                    "</tr>"+
                  "</table>"+
                  "<div class='my-3' py-3>"+
                    "<h5 class='my-3'>Job Specification</h5>"+
                    "<table class='table'>"+
                      "<tr>"+
                        "<th>Education</th>"+
                        "<td>"+value.education+"</td>"+
                      "</tr>"+  
                      "<tr>"+
                        "<th>Experience</th>"+
                        "<td>"+value.experience+"</td>"+
                      "</tr>"+
                    "</table>"+
                  "</div><hr />"+
                  "<div class='py-3 my-3'"+
                    "<h5 class='my-3'>Job Description</h5>"+
                    "<p>"+value.job_description+"</p>"+
                  "</div>"+
                "</div>"+
                "<button class='btn btn-md btn-primary'"+
                  " data-id='"+value.vacancy_id+"' data-profile='"+pid+"'>"+
                  "<i class='fa fa-check'></i>Applied"+
                "</button>";  
      $('#appliedJobDetail').append(row);              
    });
  });

});

$(document).on('click','#appliedJobDetail .btn-info',function(){
  $('#appliedJobDetail').hide();
  $('#appliedJobs').show();
});