$("input[name='employer-confirm-password']").on("keyup", function() {
  var pw = $("input[name='employer-password']").val();
  var confirm_pw = $("input[name='employer-confirm-password']").val();

  if (pw != confirm_pw) {
    $("input[name='employer-register-btn']").prop("disabled", true);
  } else {
    $("input[name='employer-register-btn']").prop("disabled", false);
  }
});

$("input[name='jobseeker-confirm-password']").on("keyup", function() {
  var pw = $("input[name='jobseeker-password']").val();
  var confirm_pw = $("input[name='jobseeker-confirm-password']").val();

  if (pw != confirm_pw) {
    $("input[name='jobseeker-register-btn']").prop("disabled", true);
  } else {
    $("input[name='jobseeker-register-btn']").prop("disabled", false);
  }
});

$("input[name='employer-register-btn']").click(function(e) {
  e.preventDefault();

  var data = [];
  var valid = false;

  $('#reg-employer-form form').find('input[type=text],input[type=email],input[type=password],input[type=date],input[type=radio], textarea').each(function() {
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
  if (valid){
    var a = $('#reg-employer-form form').serializeArray();
    registerEmployer(a);
  }

});

$("input[name='jobseeker-register-btn']").click(function(e) {
  e.preventDefault();

  var data = [];
  var valid = false;

  $('#reg-jobseeker-form form').find('input[type=text],input[type=email],input[type=password],input[type=date],input[type=radio], textarea').each(function() {
    if ($(this).val() == "" || $(this).val() == null) {
      $(this).css("border", "1px solid red");
      //valid = false;
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
    var a = $('#reg-jobseeker-form form').serializeArray();
    registerJobseeker(a);
  }

});

function registerJobseeker(data) {
  $.ajax({
    url: "registerJobseeker.php",
    data: data,
    type: 'POST',
    beforeSend: function() {

    },

    success: function(data) {
      alert(data)
    },

    error: function() {
      alert('Registration Error');
    }
  });

};

function registerEmployer(data) {
  $.ajax({
    url: "registerEmployer.php",
    data: data,
    type: 'POST',
    beforeSend: function() {

    },

    success: function(data) {
      alert(data)
    },

    error: function() {
      alert('Registration Error');
    }
  });

};

$('#login-submit').click(function(e) {
  e.preventDefault();
  var data = [];
  var valid = false;
  
  $('#login-form').find('input[type=text],input[type=password]').each(function() {
    if ($(this).val() == "" || $(this).val() == null) {
      $(this).css("border", "1px solid red");
      console.log(valid);
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
    var a = $('#login-form').serializeArray();
    $.ajax({
      url: 'login.php',
      type: 'post',
      data: a,
      success: function(data) {
        if (data == false) {
          alert("Provided credentials do not match");
        }else{
          if(data == 1)
            window.location = "jobseeker-page.php" ;
          else 
            window.location = "employer-page.php";
          

        }

      },
      error: function(data) {
        alert(data);
      }
    });
  }

});

$('#jobseeker-email,#employer-email').on('keyup',function(){
    var email = $(this).serializeArray();
    
    
     $.ajax({
        url:'emailCheck.php',
        data: email,
        type:'post',
        success:function(data){
          //alert(data);
          if(data == 1 ){

            $('#error-msg').html('Email has been already taken choose another email');
            $('input[name="jobseeker-register-btn"], input[name="employer-register-btn"]')
            .prop('disabled',true);
            $(this).css("border", "1px solid red");
          }
          else{
            $('#error-msg').html('');
            $('input[name="jobseeker-register-btn"], input[name="employer-register-btn"]')
            .prop('disabled',false);

          }
        },
        error:function(){}
     });
});




