<?php
   
if (isset($_POST['code']) && isset($_POST['name']) && isset($_POST['exdate']) && isset($_POST['price']) && isset($_POST['supplier']) && isset($_POST['qty']) && isset($_POST['o_price']) && isset($_POST['profit']) && isset($_POST['gen']) && isset($_POST['date_arrival']) && isset($_POST['qty_sold'])) {
    include "../models/productClass.php";
    $product = new products;
    echo $product->saveProduct($_POST['code'],$_POST['name'],$_POST['exdate'],$_POST['price'],$_POST['supplier'],$_POST['qty'],$_POST['o_price'],$_POST['profit'],$_POST['gen'],$_POST['date_arrival'],$_POST['qty_sold']);
}

?>


<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<center><h4><i class="icon-plus-sign icon-large"></i> Add Product</h4></center>
<hr>
<div id="ac">
<span>Brand Name : </span><input type="text" style="width:265px; height:30px;" name="code" ><br>
<span>Generic Name : </span><input type="text" style="width:265px; height:30px;" name="gen" Required/><br>
<span>Category / Description : </span><textarea style="width:265px; height:50px;" name="name"> </textarea><br>
<span>Date Arrival: </span><input type="date" style="width:265px; height:30px;" name="date_arrival" /><br>
<span>Expiry Date : </span><input type="date" value="<?php echo date ('M-d-Y'); ?>" style="width:265px; height:30px;" name="exdate" /><br>
<span>Selling Price : </span><input type="text" id="txt1" style="width:265px; height:30px;" name="price" onkeyup="sum();" Required><br>
<span>Original Price : </span><input type="text" id="txt2" style="width:265px; height:30px;" name="o_price" onkeyup="sum();" Required><br>
<span>Profit : </span><input type="text" id="txt3" style="width:265px; height:30px;" name="profit" readonly><br>
<span>Supplier : </span>
<select name="supplier"  style="width:265px; height:30px; margin-left:-5px;" >
<option></option>
	<?php
	include('../Database/Connection.php');
        $conn = new dbConnection;
        $connection = $conn->connect("root", "localhost", "password", "stockWiz");
        $result = $connection->query("SELECT * FROM supliers");
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                //echo "id: " . $row["id"]. " - product Name: " . $row["product_name"]. " - Quantity: " . $row["quantity"]. " - Purcahse Price: " . $row["quantity"]. " - Selling Price: " . $row["quantity"]. "<br>";
                ?>
                <option><?php echo $row['suplier_name']; ?></option>
            <?php
            }
        }
	?>
    
</select><br>
<span>Quantity : </span><input type="number" style="width:265px; height:30px;" min="0" id="txt11" onkeyup="sum();" name="qty" Required ><br>
<span></span><input type="hidden" style="width:265px; height:30px;" id="txt22" name="qty_sold" Required ><br>
<div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button>
</div>
</div>
</form>
