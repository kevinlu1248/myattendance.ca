<?php
require_once "../conn/query.php";
session_start();

class dataChange extends Query {
    private $uid;
    private $newFirst;
    private $newLast;
    private $newStudentId;
    private $password;
    public $passwordIsCorrect;
    public $didSucceed;

    public function __construct(string $uid, string $newFirst, string $newLast, string $newStudentId, string $password) {
        $this->uid = $uid;
        $this->newFirst = $newFirst;
        $this->newLast = $newLast;
        $this->newStudentId = $newStudentId;
        $this->password = $password;

        $hash = Query::getUser($this->uid, "ID", ["password"])->result->fetch(PDO::FETCH_NUM)[0];
        $this->passwordIsCorrect = password_verify($this->password, $hash);

        if ($this->passwordIsCorrect) {
            $changes = array (
                'firstName' => $this->newFirst,
                'lastName' => $this->newLast,
                'studentID' => $this->newStudentId);
            $conditions = array ('ID' => $this->uid);
            $query = Query::update("users", $changes, $conditions, 1);
            $this->didSucceed = $query->didSucceed;
            // var_dump($query);
        }
    }
}

$uid = $_SESSION["user"]["ID"];
$newFirst = $_POST["first"];
$newLast = $_POST["last"];
$newStudentId = $_POST["studentId"];
$password = $_POST["password"];

$dataChange = new dataChange($uid, $newFirst, $newLast, $newStudentId, $password);
$passwordIsCorrect = ($dataChange->passwordIsCorrect) ? 'true' : 'false';
$didSucceed = ($dataChange->didSucceed) ? 'true' : 'false';
// var_dump($dataChange);
// echo $didSucceed;

header("Location: $URL/?updatePasswordIsCorrect=$passwordIsCorrect&updateSuccess=$didSucceed");
exit();
