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

    public function __construct(string $email, string $password, string $fingerprint) {
        if (!($email && $password && $fingerprint)) {
            $passwordIsCorrect = false;
            return 0;
        }
        $this->email = $email;
        $this->password = $password;
        $this->user = $this->connectUser();
        $this->fingerprint = $fingerprint;
        $this->passwordIsCorrect = $this->verify();

        if ($this->passwordIsCorrect) {
            $this->sessionize();
            $this->setAutoLogin();
        }
    }

    private function connectUser() {
        //get user with this email
        $user = Query::getUser($this->email, "email")->result->fetch(PDO::FETCH_ASSOC);
        // var_dump($user);
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
        # updates fingerprint
        $query = Query::update("users", array("fingerprint" => $this->fingerprint), array("email" => $this->email), 1);
        // var_dump($query);

        // UPDATE `users` SET `fingerprint` = 'eb49c8bb7e273a58b2fc35b560a77398' WHERE `users`.`ID` = 1;
        // $id = Query::getIDByEmail($this->email);

        # for autologin
        setcookie("email", $this->email, time() + 60 * 60 * 24 * 30, "/"); #cookie lasts for 30 days
        // setcookie("hash", Query::pw_hash($this->fingerprint.$this->id), time() + 60 * 60 * 24 * 30, "/"); #cookie lasts for 30 days
    }
}

$fingerprint = $_POST['fingerprint'];
// echo $fingerprint;
$email = $_POST['email'];
$password = $_POST['password'];
// echo $fingerprint;

$login = new Login($email, $password, $fingerprint);
$passwordIsCorrect = ($login->passwordIsCorrect) ? 'true' : 'false';
// echo "$URL?passwordIsCorrect=$passwordIsCorrect";

// echo var_dump($_COOKIE["email"]);
header("Location: $URL?passwordIsCorrect=$passwordIsCorrect");
exit();
