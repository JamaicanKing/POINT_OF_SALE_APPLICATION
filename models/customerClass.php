<?php

    include "../Database/Connection.php";
    class customers extends dbConnection{

        private $dbConnection;
    
        public function __construct()
        {
            $this->dbConnection = $this->connect("root","localhost","password","stockWiz");

            if ($this->dbConnection === false) {
                return false;
            }
        }

        public function saveCustomer($name,$address,$contact,$memno,$prod_name,$note,$date){

            $sql = $sql = "INSERT INTO customer (customer_name,address,contact,membership_number,prod_name,note,expected_date)
            VALUES ('$name','$address','$contact','$memno','$prod_name','$note','$date')";

            if ($this->dbConnection->query($sql) === TRUE) {
                header("location: customer.php");
            } else {
              return "Error: " . $sql . "<br>" . $this->dbConnection->error;
            }

        }
    }
?>