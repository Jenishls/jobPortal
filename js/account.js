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

    $('#reg-employer-form form').find('input, textarea').each(function() {
        if ($(this).val() == "" || $(this).val() == null) {
            $(this).css("border", "1px solid red");
            valid = true;
        } else {
            $(this).css("border", "");
            data.push({
                [$(this).attr('name')]: $(this).val() });
            valid = true;
        }
    });
    if (valid)
        register(data);

});

$("input[name='jobseeker-register-btn']").click(function(e) {
    e.preventDefault();

    var data = [];
    var valid = false;

    $('#reg-jobseeker-form form').find('input, textarea').each(function() {
        if ($(this).val() == "" || $(this).val() == null) {
            $(this).css("border", "1px solid red");
            valid = true;
        } else {
            $(this).css("border", "");
            data.push({
                [$(this).attr('name')]: $(this).val() });
            valid = true;
        }
    });
    if (valid)
        register(data);

});

function register(data) {
    $.ajax({
        url: "#",
        data: data,
        method: 'POST'
    });

};