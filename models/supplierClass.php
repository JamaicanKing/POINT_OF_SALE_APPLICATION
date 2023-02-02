<?php

    include "../Database/Connection.php";
    class suppliers extends dbConnection{

        private $dbConnection;
    
        public function __construct()
        {
            $this->dbConnection = $this->connect("root","localhost","password","stockWiz");

            if ($this->dbConnection === false) {
                return false;
            }
        }

        public function saveSuppier($name,$address,$contact,$cperson,$note){

            $sql = "INSERT INTO supliers(suplier_name,suplier_address,suplier_contact,contact_person,note)
            VALUES ('$name','$address','$contact','$cperson','$note')";

            if ($this->dbConnection->query($sql) === TRUE) {
                header("location: supplier.php");
            } else {
              return "Error: " . $sql . "<br>" . $this->dbConnection->error;
            }

        }
    }