<?php
include_once "../conn/query.php";
include_once "sessioner.php";

class Login extends Query {
    private $email;
    // user inputted password
    private $password;
    private $user;
    public $passwordIsCorrect;

    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
        $this->user = $this->connectUser();
        $this->passwordIsCorrect = $this->verify();

        if ($this->passwordIsCorrect) {
            $this->sessionize();
            $this->setAutoLogin();
        }
    }

    private function connectUser() {
        //get user with this email
        return parent::getUser($this->email, "email")->result->fetch(PDO::FETCH_ASSOC);
    }

    private function verify() {
        //actual password
        $hash = $this->user['password'];
        return password_verify($this->password, $hash);
    }

    private function sessionize() {
        if ($this->passwordIsCorrect) {
            $sessioner = new Sessioner($this->user);
            $sessioner->session();
        } else {
            $_SESSION["user"] = 0;
        }
    }

    private function setAutoLogin() {
        $id = Query::getIDByEmail($this->email);
        setcookie("email", $this->email, time() + 60 * 60 * 24 * 30, "/"); #cookie lasts for 30 days
        setcookie("hash", Query::pw_hash($this->fingerprint.$this->id), time() + 60 * 60 * 24 * 30, "/"); #cookie lasts for 30 days
    }
}

$fingerprint = $_POST['fingerprint'];
$email = $_POST['email'];
$password = $_POST['password'];
$login = new Login($email, $password);

// echo var_dump($_COOKIE["email"]);
header("Location: http://www.myattendance.ca");
exit();
