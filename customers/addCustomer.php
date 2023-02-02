<?php
   
if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['contact']) && isset($_POST['memno']) && isset($_POST['prod_name']) && isset($_POST['note']) && isset($_POST['date'])) {
    include "../models/customerClass.php";
    $customer = new customers;
    echo $customer->saveCustomer($_POST['name'],$_POST['address'],$_POST['contact'],$_POST['memno'],$_POST['prod_name'],$_POST['note'],$_POST['date']);
}

?>


<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<center><h4><i class="icon-plus-sign icon-large"></i> Add Customer</h4></center>
<hr>
<div id="ac">
<span>Full Name : </span><input type="text" style="width:265px; height:30px;" name="name" placeholder="Full Name" Required/><br>
<span>Address : </span><input type="text" style="width:265px; height:30px;" name="address" placeholder="Address"/><br>
<span>Contact : </span><input type="text" style="width:265px; height:30px;" name="contact" placeholder="Contact"/><br>
<span>Product Name : </span><textarea style="height:70px; width:265px;" name="prod_name"></textarea><br>
<span>Total: </span><input type="text" style="width:265px; height:30px;" name="memno" placeholder="Total"/><br>
<span>Note : </span><textarea style="height:60px; width:265px;" name="note"></textarea><br>
<span>Expected Date: </span><input type="date" style="width:265px; height:30px;" name="date" placeholder="Date"/><br>
<div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button>
</div>
</div>
</form>