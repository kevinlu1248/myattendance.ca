<?php

include_once "../conn/query.php";
class View extends Query {
    public function getUser(string $fingerprint) {
        $user = parent::getUser($fingerprint)->result->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            unset($user["password"]);
            if $user["rememberMe"] {
                return $user;
            } else {
                return null;
            }
        }
    }
    public function post(array $user) {
        if (isset($user["password"])) {
            unset($user["password"]);
        }
        $_SESSION = $user;
    }
}
$fingerprint = $_POST["fingerprint"];
$object = new View;
$user = $object->getUser($fingerprint);
View::post($user);

//echo var_dump($user);
//echo $_SESSION["password"];
