<?php

require_once "App/Model/database.php";

class Login extends Database
{
    // Database Connection Variable
    private $db = null;

    // Methods
    /**
     * Title : Verify Login Credentials
     * Params: @username: contains username submitted through form
     *         @password: contains password submitted through form
     * Status: Completed
     */
    public function verify($username, $password)
    {
        if (!isset($db)) {
            $this->connect();
        }
        $sql = "SELECT * FROM credentials WHERE username=:username";
        $data = $this->db->prepare($sql);
        $data->execute([
            ':username'    => $username
        ]);
        $data->setFetchMode(PDO::FETCH_ASSOC);
        $rest = $data->fetchAll();

        foreach ($rest as $d) {
            if ($d['username'] == $username && password_verify($password, $d['password'])) {
                $_SESSION['USERID'] = $d['id'];
                $_SESSION['USERNAME'] = $d['username'];
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Title : User Registration
     * Params: @username: contains username submitted through form
     *         @password: contains password submitted through form
     * Status: Completed
     */
    public function register($username, $password)
    {
        if (!isset($db)) {
            $this->connect();
        }
        // Check User
        if ($this->getUser($username)) {
            echo "User Exists!";
        } else {
            $sql = "INSERT INTO credentials (username, password) VALUES (:name, :password)";
            $data = $this->db->prepare($sql);
            $data->execute([
                ':name'     => $username,
                ':password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
        }
    }

    /**
     * Title      : User Validation
     * Description: Check if user exists or not
     * Params     : @username: contains username submitted through form
     * Status     : Completed
     */
    private function getUser($username)
    {
        if (!isset($db)) {
            $this->connect();
        }
        $sql = "SELECT email FROM credentials WHERE username= :name";
        $data = $this->db->prepare($sql);
        $data->execute([
            ':name' => $username
        ]);
        $data->setFetchMode(PDO::FETCH_ASSOC);
        if (count($data->fetchAll()) == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Title : Database Connection
     * Status: Completed
     */
    public function connect()
    {
        $this->db = parent::connect();
    }

    /**
     * Title : Destructor
     * Status: Completed
     */
    function __destruct()
    {
        $this->db = null;
        parent::__destruct();
    }
}
