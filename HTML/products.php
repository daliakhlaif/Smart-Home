<?php
$var=$_GET['var'];
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

    $userid=$_SESSION['id'];
    $sql = "SELECT product_id from wishlist where user_id=$userid ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $id = $row["product_id"];
            $sql = " UPDATE device SET  wish  ='../images/nheart.png' WHERE id = $id";
            $conn->query($sql);
        }

    }
}
//        echo "Connected successfully";
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
    }else{
    echo "<script>alert('you should log in')</script>";
        echo"<script>window.location.href=\"index.php?var=$var\"</script>";
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
    } else {
        echo "<script>alert('you should log in')</script>";
        echo "<script>window.location.href=\"index.php?var=$var\"</script>";
    }
}

?>



<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" type="text/css" href="../CSS/product.css">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../@fortawesome/fontawesome-free/css/all.min.css">

<!--    &lt;!&ndash;&#45;&#45;===== Boxicons CSS ===== &ndash;&gt;-->
<!--    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>-->

    <!--<title>Dashboard Sidebar Menu</title>-->
</head>
<body onload="change('<?php echo $var;?>') " style="height: 100%;">

<nav class="sidebar close">
    <header>
        <div class="image-text">
                <span class="image">
                   <a href="home.php"><img src="../images/logo.png" alt=""> </a>
                </span>

            <div class="text logo-text">
                <span class="name">Smart House</span>
<!--                <span class="profession">Web developer</span>-->
            </div>
        </div>

        <i class='fa fa-circle-chevron-left toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <?php
            $sql = "SELECT * FROM categories ORDER BY ordering ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $img = $row['img'];
                    $catid = $row['id'];
                    $name = $row['name'];

                    echo '<li class="">
                          <a href="products.php?var='.$catid.'">
                          <i><img src='.$img.' alt='.$name.' width="40px height="30px" ></i>
                          <span class="text nav-text " style="margin-left: 5px;">'.$name.'</span>
                          </a>
                          </li>';

                }
            }
            ?>


        </div>

        <div class="bottom-link">
            <li class="">
                <a href="wishList.php?var=print">
                    <i class='fas fa-heart icon' ></i>
                    <span class="text nav-text">WishList</span>
                </a>
            </li>
            <li>
                <a href="cart.php">
                    <i class='fas fa-shopping-cart icon' ></i>
                    <span class="text nav-text">Shopping Cart</span>
                </a>
            </li>


        </div>
    </div>

</nav>

<div class=" container-fluid home " style="height:100%; width:80%;">
    <div class="row text-center py-5 " id="prod-area" >
<!--        --><?php
//
//
//
//        // Get rows (products) from database and display using component function
//        $sql = "SELECT d_name,d_img, d_price FROM device";
//        $result = $conn->query($sql);
//
//        if ($result->num_rows > 0) {
//            // output data of each row
//            while($row = $result->fetch_assoc()) {
//                component($row["id"],$row["d_name"],$row["d_img"],$row["d_price"],$row["d_desc"]);
//
//            }
//        } else {
//            echo "0 results";
//        }
//
//        ?>
    </div>


</div>

<div class="row text-center py-5" id="div1" style="display: none">
    <?php



    // Get rows (products) from database and display using component function
    $sql = "SELECT d_name,d_img, d_price,id,wish FROM device WHERE cat_id='1'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            component($row["id"],$row["d_name"],$row["d_img"],$row["d_price"],$row["wish"]);

        }
    } else {
        echo "0 results";
    }

    ?>
</div>
<div class="row text-center py-5" id="div2" style="display: none">
    <?php



    // Get rows (products) from database and display using component function
    $sql = "SELECT d_name,d_img, d_price,id,wish FROM device WHERE cat_id='2'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            component($row["id"],$row["d_name"],$row["d_img"],$row["d_price"],$row["wish"]);

        }
    } else {
        echo "0 results";
    }

    ?>
