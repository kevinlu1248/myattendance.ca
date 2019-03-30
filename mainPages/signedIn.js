$(document).ready(function() {
    // for personal data changes
    $("#personalDataChange div input").focus(function() {
        $("#submitPersonalDataChange").prop("disabled", false);
    });


    $("#changePassword div input").keyup(function() {
        var isValid = true;
        $("#changePassword div input").each(function() {
            if ($(this).val().length == 0) {
                isValid = false;
            }
        });

        if (isValid) {
            $("#invalidity").attr("hidden", true);
        } else {
            $("#invalidity").attr("hidden", false);
        }

        if ($("#npwd").val() == $("#rpwd").val()) {
            $("#samePassword").attr("hidden", true);
        } else {
            $("#samePassword").attr("hidden", false);
        }

        if (isValid && ($("#npwd").val() == $("#rpwd").val())) {
            $("#submitPasswordChange").prop("disabled", false);
        } else {
            $("#submitPasswordChange").prop("disabled", true);
        };
    });
});
