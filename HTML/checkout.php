<?php
//include 'navbar.php';
session_start();
require_once('component.php');

$servername = "localhost";
$username = "root";
$password = "";
$database="project-3";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_SESSION['username'])) {

    $userid = $_SESSION['id'];
    $total=0;
    $count=0;
    if(isset($_POST['checkout'])) {
        $total = $_POST['total'];
        $count = $_POST['count'];
    }

    if(isset($_POST['submit'])){
        $count=$_POST['products'];
        if($count!=0) {
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $totalprice = $_POST['grand_total'];
            $payingmethod = $_POST['paymentMethod'];
            $code = $_POST['coupon'];
            if($code==null)$code='0';
            $sql = "INSERT INTO checkouts (c_id ,user_id ,u_address ,u_phone ,totalprice ,checking_status ,paying_method ,code) VALUES(default ,'$userid','$address','$phone','$totalprice','0','$payingmethod','$code')";
            $conn->query($sql);
            $sql = "DELETE FROM order_details  WHERE user_id  =$userid";
            $conn->query($sql);
        }else{
            echo "<script>alert('Your Cart is Empty!')</script>";}

    }
}else{
    echo "<script>alert('you should log in')</script>";
    echo"<script>window.location.href=\"index.php?var=0\"</script>";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../@fortawesome/fontawesome-free/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../CSS/cart.css">

    <style>

        body {
            background-image: url('../images/smart-home-upgrades-with-high-ROI.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .input-icons i {
            position: absolute;
        }

        .input-icons {
            width: 100%;
            margin-bottom: 10px;
        }

        .icon {
            padding: 15px;
            min-width: 40px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            text-indent: 25px;
        }
    </style>
</head>
<body >
<a class="navbar-brand" href="home.php" id="logo-nav"><img src="../images/logo.png" alt="smart-house-blue-logo" width="80px" height="60px"> </a>

<div class="container" style="background-color: rgba(255,255,255,0.7); width: 500px; margin-top: 50px">
    <div class="row justify-content-center">
        <div class="col-lg-6 px-4 pb-4" id="order" style="width: 100%">
            <h4 class="text-center text-info p-2">Complete your order!</h4>
            <div class="jumbotron p-3 mb-2 text-center">
                <h6 class="lead"><b>Products count : </b><?= $count; ?></h6>
                <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
                <h5><b>Total Amount Payable : </b>$<?= number_format($total,2) ?></h5>
            </div>
            <form  action="checkout.php" method="post" id="placeOrder">
                <input type="hidden" name="products" value="<?= $count; ?>">
                <input type="hidden" name="grand_total" value="<?= $total; ?>">
                <div class="input-icons">
                    <i class="fa-solid fa-user icon"></i> <input  type="text" name="name" class="form-control input-field" placeholder="Enter Name" required>
                </div>
                <br>
                <div class="input-icons">
                    <i class="fa-solid fa-envelope icon"></i> <input type="email" name="email" class="form-control input-field" placeholder="Enter E-Mail" required>
                </div>
                <br>
                <div class="input-icons" >
                    <i class="fa-solid fa-phone icon"></i>  <input type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}||[0-9]{3}[0-9]{3}[0-9]{3}" name="phone" class="form-control input-field" placeholder="Enter Phone" required>
                </div>
                <br>
                <div class="input-icons">
                    <i class="fa-solid fa-location-dot icon"></i><textarea name="address" class="form-control input-field" rows="3" cols="10" placeholder="Enter Delivery Address Here..." required></textarea>
                </div>
                <br>
                <h6 class="text-center lead">Select Payment Mode</h6>
                <div >

                    <input type="radio" onclick="fun('no');"id="cash" name="paymentMethod" value="cash">
                    <label for="cash">Cash on Delivery</label>&emsp;
                    <input type="radio"  onclick="fun('yes');" id="creditCart" name="paymentMethod" value="creditCart">
                    <label for="creditCart">Cedit Cart</label><br>
                    <div class="input-icons" id="couponDiv" style="display: none">
                        <i class="fa-brands fa-cc-amazon-pay icon"></i> <input type="text" id='coupon' class="form-control input-field" name="coupon" placeholder="Coupon Code">
                    </div>
                </div>
                <br>
                <div>
                    <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">


                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function fun(par) {
        if(par=='yes') {
            document.getElementById('couponDiv').style.display = 'block';
            document.getElementById('coupon').setAttribute("required", "");
            }
        else {
            document.getElementById('couponDiv').style.display = 'none';

        }

    }
</script>
</body>
</html>