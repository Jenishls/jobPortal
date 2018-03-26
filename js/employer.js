$('#btn-postVacancies').click(function() {

  $('#listVacancies').hide();
  $('#editProfile').hide();
  $('#listCandidates').hide();
  $('#postVacancies').show();
});

$('#btn-listVacancies').click(function() {
  $('#postVacancies').hide();
  $('#editProfile').hide();
  $('#listCandidates').hide();
  $('#listVacancies').show();
});

$('#btn-editProfile').click(function() {
  $('#postVacancies').hide();
  $('#listVacancies').hide();
  $('#listCandidates').hide();
  $('#editProfile').show();

});

$('#post-vacancy').on('click', function(e) {
  e.preventDefault();
  var data = [];
  var valid = false;

  $('#postVacancies form').find('input[type="text"],input[type="date"],input[type="number"],input[type="radio"], textarea,select').each(function() {
    var a;
    if ($(this).val() == "" || $(this).val() == null) {
      $(this).css("border", "2px solid red ");
    } else {
      if ($(this))
        $(this).css("border", "");
      data.push({
        [$(this).attr('name')]: $(this).val()
      });
      valid = true;
    }
  });
  if (valid) {
    var a = $('#postVacancies form').serializeArray();
    console.log(a);
    postVacancy(a);
  }
});


$('#full').on('click', function() {
  $('#full').attr("value", "full time");

});

$('#part').on('click', function() {
  $('#part').attr("value", "part time");

});

function postVacancy(data) {
  $.ajax({
    url: "postVacancy.php",
    data: data,
    method: 'POST',

    success: function(data) {
      alert(data);
    },

    error: function() {;
    }
  });

}

$('a[data-vacancy-id]').click(function(e) {
  e.preventDefault();
  var vacancy_id = $(this).data("vacancy-id");

  //console.log($('#listCandidates tbody'));
  array = { "vacancy-id": vacancy_id };

  $('#postVacancies').hide();
  $('#listVacancies').hide();
  $('#editProfile').hide();
  $('#listCandidates').show();


  sendAjax('listCandidates.php', array, 'post', function(response) {
    var list = JSON.parse(response);
    //console.log(list);
    if (list.length == 0) {
      $('#list-error-msg').show();
      $('#list-error-msg h5').text("No data found");
    } else {
      $('#listCandidates table tbody').empty();
      $.each(list, function(index, value) {
        var row = "<tr>" +
          "<td>" + value.fname + value.mname + value.lname + "</td>" +
          "<td>" + value.email + "</td>" +
          "<td>" + value.phone + "</td>" +
          "<td>" + value.address + "</td>" +
          "<td>" +
          "<button class='btn btn-sm btn-success'" +
          " data-profile='" + value.profile_id + "'" +
          " data-id='" + value.user_id + "'>" +
          "View</button>"
        "</tr>";
        $('#listCandidates table tbody').append(row);
      });

    }
  });

});

