<?php
include_once "../conn/query.php";

// class Signup extends Query {
//     private $first;
//     private $last;
//     private $studentId;
//     private $email;
//     private $pwd;

//     public function __construct(string $fingerprint, string $first, string $last, int $studentId, string $email, string $pwd) {
//         $this->fingerprint = $fingerprint;
//         $this->first = $first;
//         $this->last = $last;
//         $this->studentId = $studentId;
//         $this->email = $email;
//         $this->pwd = $pwd;
//     }

//     public function signupUser() {
//         $query = parent::register($this->fingerprint, $this->email, $this->pwd, $this->first, $this->last, $this->studentId);
//         if ($query->errs) {
//             return $query->errs;
//         } else {
//             return $query->result;
//         }
//     }
// }

$fingerprint = $_POST["fingerprint"];
$first = $_POST["first"];
$last = $_POST["last"];
$id = $_POST["studentId"];
$email = $_POST["email"];
$pwd = $_POST["pwd"];
$isTeacher = $_POST["isTeacher"];
$rememberMe = $_POST["rememberMe"];

$isTeacher = (($isTeacher == "on") ? 1 : 0);
$rememberMe = (($rememberMe == "on") ? 1 : 0);

//check if $studentID or $email in database
$exists = Query::existsInDb([$id, $email], ["studentID", "email"], "users");
if ($exists) {
    header("Location: https://www.myattendance.ca/signup/?signup=duplicateError");
}

// echo var_dump([$fingerprint, $first, $last]);
// 1 is success
// otherwise error message
$query = Query::register($fingerprint, $email, $pwd, $first, $last, $isTeacher, $id, $rememberMe);
if ($query->errs) {
    header("Location: https://www.myattendance.ca/signup/?signup=failure");
} else {
    header("Location: https://www.myattendance.ca?signup=success");
}
exit();
// $signup = new Signup($fingerprint, $first, $last, $studentId, $email, $pwd);
// echo $signup->signupUser();
