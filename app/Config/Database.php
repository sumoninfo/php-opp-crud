<?php

namespace App\Config;

class Database
{
    private $servername = 'localhost';
    private $user = "root";
    private $password = "1234";
    private $database = "learn_php-opp-crud";
    public $db_connection;

    // Database Connection
    public function __construct()
    {
        $this->db_connection = new \mysqli($this->servername, $this->user, $this->password, $this->database);
        if (mysqli_connect_error()) {
            trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
        } else {
            return $this->db_connection;
        }
    }

    /**
     * get all data from DB
     *
     * @param $sql
     * @return array
     */
    protected function getAllData($sql)
    {
        $statements = $this->db_connection->prepare($sql);
        $statements->execute();
        $result = $statements->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * get find by id data from DB
     *
     * @param $sql
     * @return array|null
     */
    protected function getFindByIdData($sql)
    {
        $statements = $this->db_connection->prepare($sql);
        $statements->execute();
        $result = $statements->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo "Not found";
        }
    }

    /**
     * delete find by id data form DB
     *
     * @param $table
     * @param $id
     */
    protected function delete($table, $id)
    {
        $statements = $this->db_connection->prepare("DELETE FROM $table WHERE id = ?");
        $statements->bind_param("i", $id);
        $statements->execute();
        if ($statements->execute() == true) {
            $_SESSION['message'] = "Deleted successfully";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Not found!";
        }
    }
}


