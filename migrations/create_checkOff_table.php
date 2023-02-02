<?php

    include "../Database/Connection.php";

    class CreateCheckOffTable extends dbConnection{

        private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = $this->connect("root","localhost","password","stockWiz");

        if ($this->conn === false) {
            return false;
        }
    }

    public function createtable(){

        // sql to create table
        $sql = "CREATE TABLE checkOff (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        product_id VARCHAR(255) NOT NULL,
        quantity int(6) DEFAULT 0,
        quantity_remaining int(6) DEFAULT 0,
        purchasing_price int(6) DEFAULT 0,
        selling_price int(6) DEFAULT 0,
        amount int(6) DEFAULT 0,
        price int(6) DEFAULT 0,
        created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        if ($this->dbConnection->query($sql) === TRUE) {
        echo "Table check Off Table created successfully";
        } else {
        echo "Error creating table: " . $this->conn->error;
        }
        
        $this->dbConnection->close();
    }
    

}