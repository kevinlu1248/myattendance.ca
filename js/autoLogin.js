$(document).ready(function() {
    setTimeout(function () {
        Fingerprint2.get(function (components) {
            var values = components.map(function (component) { return component.value });
            var murmur = Fingerprint2.x64hash128(values.join(''), 31);
            $.ajax({
                method: "POST",
                url: "/myattendance.ca/library/formActions/autoLogin.php",
                data: {fingerprint: murmur},
                // error: function(err) {console.log(err)}
            })
            .done(function(result) {
                console.log(result);
                if (result) {
                    if (result == "1") {
                        location.reload();
                    }
                }
            })
        })
    }, 200);
});
