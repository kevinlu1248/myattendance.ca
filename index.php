<?php
require_once 'includes/header.php';
?>

<?php
    if ($_GET["signup"] === "success") {
        include_once "banners/signupSuccess.php";
    }
    unset($_GET["signup"]);
?>

<script>
    <?php
    $test = print_r($_SESSION["user"], true);
    echo "console.log(`$test`);";
    ?>
</script>

<div id="entry" class="container p-5 m-x-3 img-fluid img-thumbnail">
    <div class="row">
        <?php
        if($user) {
            require "mainPages/signedIn.php";
        } else {
            require "mainPages/notSignedIn.php";
        }
        ?>
    </div>
</div>

<!-- <p id="fingerprint">
    Loading your id...
</p>-->

<?php //phpinfo(); ?>

<?php
require_once 'includes/footer.php';
?>