$(document).on('click', '#listCandidates .btn-success', function() {
  var pid = $(this).attr('data-profile');
  var uid = $(this).attr('data-id');
  data = {
    'pid': pid,
    'uid': uid
  };
  $('#listCandidates').hide();
  $('#candidateProfile').show();

  sendAjax('candidateProfile.php', data, 'post', function(response) {
    var list = JSON.parse(response);
    console.log(list);

    $('#candidatePersonal').empty();
    $('#candidateEducation').empty();
    $('#candidateExperience').empty();
    $.each(list[0], function(index, value) {

      var profile = "<tr>" +
        "<th>Name : </th>" +
        "<td>" + value.fname + value.mname + value.lname + "</td>" +
        "</tr>" +
        "<tr>" +
        "<th>Date of birth : </th>" +
        "<td>" + value.dob + "</td>" +
        "</tr>" +
        "<tr>" +
        "<th>Gender : </th>" +
        "<td>" + value.gender + "</td>" +
        "</tr>" +
        "<tr>" +
        "<th>Address : </th>" +
        "<td>" + value.address + "</td>" +
        "</tr>" +
        "<tr>" +
        "<th>Phone : </th>" +
        "<td>" + value.phone + "</td>" +
        "</tr>";
      $('#candidatePersonal').append(profile);

    });

    $.each(list[1], function(index, value) {
      console.log(value.level);
      var edu = "<tr>" +
        "<td>" + value.level + "</td>" +
        "<td>" + value.passed_year + "</td>" +
        "<td>" + value.institute + "</td>" +
        "<td>" + value.score + "</td>" +
        "<td>" + value.major + "</td>" +
        "<td>" + value.board + "</td>" +
        "</tr>";
      $('#candidateEducation').append(edu);

    });

    $.each(list[2], function(index, value) {
      var exp = "<tr>" +
        "<td>" + value.start_date + "</td>" +
        "<td>" + value.end_date + "</td>" +
        "<td>" + value.company_name + "</td>" +
        "<td>" + value.job_title + "</td>" +
        "</tr>";
      $('#candidateExperience').append(exp);
    });


  });
});

$('#candidate-back').click(function() {
  $('#listCandidates').hide();
  $('#listVacancies').show();
});

$('#general button').click(function() {
  $('#general').hide();
  $('#editForm').show();
  $('#general-btn button').show();

});

$('#editForm .btn-info').click(function() {
  $('#editForm').hide();
  $('#general').show();
});

$('#general-btn').click(function() {
  $('#general').toggle();
  $('#editForm').hide();

});

$('#login-btn').click(function() {
  $('#login').toggle();
  $('#general').hide();
});

$("input[name='employer-confirm-password']").on("keyup", function() {
  var pw = $("input[name='employer-password']").val();
  var confirm_pw = $("input[name='employer-confirm-password']").val();

  if (pw != confirm_pw) {
    $('#login-error-msg').css('display', 'block');
    $('#login-error-msg').html('New Password and Confirm Password mismatch!');
    $('#login input[type="submit"]').prop("disabled", true);
  } else {
    $('#login input[type="submit"]').prop("disabled", false);
    $('#login-error-msg').hide();
  }
});

$('#employer-email').on('keyup', function() {
  var email = $(this).serializeArray();

  $.ajax({
    url: 'emailCheck.php',
    data: email,
    method: 'post',
    success: function(data) {
      //alert(data);
      if (data == 1) {
        $('#login-error-msg').css('display', 'block');
        $('#login-error-msg').html('Email has been already taken choose another email');
        $('#login input[type="submit"]').prop('disabled', true);
        $(this).css("border", "1px solid red");
      } else {
        $('#login-error-msg').hide();
        $('#login input[type="submit"]').prop('disabled', false);

      }
    },
    error: function() {}
  });
});

$('#editForm input[name="employer-update-btn"]').click(function(e) {
  e.preventDefault();

  var a = $('#editForm form').serializeArray();
  console.log(a);
  sendAjax('updateEmployerGeneral.php', a, 'post', function(data) {
    alert('Profile Updated!');
    window.location = "employer-page.php";
  });

});

$('#login input[type="submit"]').click(function(e) {
  e.preventDefault();
  var a = $('#login form').serializeArray();
  sendAjax('updateEmployerLogin.php', a, 'post', function(data) {
    alert('Credentials Changed Sucessfully!');
    //window.location = "employer-page.php";
  });
});

$('#candidateProfile .btn-info').click(function() {
  $('#candidateProfile').hide();
  $('#listCandidates').show();
});

// $(document).on('input','input[name="deadline"]',function(){
//   var end = $(this).val();
//   var d = new Date();
//   var month = d.getMonth() + 1;
//   var date = d.getDate();
//   var year = d.getFullYear();
//   var start = year+'-'+month+"-"+date;
  
//   var days = (end - start) ;
//   console.log('end = '+typeof(end));
//   console.log('start = '+typeof(start));
//   console.log(end < start);
// });