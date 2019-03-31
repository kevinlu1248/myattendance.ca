<?php
include_once "../conn/query.php";
include_once "sessioner.php";

class Login extends Query {
    private $email;
    // user inputted password
    private $password;
    private $user;
    private $fingerprint;
    public $passwordIsCorrect;

    public function __construct(string $email, string $password, $fingerprint) {
        $this->email = $email;
        $this->password = $password;
        $this->user = $this->connectUser();
        $this->passwordIsCorrect = $this->verify();

        if ($this->passwordIsCorrect) {
            $this->sessionize();
            $this->setAutoLogin();
        } else {
            $_SESSION["user"] = 0;
        }
    }

    private function connectUser() {
        //get user with this email
        $user = parent::getUser($this->email, "email")->result->fetch(PDO::FETCH_ASSOC);
        // var_dump(Query::getUser($this->email, "email"));
        return $user;
    }

    private function verify() {
        //actual password
        $hash = $this->user['password'];
        return password_verify($this->password, $hash);
    }

    private function sessionize() {
        $sessioner = new Sessioner($this->user);
        $sessioner->session();
    }

    private function setAutoLogin() {
        $query = Query::update("user", array("fingerprint" => $this->fingerprint), array("email" => $this->email), 1);
        var_dump($query);
        // $id = Query::getIDByEmail($this->email);
        // setcookie("email", $this->email, time() + 60 * 60 * 24 * 30, "/"); #cookie lasts for 30 days
        // setcookie("hash", Query::pw_hash($this->fingerprint.$this->id), time() + 60 * 60 * 24 * 30, "/"); #cookie lasts for 30 days
    }
}

$fingerprint = $_POST['fingerprint'];
$email = $_POST['email'];
$password = $_POST['password'];
$login = new Login($email, $password, $fingerprint);

// echo var_dump($_COOKIE["email"]);
$header = "Location: http://www.myattendance.ca";
if ($login->passwordIsCorrect) {
    $header .=
}
header("Location: http://www.myattendance.ca");
exit();
