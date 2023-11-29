<?php

class Database
{
    private $dbconn;
    private $username = "root";
    private $hostname = "localhost";
    private $password = "";
    private $database = "storymie";

    private function connection()
    {
        try {
            $this->dbconn = new PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->database, $this->username, $this->password);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function connect()
    {
        $this->connection();
        return $this->dbconn;
    }

    function __destruct()
    {
        $this->dbconn = null;
    }
}
