<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database="project-3";
// Create connection-->

$conn = new mysqli($servername, $username, $password);

// Check connection-->
$conn = new mysqli($servername, $username, $password, $database);
// Check connection-->
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../CSS/HomeStyle.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../@fortawesome/fontawesome-free/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/cart.css">
    <link rel="stylesheet" href="../@fortawesome/fontawesome-free/css/all.min.css">

</head>
<body >
<?php include 'navbar.php'?>
    <br>
    <br>
</div>


<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h6>My Cart</h6>
                <hr>

                <?php
                $total=0;
                $count=0;
                if (isset($_SESSION['username'])) {
                    $userid = $_SESSION['id'];
                    if (isset($_POST['save'])) {
                        $q = $_POST['quantity'];
                        $id = $_POST['product_id'];
                        $price = $_POST['product_price'];
                        $sql = " UPDATE order_details SET quantity = '$q' WHERE order_details.device_id = $id && user_id =$userid";
                        $conn->query($sql);
                    }
                    if (isset($_POST['remove'])) {
                        $id = $_POST['product_id'];
                        echo "<script>alert('Product has been Removed...!')</script>";

                        $sql = "DELETE FROM order_details WHERE  device_id=$id && user_id =$userid";
                        $conn->query($sql);
                    }

                    $sql = "SELECT * from order_details where user_id =$userid ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {

                            $count++;
                            $img = $row["img"];
                            $id = $row["device_id"];
                            $name = $row["name"];
                            $price = $row["price"];
                            $totalprice = $row["total_price"];
                            $q = $row["quantity"];
                            $total += $totalprice;
                            cartElement($img, $name, $price, $id, $q);
                            echo "<br>";
                        }

                    } //                }

                    else {
                        echo "<h5>Cart is Empty</h5>";
                    }
                }
                ?>

            </div>
        </div>

    </div>
</div>

<div style="margin-left:700px; margin-bottom: 100px;">
    <?php
    $e=" <form action=\"checkout.php\" method=\"post\">
     <button id=\"checkout\" type='submit' style=\"border-radius: 5px;\" class=\" col-md-2 col-sm-4 my-3 my-md-0 btn-success\" name=\"checkout\"><i class=\"fa-regular fa-circle-check\"></i> Checkout</button>
 <input type='hidden' name='total' value='$total'>
 <input type='hidden' name='count' value='$count'>

</form> 
 
 ";
    echo $e;

    ?>
</div>

<?php

function cartElement($img, $name, $price, $id,$q){

    $element = "
<form action=\"cart.php\" method=\"post\">
    <div class=\"border rounded\">
    <div class=\"row bg-white\">
    <div class=\"col-md-3 pl-0\">
    <img src=$img alt=\"\" class=\"img-fluid\">
    </div>
    <div class=\"col-md-6\">
        <h5 class=\"pt-2\">$name</h5>
        <small class=\"text-secondary\">Seller: dailytuition</small>
        <h5 class=\"pt-2\">$$price</h5>
        <td><input class=\"w-25 p1-1\" value=\"$q\" name='quantity' type=\"number\"</td>
        <button type='submit' class=\"btn btn-warning\" name=\"save\">Save</button>
        <button type='submit' class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
        <input type='hidden' name='product_id' value='$id'>
        <input type='hidden' name='product_price' value='$price'>
        <input type='hidden' name='product_name' value='$name'>
        <input type='hidden' name='product_image' value='$img'>
        
      
    </div>
    </div>
    </div>
</form>
";
    echo $element;
}

?>

<script src="../jquery/dist/jquery.slim.min.js"> </script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

