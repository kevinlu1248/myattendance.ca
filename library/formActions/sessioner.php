<?php

session_start();
class Sessioner {
    private static $unsets = array("password", "fingerprint");
    private $user;

    public function __construct(array $user) {
        foreach(array("password", "fingerprint") as $i) {
            if (isset($user[$i])) {
                unset($user[$i]);
            }
        }
        $this->user = $user;
    }

    public function session() {
        $_SESSION["user"] = $this->user;
    }
}
