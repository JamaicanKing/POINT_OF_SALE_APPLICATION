<?php
require_once('../models/checkOffClass.php');

?>

<!DOCTYPE html>
<html>

<head>
    <!-- js -->
    <link href="../src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../lib/jquery.js" type="text/javascript"></script>
    <script src="../src/facebox.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('a[rel*=facebox]').facebox({
                loadingImage: '../src/loading.gif',
                closeImage: '../src/closelabel.png'
            })
        })
    </script>
    <title>
        POS
    </title>
    <?php
    require_once('../auth.php');
    ?>

    <link href="../vendors/uniform.default.css" rel="stylesheet" media="screen">
    <link href="../css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../css/DT_bootstrap.css">

    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }

        .sidebar-nav {
            padding: 9px 0;
        }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- combosearch box-->

    <script src="../vendors/jquery-1.7.2.min.js"></script>
    <script src="../vendors/bootstrap.js"></script>



    <link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
    <!--sa poip up-->




    <script language="javascript" type="text/javascript">
        /* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
        <!-- Begin
        var timerID = null;
        var timerRunning = false;

        function stopclock() {
            if (timerRunning)
                clearTimeout(timerID);
            timerRunning = false;
        }

        function showtime() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds()
            var timeValue = "" + ((hours > 12) ? hours - 12 : hours)
            if (timeValue == "0") timeValue = 12;
            timeValue += ((minutes < 10) ? ":0" : ":") + minutes
            timeValue += ((seconds < 10) ? ":0" : ":") + seconds
            timeValue += (hours >= 12) ? " P.M." : " A.M."
            document.clock.face.value = timeValue;
            timerID = setTimeout("showtime()", 1000);
            timerRunning = true;
        }

        function startclock() {
            stopclock();
            showtime();
        }
        window.onload = startclock;
        // End -->
    </SCRIPT>

</head>
<?php
function createRandomPassword()
{
    $chars = "003232303232023232023456789";
    srand((float)microtime() * 1000000);
    $i = 0;
    $pass = '';
    while ($i <= 7) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;
    }
    return $pass;
}
$finalcode = 'RS-' . createRandomPassword();
?>

<body>
    <?php include('../navfixed.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <?php include('../sideNav.php'); ?>
            </div>
            <div class="span10">
                <div class="contentheader">
                    <i class="icon-money"></i> Sales
                </div>
                <ul class="breadcrumb">
                    <a href="index.php">
                        <li>Dashboard</li>
                    </a> /
                    <li class="active">Check Off</li>
                    <?php
                        $checkOff = new checkOff;
                        $checkOff->saveCheckOff($_POST);
                    ?>
                </ul>
                <div style="margin-top: -19px; margin-bottom: 21px;">
                    <a href="index.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input style="border: transparent" name="date" id="id<?php echo $row['product_id']; ?>" value="<?php
								$Today = date('y:m:d',mktime());
								$new = date('l, F d, Y', strtotime($Today));
								echo $new;
								?>">
                    <table class="table table-bordered" id="resultTable" data-responsive="table">
                        <thead>
                            <tr>
                                <th> Product Name </th>
                                <th> Starting Quantity </th>
                                <th>
                                    <h4> Quantity Remaining </h4>
                                </th>
                                <th> Buying Price </th>
                                <th> Selling Price </th>
                                <th> Total Amount</th>
                                <th> Total Profit </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once('../Database/Connection.php');
                            $conn = new dbConnection;
                            $connection = $conn->connect("root", "localhost", "password", "stockWiz");
                            $result = $connection->query("SELECT * FROM products");
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    //echo "id: " . $row["id"]. " - product Name: " . $row["product_name"]. " - Quantity: " . $row["quantity"]. " - Purcahse Price: " . $row["quantity"]. " - Selling Price: " . $row["quantity"]. "<br>";
                                    $data[] = $row;
                            ?>
                                   
                                    <input type='hidden' style="border: transparent" name="<?php echo $row['product_id']; ?>[]" id="id<?php echo $row['product_id']; ?>" value="<?php echo $row['product_id']; ?>">
                                    <tr class="record">
                                        <td><?php echo $row['product_name']; ?></td>
                                        <td><input readonly style="border: transparent" name="<?php echo $row['product_id']; ?>[qty]" id="qty<?php echo $row['product_id']; ?>" value="<?php echo $row['qty']; ?>"></td>
                                        <td><input name="<?php echo $row['product_id']; ?>[qtyR]" id="qtyR<?php echo $row['product_id']; ?>" oninput="calculateAmount(<?php echo $row['product_id']; ?>)" style="border: transparent"></td>
                                        <td><input readonly style="border: transparent" name="<?php echo $row['product_id']; ?>[o_price]" id="o_price<?php echo $row['product_id']; ?>" value="<?php echo $row['o_price']; ?>"></td>
                                        <td><input readonly style="border: transparent" name="<?php echo $row['product_id']; ?>[price]" id="price<?php echo $row['product_id']; ?>" value="<?php echo $row['price']; ?>"></td>
                                        <td>$<input style="border: transparent" name="<?php echo $row['product_id']; ?>[amount]" id="amount<?php echo $row['product_id']; ?>"></td>
                                        <td>$<input style="border: transparent" name="<?php echo $row['product_id']; ?>[profit]" id="profit<?php echo $row['product_id']; ?>" onchange="sumProfit(<?php echo $row['product_id']; ?>)"></td>
                                    </tr>
                            <?php
                                }
                            } ?>
                            <tr>
                                <th colspan="5"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
                                <td colspan="1"><strong style="font-size: 12px; color: #222222;">
                                        <p id="totalAmount">0</p>
                                    </strong></td>
                                <td colspan="1"><strong style="font-size: 12px; color: #222222;">
                                        <p id="totalProfit">0</p>
                                </td>
                                <th></th>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <button type="submit" class="btn btn-success btn-large btn-block"><i class="icon icon-save icon-large"></i> SAVE</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>
<script>
    // Restricts input for the given textbox to the given inputFilter.
    /*function setInputFilter(textbox, inputFilter, errMsg) {
      ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(function(event) {
        textbox.addEventListener(event, function(e) {
          if (inputFilter(this.value)) {
            // Accepted value
            if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
              this.classList.remove("input-error");
              this.setCustomValidity("");
            }
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } else if (this.hasOwnProperty("oldValue")) {
            // Rejected value - restore the previous one
            this.classList.add("input-error");
            this.setCustomValidity(errMsg);
            this.reportValidity();
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
          } else {
            // Rejected value - nothing to restore
            this.value = "";
          }
        });
      });
    }

    setInputFilter(document.getElementById("intTextBox1"), function(value) {
      return /^-?\d*$/.test(value); }, "Must be an integer");

      setInputFilter(document.getElementById("intTextBox2"), function(value) {
      return /^-?\d*$/.test(value); }, "Must be an integer");

      setInputFilter(document.getElementById("intTextBox3"), function(value) {
      return /^-?\d*$/.test(value); }, "Must be an integer");*/
    var total = [];

    function sumAmount(id) {

        var amountInput = document.getElementById('amount' + id);
        //console.log(input.id);
        total[id] = amountInput.value;
        // console.log(total);
        var sum = 0
        total.forEach((element, x) => {
            var a = parseFloat(element);
            if (element == "") {
                a = 0;
            }
            sum += a;
        });
        document.getElementById("totalAmount").innerHTML = sum;

    }
    var totalP = [];

    function sumProfit(id) {

        var profitInput = document.getElementById('profit' + id);
        //console.log(input.id);
        totalP[id] = profitInput.value;
        var sumProfit = 0;
        totalP.forEach((element) => {
            //console.log(element);
            var b = parseFloat(element);
            if (element == "") {
                b = 0;
            }
            sumProfit += b;
        });
        document.getElementById("totalProfit").innerHTML = sumProfit;

    }

    function calculateAmount(id) {
        var quantityRemaining = document.getElementById('qtyR' + id).value;
        var price = document.getElementById('price' + id).value;
        var startingQty = document.getElementById('qty' + id).value;

        var Qtysold = startingQty - quantityRemaining;

        var totalAmount = Qtysold * price;

        document.getElementById('amount' + id).value = totalAmount;
        sumAmount(id);
        calculateProfit(id);


    }

    function calculateProfit(id) {
        var quantityRemaining = document.getElementById('qtyR' + id).value;
        var Oprice = document.getElementById('o_price' + id).value;
        var startingQty = document.getElementById('qty' + id).value;

        var Qtysold = startingQty - quantityRemaining;;

        var totalAmount = Qtysold * Oprice;

        document.getElementById('profit' + id).value = document.getElementById('amount' + id).value - totalAmount;
        sumProfit(id);

    }
</script>

</html>