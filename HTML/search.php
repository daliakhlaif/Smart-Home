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
$text="";
if (isset($_POST['add'])) {

    if (isset($_SESSION['username'])) {
        $userid=$_SESSION['id'];
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
        echo"<script>window.location.href=\"cart.php\"</script>";
    }else{
        echo "<script>alert('you should log in')</script>";
        echo"<script>window.location.href=\"index.php?var=0\"</script>";
    }

}


//                }

else if (isset($_POST['wish'])) {
    if (isset($_SESSION['username'])) {
        $productid = $_POST['product_id'];
        $sql = "SELECT d_name,d_img, d_price ,id,wish FROM device WHERE id=$productid";
        $result = $conn->query($sql);
        $userid=$_SESSION['id'];
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            if ($row = mysqli_fetch_assoc($result)) {
                $productid = $row['id'];
                $name = $row['d_name'];
                $img = $row['d_img'];
                $price = $row['d_price'];
                $wish = $row['wish'];
                if ($wish == "../images/gheart.png") {
                    $sql = "INSERT INTO wishlist (id,user_id,product_id ,name ,price ,img) VALUES(default ,'$userid','$productid','$name','$price','$img')";
                    $conn->query($sql);
                    $sql = " UPDATE device SET  wish  ='../images/nheart.png' WHERE id = $productid";
                    $conn->query($sql);
                } else {
                    $sql = "DELETE FROM wishlist WHERE id=$productid";
                    $conn->query($sql);
                    $sql = " UPDATE device SET  wish  ='../images/gheart.png' WHERE id = $productid";
                    $conn->query($sql);
                }
            }
        } else {
            echo "0 results";

        }
        echo"<script>window.location.href=\"wishlist.php\"</script>";
    } else {
        echo "<script>alert('you should log in')</script>";
        echo "<script>window.location.href=\"index.php?var=0\"</script>";
    }
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../CSS/HomeStyle.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../@fortawesome/fontawesome-free/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'?>
<div  id=" main" class=" container-fluid home " style="height:100%; width:80%; margin-left: 20px;">
<div class="row text-center py-5" id="div1" style="margin-top:100px;" >

    <?php


    if(isset($_POST['search'])) {
        $text = $_POST['searchText'];
        $sql = "SELECT * from device  ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $img=$row["d_img"] ;
                $id=$row["id"] ;
                $name=$row["d_name"] ;
                $price=$row["d_price"] ;
                $wish=$row["wish"];
                if(stripos($name, $text) !== false){
                    searh($id,$name,$img,$price,$wish,$text);
                }

            }

        }
    }

    ?>
</div>
</div>



<?php

echo"    <link rel='stylesheet' type='text/css' href='../CSS/search.css'>";
function  searh($productid,$productname, $productimg, $productprice,$wish,$text)
{
    $url = $_SERVER['REQUEST_URI'];
    $element = "
   
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                <form action='$url' method=\"post\" style='display: inline-block;' >
                    <div class=\"shadow  box \">

                        <div>

                            <img src=\"$productimg\" alt=\"Image1\" class=\" card-img-top product-feature-box\" height='230px'>
                            
                        </div>
                        <div style='width: 230px;' >
                      
                            <h6>$productname</h6>
                            
                            <h6>
                                <span>$$productprice</span>
                            </h6>
                            <button type='submit' id=\"button\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"  ></i></button>
                            <button type='submit' name=\"wish\" style='border: none; background-color: white'><img id=\"$productid\" src=\"$wish\" class=\" circle marginleft\" height=\"5px\" width=\"5px\"></button>

                            <input type='hidden' name='product_id' value='$productid'>
                            <input type='hidden' name='product_image' value='$productimg'>
                            <input type='hidden' name='product_name' value='$productname'>
                            <input type='hidden' name='product_price' value='$productprice'>
                            <input type='hidden' name='wish' value='$wish'>
                            <input type='hidden' name='text' value='$text'>
                           
                            </div>
                        
                        
                    </div>
                </form>
            </div>
    ";
    echo $element;

}
?>

<script src="../jquery/dist/jquery.slim.min.js"> </script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