</div>
<div class="row text-center py-5" id="div3" style="display: none">
    <?php



    // Get rows (products) from database and display using component function
    $sql = "SELECT d_name,d_img, d_price ,id,wish FROM device WHERE cat_id='3'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            component($row["id"],$row["d_name"],$row["d_img"],$row["d_price"],$row["wish"]);

        }
    } else {
        echo "0 results";
    }

    ?>
</div>
<div class="row text-center py-5" id="div4" style="display: none">
    <?php



    // Get rows (products) from database and display using component function
    $sql = "SELECT d_name,d_img, d_price ,id,wish FROM device WHERE cat_id='4'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            component($row["id"],$row["d_name"],$row["d_img"],$row["d_price"],$row["wish"]);

        }
    } else {
        echo "0 results";
    }

    ?>
</div>
<div class="row text-center py-5" id="div5" style="display:none;">
    <?php



    // Get rows (products) from database and display using component function
    $sql = "SELECT d_name,d_img, d_price,id,wish FROM device WHERE cat_id='5'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            component($row["id"],$row["d_name"],$row["d_img"],$row["d_price"],$row["wish"]);

        }
    } else {
        echo "0 results";
    }

    ?>
</div>
<div class="row text-center py-5" id="div6" style="display: none">
    <?php



    // Get rows (products) from database and display using component function
    $sql = "SELECT d_name,d_img, d_price ,id,wish FROM device WHERE cat_id='6'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            component($row["id"],$row["d_name"],$row["d_img"],$row["d_price"],$row["wish"]);

        }
    } else {
        echo "0 results";
    }

    ?>
</div>
<div class="row text-center py-5" id="div7" style="display: none">
    <?php



    // Get rows (products) from database and display using component function
    $sql = "SELECT d_name,d_img, d_price ,id,wish FROM device WHERE cat_id='7'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            component($row["id"],$row["d_name"],$row["d_img"],$row["d_price"],$row["wish"]);

        }
    } else {
        echo "0 results";
    }

    ?>
</div>
<div class="row text-center py-5" id="div8" style="display: none">
    <?php



    // Get rows (products) from database and display using component function
    $sql = "SELECT d_name,d_img, d_price ,id,wish FROM device WHERE cat_id='8'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            component($row["id"],$row["d_name"],$row["d_img"],$row["d_price"],$row["wish"]);

        }
    } else {
        echo "0 results";
    }

    ?>

</div>

<script>
    const body = document.querySelector('body'),
          sidebar = body.querySelector('nav'),
          toggle = body.querySelector(".toggle"),
          searchBtn = body.querySelector(".search-box"),
          modeText = body.querySelector(".mode-text");


    toggle.addEventListener("click" , () =>{
        sidebar.classList.toggle("close");

    })

    searchBtn.addEventListener("click" , () =>{
        sidebar.classList.remove("close");
    })
    function change(n){

        if(n==1) {document.getElementById("prod-area").innerHTML=document.getElementById("div1").innerHTML;}
        if(n==2) {document.getElementById("prod-area").innerHTML=document.getElementById("div2").innerHTML;}
        if(n==3) {document.getElementById("prod-area").innerHTML=document.getElementById("div3").innerHTML;}
        if(n==4) {document.getElementById("prod-area").innerHTML=document.getElementById("div4").innerHTML;}
        if(n==5) {document.getElementById("prod-area").innerHTML=document.getElementById("div5").innerHTML;}
        if(n==6) {document.getElementById("prod-area").innerHTML=document.getElementById("div6").innerHTML;}
        if(n==7) {document.getElementById("prod-area").innerHTML=document.getElementById("div7").innerHTML;}
        if(n==8) {document.getElementById("prod-area").innerHTML=document.getElementById("div8").innerHTML;}

    }
</script>

<script src="../jquery/dist/jquery.slim.min.js"> </script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>




