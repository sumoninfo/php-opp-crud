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
}


