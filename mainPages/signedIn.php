<div id="editData" class="col-sm">
    <div id="editData-holder" class="row-4 text-white">
        <h1> <?php echo "$first $last";?> </h1>
        <h3>
            Personal Data Change
        </h3>
        <form id="personalDataChange" action="../library/formActions/personalDataChange.php" method="POST">
            <!-- <form id="signup" class="container text-center" action="../library/formActions/signup.php" method="POST"> -->
            <div class="form-group">
                <input type="text" placeholder="First name" class="form-control input-box" id="first" autocomplete="given-name" name="first" value="<?php echo $first; ?>">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Last name" class="form-control input-box" id="last" autocomplete="family-name" name="last" value="<?php echo $last; ?>">
            </div>
            <div class="form-group">
                <input type="number" placeholder="Student ID" class="form-control input-box" min="100000" max="99999999" id="studentId" name="studentId" value="<?php echo $user['studentID']; ?>">
            </div>
            <button id="submitPersonalDataChange" type="submit" class="btn btn-primary" disabled>Change Personal Data</button>
        </form>
    </br>
    </br>
        <h3>
            Password Change
        </h3>
        <form id="changePassword">
            <div class="form-group" action="" method="POST">
                <input type="password" placeholder="Current Password" class="form-control input-box" maxlength="20" id="cpwd" autocomplete="current-password" name="cpwd">
            </div>
            <div class="form-group">
                <input type="password" placeholder="New Password" class="form-control input-box" maxlength="20" id="npwd" autocomplete="new-password" name="npwd">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Repeat new password" class="form-control input-box" maxlength="20" id="rpwd" autocomplete="new-password" name="rpwd">
            </div>
            <p class="text-danger" id="samePassword" hidden>Your passwords do not match</p>
            <p class="text-danger" id="invalidity" hidden>Please complete all fields</p>
            <button id="submitPasswordChange" type="submit" class="btn btn-primary" disabled>Change Password </button>
        </form>
    </div>
</div>
<div class="col-sm">
    <div id="device-binder" class="card text-justify">
      <div id="qrcode" class="card-img-top text-center">
        <div id="qrSpinner" class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
      <div class="card-body">
        <h3 class="card-title">Device Binding</h3>
        <h6 class="card-subtitle mb-2 text-muted">The device used for taking attendance</h6>
        <p class="card-text">Please bind a device for taking attendance. Please note that only mobile devices are allowed.</p>
        <p class="card-text"><strong>Furthermore, once bound, it is impossible to unbind your device without the assistance of a teacher.</strong></p>

        <span id="binderContainer" class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="right" data-html="true" title='Mobile devices only'>
            <button type="button" id="binder" href="#" class="btn btn-primary float-center">Bind this device</button>
        </span>

      </div>
    </div>
</div>

<script src="js/qrcode.js"></script>
<script src="js/qrcode.min.js"></script>
<script src="js/deviceBinding.js"></script>
<script src="mainPages/signedIn.js"></script>
