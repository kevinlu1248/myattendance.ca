$(document).ready(function() {
    // $('#validStudentId').hide();
    // $('#validEmail').hide();
    // $('#validPassword').hide();
    // $('#samePassword').hide();
    // $('#invalidity').hide();

    // var pre = document.querySelector('pre');
    // var video = document.querySelector('video');
    // var myScript = document.querySelector('script');
    // var range = document.querySelector('input');
    // if (navigator.mediaDevices) {
    //     console.log('getUserMedia supported.');
    //     navigator.mediaDevices.getUserMedia({audio: true})
    //         .then(stream => {
    //             // $("#main").prepend("<div id='testCircle' style='height: 50px; width: 50px; background-color: red; border-radius: 50%'></div>");
    //             var mediaRecorder = new MediaRecorder(stream);
    //             var chunks = [];
    //             mediaRecorder.start(1);

    //             mediaRecorder.ondataavailable = function(e) {
    //                 var nblob = e.data;
    //                 chunks.push(nblob);
    //                 $("#testCircle").height(nblob.size);
    //                 console.log(nblob);
    //             }

    //             mediaRecorder.onstop = function(e) {
    //                 var blob = new Blob(chunks, { 'type' : 'audio/ogg; codecs=opus' });
    //                 chunks = [];
    //                 var audioURL = URL.createObjectURL(blob);
    //                 console.log(blob);
    //             };

    //             // setTimeout(() => {
    //             //     mediaRecorder.stop();
    //             //     }, 30000);
    //         });
    // } else {
    //    console.log('getUserMedia not supported on your browser!');
    // }

    // Password viewing
    $('input[type="password"]').addClass('password');

    var title = "Orient window to view your password";
    var dataHtml = false;
    var pw = $('.password');
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        $(document).orientationchange(function() {
            pw.attr('type', (pw.attr('type') === 'password' ? 'text' : 'password'));
        })
    } else {
        title = "Hold <kbd>ctrl</kbd> to view password";
        dataHtml = true;
        $(document).keydown(function(event) {
            if (event.which === 17) {
                pw.attr('type', 'text');
            }
        })
        $(document).keyup(function(event) {
            if (event.which === 17) {
                pw.attr('type', 'password');
            }
        });
    }
    pw.attr({
        "data-toggle": "tooltip",
        "data-placement": 'right',
        "data-html" : dataHtml,
        "title": title,
    });
    pw.tooltip();

    setTimeout(function () {
        Fingerprint2.get(function (components) {
            var values = components.map(function (component) { return component.value });
            var murmur = Fingerprint2.x64hash128(values.join(''), 31);
            $("#fingerprint").val(murmur);
            $("#signin_fingerprint").val(murmur);
            console.log("fingerprint:" + murmur);
            // console.log(values);
            $("#login").prop('disabled', false);
        })
    }, 200);

    // if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(function(position) {
    //         alert("done");
    //         console.log("Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude + "<br>Altitude: " + position.coords.altitude);
    //     });
    // } else {
    //     x.innerHTML = "Geolocation is not supported by this browser.";
    // }

    // function onClick() {
    //     alert('Hello');
    //     //var sound = new SpeechSynthesisUtterance("Hello World");
    //     //speechSynthesis.speak(sound);
    // };
});

