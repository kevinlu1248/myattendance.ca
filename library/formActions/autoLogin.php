<?php
require_once '../conn/query.php';
require_once 'sessioner.php';

// class AutoSignin extends Query {
//     private $fingerprint;
//     private $email;
//     private $id;
//     private $hash;
//     public $didSucceed = false;

//     public function __construct(string $fingerprint, string $email, string $hash){
//         $this->fingerprint = $fingerprint;
//         $this->email = $email;
//         $this->id = Query::getIDByEmail($email);;
//         $this->hash = $hash;

//         $this->didSucceed = password_verify($this->fingerprint.$this->id, $hash);
//     }

//     public function test() {
//         return $this->fingerprint.$this->id;
//     }
// }

class AutoSignin extends Query {
    private $fingerprint;
    private $email;
    private $user;
    public $didSucceed = false;

    public function __construct(string $fingerprint, string $email) {
        $this->fingerprint = $fingerprint;
        $this->email = $email;

        $this->user = Query::getUser($email, "email")->result->fetch(PDO::FETCH_ASSOC);
        $this->didSucceed = ($this->user["fingerprint"] == $this->fingerprint);

        if ($this->didSucceed) {
            $sessioner = new Sessioner($this->user);
            $sessioner->session();
        }
    }
}

$fingerprint = $_POST['fingerprint'];
$email = $_COOKIE['email'];
// $hash = $_COOKIE['hash'];
$autoSignin = new AutoSignin($fingerprint, $email);

// feedback
$didSucceed = $autoSignin->didSucceed;
echo $didSucceed;
