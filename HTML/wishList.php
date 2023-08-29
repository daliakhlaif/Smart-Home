<?php
session_start();
//$var=$_GET['var'];
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
<body>

<?php
include 'navbar.php';
?>


<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h6>My WishList</h6>
                <hr>

                <?php

                if ( isset($_SESSION['username'])){
                    $userid = $_SESSION['id'];
                    if (isset($_POST['save'])) {
                        $id = $_POST['product_id'];
                        $name = $_POST['product_name'];
                        $img = $_POST['product_image'];
                        $price = $_POST['product_price'];
                        $sql = "SELECT * FROM order_details where user_id =$userid";
                        $result = $conn->query($sql);
                        $n = "false";
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                if ($row["device_id"] == $id) {
                                    $n = "true";
                                    break;
                                }
                            }

                            if ($n == "true") {
                                echo "<script>alert('Product is already added in the cart..!')</script>";
                            } else {
                                echo "<script>alert(\"Added sucessfully\")</script>";
                                $sql = "INSERT INTO order_details (order_id,user_id ,device_id  ,name ,price ,img ,quantity) VALUES(default ,'$userid','$id','$name','$price','$img','1')";
                                $conn->query($sql);
                            }
                        } else {
                            echo "<script>alert(\"Added sucessfully\")</script>";
                            $sql = "INSERT INTO order_details (order_id,user_id ,device_id  ,name ,price ,img ,quantity) VALUES(default ,'$userid','$id','$name','$price','$img','1')";
                            $conn->query($sql);
                        }
                    }

                    if (isset($_POST['remove'])) {
                        $id = $_POST['product_id'];
                        echo "<script>alert('Product has been Removed...!')</script>";
//    echo "<script>window.location = 'cart.php'</script>";
                        $sql = "DELETE FROM wishlist WHERE product_id =$id && user_id =$userid";
                        $conn->query($sql);
                        $sql = " UPDATE device SET  wish  ='../images/gheart.png' WHERE id = $id";
                        $conn->query($sql);
                    }


                    $sql = "SELECT * from wishlist where user_id=$userid ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $img = $row["img"];
                            $id = $row["product_id"];
                            $name = $row["name"];
                            $price = $row["price"];
                            wishelement($img, $name, $price, $id);
                            echo "<br>";
                        }

                    }

                }

    ?>
</div>

<?php
function wishelement($productimg, $productname, $productprice, $productid){

    $element = "
<form action=\"wishList.php?var=print\" method=\"post\">
    <div class=\"border rounded\">
    <div class=\"row bg-white\">
    <div class=\"col-md-3 pl-0\">
    <img src=$productimg alt=\"\" class=\"img-fluid\">
    </div>
    <div class=\"col-md-6\">
        <h5 class=\"pt-2\">$productname</h5>
        <small class=\"text-secondary\">Seller: dailytuition</small>
        <h5 class=\"pt-2\">$$productprice</h5>
        <button type='submit' class=\"btn btn-warning\" name=\"save\">Add to cart</button>
        <button type='submit' class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
        <input type='hidden' name='product_id' value='$productid'>
        <input type='hidden' name='product_price' value='$productprice'>
        <input type='hidden' name='product_name' value='$productname'>
        <input type='hidden' name='product_image' value='$productimg'>

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
