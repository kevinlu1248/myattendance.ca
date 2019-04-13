<?php
require_once "../conn/query.php";
session_start();

class passwordChange extends Query {
    private $uid;
    private $currentPassword;
    private $newPassword;
    private $repeatPassword;
    private $passwordsAreTheSame;
    public $passwordIsCorrect;
    public $didSucceed;

    public function __construct(string $uid, string $currentPassword, string $newPassword, string $repeatPassword) {
        $this->uid = $uid;
        $this->currentPassword = $currentPassword;
        $this->newPassword = $newPassword;
        $this->repeatPassword = $repeatPassword;

        $this->passwordsAreTheSame = ($this->newPassword == $this->repeatPassword);

        $hash = Query::getUser($this->uid, "ID", ["password"])->result->fetch(PDO::FETCH_NUM)[0];
        $this->passwordIsCorrect = password_verify($this->currentPassword, $hash);

        if ($this->passwordIsCorrect) {
            $changes = array (
                'password' => Query::pw_hash($this->newPassword));
            $conditions = array ('ID' => $this->uid);
            $query = Query::update("users", $changes, $conditions, 1);
            $this->didSucceed = $query->didSucceed;
            // var_dump($query);
        }
    }
}

$uid = $_SESSION["user"]["ID"];
$currentPassword = $_POST["cpwd"];
$newPassword = $_POST["npwd"];
$repeatPassword = $_POST["rpwd"];

$passwordChange = new passwordChange($uid, $newFirst, $newLast, $newStudentId, $password);
$passwordIsCorrect = ($dataChange->passwordIsCorrect) ? 'true' : 'false';
$didSucceed = ($dataChange->didSucceed) ? 'true' : 'false';
// var_dump($dataChange);
// echo $didSucceed;

header("Location: $URL/?updatePasswordIsCorrect=$passwordIsCorrect&updateSuccess=$didSucceed");
exit();
