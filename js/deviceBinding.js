$(document).ready(function() {

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        console.log("mobile");
    } else {
        console.log("not mobile");
        $("#binder").prop("disabled", true);
        $("#binderContainer").tooltip();

        var startQR = new Date();
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "http://jindo.dev.naver.com/collie",
            width: 350,
            height: 350,
            colorDark : "#000000",
            colorLight : "#ffffff",
        });
        console.log(new Date() - startQR);
        $("#qrSpinner").remove();
    }
})
