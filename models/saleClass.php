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
    }
?>