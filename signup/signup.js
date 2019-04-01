$(document).ready(function(){
    var submit = $("#submit");
    var murmur = "";

    var validStudentId = function() {
        var id = $('#studentId').val();
        if (id < 100000 || id > 99999999) {
            $('#validStudentId').show();
        } else {
            $('#validStudentId').hide();
        }
    }

    var checkEmail = function() {
        var email = $('#email').val();
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!(re.test(String(email).toLowerCase()))) {
            $('#validEmail').show();
        } else {
            $('#validEmail').hide();
        }
    }

    var checkPassword = function() {
        if ($('#pwd').val() == $('#rpwd').val()) {
            $('#samePassword').hide();
        } else {
            $('#samePassword').show();
        }
        var pwd = $('#pwd').val();
        //var validPassword = /^(?=.*[a-z])(?=.*[0-9])(?=.{7,})/;
        if (!(pwd.length <= 20 && pwd.length >= 8)) {
            $('#validPassword').show();
        } else {
            $('#validPassword').hide();
        }
    }

    var checkValidity = function() {
        $('#duplicate').hide();
        var first = $('#first').val();
        var last = $('#last').val();
        var studentId = $('#studentId').val();
        var email = $('#email').val();
        var pwd = $('#pwd').val();
        var rpwd = $('#rpwd').val();

        if (!(first && last && studentId && email && pwd && rpwd)) {
            $("#invalidity").show();
        } else {
            $("#invalidity").hide();
        }

        var formIsValid = $('#signup-holder .text-danger:visible').length == 0;
        if (formIsValid) {
            submit.prop("disabled", false);
        } else {
            submit.prop("disabled", true);
        }
    }

    $('#studentId').keyup(validStudentId);
    $("#email").keyup(checkEmail);
    $("#pwd").keyup(checkPassword);
    $("#rpwd").keyup(checkPassword);

    $('.form-group input').keyup(checkValidity);

    // $("#pwd", "Password must be at 6-20 characters long and include letters and numbers").tooltip();

    setTimeout(function () {
        Fingerprint2.get(function (components) {
            var values = components.map(function (component) { return component.value });
            murmur = Fingerprint2.x64hash128(values.join(''), 31);
            $("#fingerprint").val(murmur);
            console.log($("#fingerprint").val());

            // $("#submit").click(function() {
            //     var first = $('#first').val();
            //     var last = $('#last').val();
            //     var studentId = $('#studentId').val();
            //     var email = $('#email').val();
            //     var pwd = $('#pwd').val();
            //     var rpwd = $('#rpwd').val();

            //     var formIsValid = $('#signup-holder .text-danger:visible').length == 0;

            //     if (first && last && studentId && email && pwd && rpwd && formIsValid) {
            //         var data = {
            //             fingerprint: murmur,
            //             first: first,
            //             last: last,
            //             studentId: studentId,
            //             email: email,
            //             pwd: pwd
            //             // isTeacher: isTeacher;
            //         }

            //         $.ajax({
            //             method: "POST",
            //             url: "../library/formActions/signup.php",
            //             data: data,
            //         })

            //         .done(function(result) {
            //             console.log(result);
            //             if (result == "Duplicate Error") {
            //                 $('#duplicate').show();
            //             } else {
            //                 window.open("http://www.myattendance.ca?signup=1","_self");
            //             }
            //         });
            //     }
            // });
        });
    }, 200);


});
