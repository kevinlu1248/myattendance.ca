<?php
    session_start();
    #set_include_path(".:../usr/lib/php7.2:../library/includePath.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript"> var start = new Date(); </script>
    <meta charset="utf-8">
    <meta name="description" content="A protoype for an attendance system.">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="theme-color" content="#5DBCD2">
    <link rel="icon" type="image/jpg" href="/myattendance.ca/assets/favicon.jpg">
    <title>Attendance</title>

    <!--Bower-->
    <!-- <link rel="stylesheet" type="text/css" ref="bower_components/bootstrap/dist/css/bootstrap.css">
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/jquery/dist/js/bootstrap.js"></script> -->
    <!--Bootstrap CSS-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!--Bootstrap JS-->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script> -->
    <!-- Bootstrap Toggle -->
    <!-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> -->
    <!--User CSS-->
    <link rel="stylesheet" type="text/css" href="/myattendance.ca/css/main.css" media="screen"/>

    <!--Icons-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!--fingerprint2-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs2/2.0.3/fingerprint2.min.js" integrity="sha256-KHjiYfRgjv+1nTnungHdPqfBbH/2C0cO6AMgCciZQJk=" crossorigin="anonymous"></script>
    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!--QR Code Generator-->
    <!-- <script src="https://raw.githubusercontent.com/jeromeetienne/jquery-qrcode/master/jquery.qrcode.min.js"></script> -->

</head>
<body>
    <nav id="nav" class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <!--Navbar Button-->
        <button class="navbar-toggler btn btn-outline-secondary" type="button" data-toggle="collapse" data-target=".drop" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-caret-down"></i>
        </button>
        &nbsp&nbsp

        <!--Title-->
        <div class="navbar-header">
            <a class="navbar-brand" href="../">MyAttendance</a>
        </div>

        <!--Dropdown Menus-->
        <div class="drop collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav float-left">
                <li class="nav-item active">
                <a class="nav-link" href="../">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Privacy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
            </ul>
        </div>

        <div class="float-right">
            <?php
                $logout = $_GET['logout'];
                if ($logout === "true") {
                    unset($_SESSION["user"]);
                }

                $user = $_SESSION["user"];
                $passwordIsCorrect = $_GET["passwordIsCorrect"];
                // $passwordIsCorrect == 0 means that login is incorrect
                if ($user == NULL || $passwordIsCorrect == "false") {
                    require_once "userDisplay/form.php";
                } else {
                    require_once "userDisplay/user.php";
                }
            ?>
        </div>
        <!-- For toggle -->
    </nav>
<div id="main" class="padding-x-md">
<noscript>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      Your browser does not support Javascript. Please enable Javascript or use a different browser.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
</noscript>

<?php
    if ($passwordIsCorrect == "false") {
        require_once "loginFailure.php";
        unset($_SESSION["user"]);
    }
?>
