<div>
    <a id="user" class="btn btn-outline-primary float-left m-r-3" href="../../">
        <i class="fas fa-user"></i>
        &nbsp
        <?php
        $user = $_SESSION["user"];
        $first = $user["firstName"];
        $last = $user["lastName"];
        echo "$first $last";
        ?>
    </a>

    <a id="logout" class="btn btn-outline-secondary h-25 float-left" href="/myattendance.ca/library/formActions/logout.php">
        Log out
    </a>
</div>
