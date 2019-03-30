<?php

/*
class Mail {

    private $
    public function __constructor
}
*/

try {
    $didSucceed = mail("My Attendance <noreply@myattendance.ca>", "Test", "This is a test", "From: noreply@myattendance.ca");
    echo $didSucceed;
} catch(Exception $e) {
    echo $e->getMessage();
}
