<?php

require_once "App/Model/database.php";

class User extends Database
{
    // Data Members
    private $db = null;

    // Methods
    /**
     * Title : Insert Stories to DB
     * Params: @story_title: User Given Title
     *         @story_body: User Given Story Body
     * Status: Completed
     */
    public function insert($story_title, $story_body)
    {
        if (!isset($this->db)) {
            $this->connect();
        }
        try {
            echo $story_title . " " . $story_body . $_SESSION['USERID'];
            $sql = "INSERT INTO stories (userid, title, story) VALUES (:userid, :mytitle, :mystory)";
            $data = $this->db->prepare($sql);
            $data->execute([
                ':userid'       => (int)$_SESSION['USERID'],
                ':mytitle'      => $story_title,
                ':mystory'      => $story_body
            ]);
        } catch (exception $e) {
            echo $e;
        }
    }

    public function getPosts()
    {
        if (!isset($db)) {
            $this->connect();
        }
        $sql = "SELECT * FROM stories WHERE userid=:userid";
        $data = $this->db->prepare($sql);
        $data->execute([
            ':userid'    => $_SESSION['USERID']
        ]);
        $data->setFetchMode(PDO::FETCH_ASSOC);
        return $data->fetchAll();
    }

    public function delete($postID)
    {
        if (!isset($db)) {
            $this->connect();
        }
        $sql = "DELETE FROM stories WHERE id=$postID";
        $this->db->exec($sql);
    }



    /**
     * Title : Database Connection
     * Status: Completed
     */
    public function connect()
    {
        $this->db = parent::connect();
    }
}
