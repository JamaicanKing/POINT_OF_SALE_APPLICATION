<?php

    include "../Database/Connection.php";

    class CreateProductsInventoryTable extends dbConnection{

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
        $sql = "CREATE TABLE product_inventory (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        product_inventory VARCHAR(255) NOT NULL,
        quantity int(6) DEFAULT 0,
        purchase_price int(6) DEFAULT 0,
        selling_price int(6) DEFAULT 0,
        created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        if ($this->dbConnection->query($sql) === TRUE) {
        echo "Table product_inventory created successfully";
        } else {
        echo "Error creating table: " . $this->conn->error;
        }
        
        $this->dbConnection->close();
    }
    

}
