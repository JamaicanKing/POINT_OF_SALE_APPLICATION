<?php

class dbConnection
{

    public $conn;

    public function connect($username, $servername, $password,$dbname)
    {
        // Create connection
        $this->conn = new mysqli($servername, $username, $password,$dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    public function createDatabase(){
        // Create database
        $sql = "CREATE DATABASE stockWiz";
        if ($this->conn->query($sql) === TRUE) {
            return  "Database created successfully";
        } else {
            return "Error creating database: " . $this->conn->error;
        }

    }

    

    public function disconnect()
    {
        $this->conn->close();

        echo "Databse Disconnected";
    }
}

?>