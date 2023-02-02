<?php

    include "../Database/Connection.php";
    class products extends dbConnection{

        private $dbConnection;
    
        public function __construct()
        {
            $this->dbConnection = $this->connect("root","localhost","password","stockWiz");

            if ($this->dbConnection === false) {
                return false;
            }
        }

        
        public function saveProduct($code,$name,$exdate,$price,$supplier,$qty,$o_price,$profit,$gen,$date_arrival,$qty_sold){
           //print $productName . " " . $quantity . " " . $purchase_price . " " .$selling_price;
           $sql = $sql = "INSERT INTO products (product_code,product_name,expiry_date,price,supplier,qty,o_price,profit,gen_name,date_arrival,qty_sold)
            VALUES ('$code','$name','$exdate','$price','$supplier','$qty','$o_price','$profit','$gen','$date_arrival','$qty_sold')";

            if ($this->dbConnection->query($sql) === TRUE) {
              header("location: product.php");
            } else {
              return "Error: " . $sql . "<br>" . $this->dbConnection->error;
            }
    }

    public function getAllProduct(){

        $data = [];

        $sql = "select * from product_inventory";

        $result = $this->dbConnection->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              //echo "id: " . $row["id"]. " - product Name: " . $row["product_name"]. " - Quantity: " . $row["quantity"]. " - Purcahse Price: " . $row["quantity"]. " - Selling Price: " . $row["quantity"]. "<br>";
              $data[] = $row;
            }
          } else {
            echo "0 results";
          }

          return $data;
    }

    public function deleteProductById($id){
        $sql = "Delete * from products where id = $id";

        if ($this->dbConnection->query($sql) === TRUE) {
            return "Record Deleted Successfully";
        } else {
          return "Error: " . $sql . "<br>" . $this->dbConnection->error;
        }
    }

}

?>