<?php

//Database connection
class Dbh {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;
    private $dsn;

    protected function connect() {
        $this->servername = "db763042919.hosting-data.io";
        $this->username = "dbo763042919";
        $this->password = "qwrrty24";
        $this->dbname = "db763042919";
        $this->charset = "utf8";

        try {
            $dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset.";";
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e){
            die("Connection failed: ".$e->getMessage());
        }
    }
}


