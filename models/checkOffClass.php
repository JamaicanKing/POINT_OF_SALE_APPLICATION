<?php

    include "../Database/Connection.php";
    class checkOff extends dbConnection{

        private $dbConnection;
    
        public function __construct()
        {
            $this->dbConnection = $this->connect("root","localhost","password","stockWiz");

            if ($this->dbConnection === false) {
                return false;
            }
        }

        public function saveCheckOff(array $array){

           foreach($array as $key => $value){
                if(is_int($key)){
                    $sql = "INSERT INTO checkoff(product_id,quantity,quantity_remaining,purchasing_price,selling_price,total_amount,profit)
                    VALUES ('$key','$value[qty]','$value[qtyR]','$value[o_price]','$value[price]','$value[amount]','$value[profit]')";
                    $this->dbConnection->query($sql);
                }
           }

           echo "successful";

        }
    }
?>