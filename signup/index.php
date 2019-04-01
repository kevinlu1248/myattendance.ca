 <?php
require_once '../includes/header.php';
?>

<?php
    $signup = $_GET['signup'];
    if ($signup === "failure") {
        require_once "signupFailure.php";
    } elseif ($signup === "duplicateError") {
        require_once "duplicateError.php";
    }
    unset($_GET['signup']);
?>

<div id="entry" class="p-5 m-x-3 img-fluid img-thumbnail">
    <div class="row">
        <div class="col-sm-4"></div>
        <div id="signup-holder" class="col-sm-4 d-inline-block signup-col text-center float-center text-white">
            <h1>Sign up</h1>
            <form id="signup" action="../library/formActions/signup.php" method="POST">
                <!-- <form id="signup" class="container text-center" action="../library/formActions/signup.php" method="POST"> -->
                <!-- Toggle Switch -->
                <input id="fingerprint" type="text" name="fingerprint" hidden>
                <div class="form-group">
                    <input type="text" placeholder="First name" class="form-control input-box" id="first" autocomplete="given-name" name="first">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Last name" class="form-control input-box" id="last" autocomplete="family-name" name="last">
                </div>
                <div class="form-group">
                    <input type="number" placeholder="Student ID" class="form-control input-box" min="100000" max="99999999" id="studentId" name="studentId">
                </div>
                <div class="form-group">
                    <input type="email" placeholder="Email" class="form-control input-box" id="email" autocomplete="email" name="email">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" class="form-control input-box" maxlength="20" id="pwd" autocomplete="new-password" name="pwd">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Repeat password" class="form-control input-box" maxlength="20" id="rpwd" autocomplete="new-password" name="rpwd">
                </div>

                <label class="checkbox-inline form-group">
                    I am a teacher &nbsp
                    <input id="isTeacher" class="checkbox-inline" type="checkbox" name="isTeacher">
                </label>
                &nbsp | &nbsp
                <label class="checkbox-inline form-group">
                    Remember me &nbsp
                    <input id="rememberMe" class="checkbox-inline" type="checkbox" name="rememberMe">
                </label>

                <p class="text-danger" id="validStudentId">Please enter a valid student ID</p>
                <p class="text-danger" id="validEmail">Please enter a valid email</p>
                <p class="text-danger" id="validPassword">Your password must be between 8-20 characters</p>
                <p class="text-danger" id="samePassword">Your passwords do not match</p>
                <p class="text-danger" id="invalidity">Please complete all fields</p>

                <button id="submit" type="submit" class="btn btn-primary" disabled>Sign up</button>
            </form>
        </div>
        <div class="col-sm-4"> </div>
    </div>
</div>

<script type="text/javascript" src="signup.js"></script>

<?php
require_once '../includes/footer.php';
?>
