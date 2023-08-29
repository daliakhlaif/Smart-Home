<?php
session_start();
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
if(isset($_SESSION['id']) ) {

    $id = $_SESSION['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $msg = $_POST['msg'];

        $sql = "INSERT INTO feedback (msg, u_id, msg_date, status) VALUES('$msg' ,'$id',now(), '0')";
        $conn->query($sql);

    }
}
else{
    echo "<script>alert('you should log in')</script>";
    echo"<script>window.location.href=\"index.php?var=0\"</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../@fortawesome/fontawesome-free/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../images/istockphoto-999671402-170667a.jpg');
            background-repeat: no-repeat;
            background-attachment:fixed;
            background-size:100% 100%;
            font-family: "Times New Roman";
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
<body>
<div class="container" style="background-color: rgba(255,255,255,0.7); width: 500px; margin-top: 50px">
    <div class="row justify-content-center">
        <div class="col-lg-6 px-4 pb-4" id="order" style="width: 100%">
            <div class="jumbotron p-3 mb-2 text-center input-icons">
                 <h1 class="lead input-field"><b>Contact our advisors</b></h1>
            </div>
            <form  action="contact.php" method="post" id="send">


                <div class="input-icons" >
                    <i class="fa-solid fa-phone icon"></i>  <input type="tel" name="phone" class="form-control input-field" placeholder="Enter Phone">
                </div>
                <br>
                <div class="input-icons">

                    <i class="fa-solid fa-message icon"></i><textarea name="msg" class="form-control input-field" rows="3" cols="10" placeholder="Enter Your message Here..." required></textarea>

                </div>
                <br>
                <div>
                    <input type="submit" name="submit" value="Send" class="btn btn-warning btn-block" style="margin-left: 400px;">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../jquery/dist/jquery.slim.min.js"> </script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>