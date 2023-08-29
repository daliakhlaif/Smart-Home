<?php
session_start();
require_once('component.php');
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
<script type="text/javascript" src="page1.js"></script>
<div class="navbar navbar-expand-md fixed-top navbar-light bg-light">

    <a class="navbar-brand" href="home.php" id="logo-nav"><img src="../images/logo.png" alt="smart-house-blue-logo" width="80px" height="60px"> </a>


    <div class="collapse navbar-collapse" id="myMenu">

        <ul class="navbar-nav" id="first-list-nav">

            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width: 300px">
                <button class="search-btn">Search</button>
            </form>

            <li class="nav-item" id="item1-nav"><a class="nav-link" href="#"> Home </a></li>

            <li class="nav-item dropdown"><a id="prod-menu" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Product </a>

                <ul class="dropdown-menu" aria-labelledby="prod-menu">

                    <li> <a onclick="<?php echo $var=2?>" class="dropdown-item" href="products.php?var=<?php echo $var?>" id="lights"> Lights </a></li>
                    <li> <a onclick="<?php echo $var=8?>" class="dropdown-item" href="products.php?var=<?php echo $var?>" id="sensor" > Sensors </a></li>
                    <li> <a onclick="<?php echo $var=5?>" class="dropdown-item" href="products.php?var=<?php echo $var?>"  id="smarttv"> Smart TVs </a></li>
                    <li> <a onclick="<?php echo $var=1?>" class="dropdown-item" href="products.php?var=<?php echo $var?>"  id="security"> Security Cameras </a></li>
                    <li> <a onclick="<?php echo $var=3?>" class="dropdown-item" href="products.php?var=<?php echo $var?>"  id="heating"> Heating </a></li>
                    <li> <a onclick="<?php echo $var=4?>" class="dropdown-item" href="products.php?var=<?php echo $var?>"  id="cleaner"> Smart Cleaners </a></li>
                    <li> <a onclick="<?php echo $var=6?>" class="dropdown-item" href="products.php?var=<?php echo $var?>"  id="speaker"> Speakers </a></li>
                    <li> <a onclick="<?php echo $var=7?>" class="dropdown-item" href="products.php?var=<?php echo $var?>"  id="detectors"> Smoke Detectors </a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="#"> About </a></li>
            <li class="nav-item"><a class="nav-link" href="#"> Support </a></li>

        </ul>
    </div>
    <a  class="nav-icon" href="#" id="nav-icon1"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
        </svg> </a>

    <a class="nav-icon " href="#"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
        </svg></a>

    <a class="nav-icon" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </svg></a>
    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#myMenu" aria-controls="#myMenu" aria-expanded="false" aria-label="toggle-navigation"> <span class="navbar-toggler-icon"> </span></button>
    <br>
    <br>
    <br>
</div>
<br>
<br>
<br>
<section id="cart-container" class="container my-5">
    <table width="100%">
        <thead>
        <tr>
            <td>Remove</td>
            <td>Image</td>
            <td>Product</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Total</td>
        </tr>
        </thead>
        <tbody>
        <?php
//        $img1="../images/71Hy6nLTJOL._AC_UL480_FMwebp_QL65_.jpg";
//        $img2="../images/617WJ8jajaS._AC_UY327_QL65_.jpg";
//
//        $sql="INSERT INTO order_details (id ,name ,product_price ,product_image ,quantity ,total_price) VALUES('1','4','1','$img2','1','4')";
//        $conn->query($sql);

        $sql = "SELECT * from order_details ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $img=$row["product_image"] ;
                echo"
                <tr>
            <td><a href=\"#\"><i class=\"fas fa-trash-alt\"></i></a></td>
            <td><img src=$img alt=\"\"></td>
            <td><t5>Handbag Fringilla</t5></td>
            <td><h5>$65</h5></td>
            <td><input class=\"w-25 p1-1\" value=\"1\" type=\"number\" </td>
            <td><h5></h5></td>
        </tr>";

            }
        } else {
            echo "0 results";
        }
        ?>

        </tbody>
    </table>
</section>




<script src="../jquery/dist/jquery.slim.min.js"> </script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

