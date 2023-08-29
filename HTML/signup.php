<?php
session_start();
include "functions.php";
include "init.php";
$noNavbar='';// this page doesn't have navigation bar
$nav='';
$pageTitle='SignUp';
$noFoot='';
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


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $user =$_POST['user'];
    $pass1 = $_POST['pass'];
    $pass2 = $_POST['pass2'];
    $check = checkItem('username','users',''.$user);

    if($check == 1){

        $theMsg= " <div class='alert alert-danger'> user already exists </div>";
        redirectHome($theMsg ,'back');

    }
    else {
        if ($pass1 == $pass2) {

            $hashPass = sha1($pass1);
            $sql = "INSERT INTO users(userID,username, email, fullname, password,groupID,date,regStatus) VALUES (default ,'$user','$email','$name','$hashPass','0', now(),'0')";
            $conn->query($sql);
            header('Location: home.php');
        } else {
            echo '<script>alert("Confirm Password") </script>';
        }
    }
}

?>
<link rel="stylesheet" type="text/css" href="../CSS/backend.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../@fortawesome/fontawesome-free/css/all.min.css">
<script src="../jquery/dist/jquery.slim.min.js"> </script>
<form class="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h4 class="text-center">Sign Up</h4>
    <input type="text" class="form-control"  name="user" placeholder="Username" autocomplete = "off">
    <input type="password" class="form-control "  name="pass" placeholder="Password" autocomplete = "off">
    <input type="password" class="form-control "  name="pass2" placeholder="Password" autocomplete = "off">
    <input type="email" class="form-control"  name="email" placeholder="Email Address" autocomplete = "off">
    <input type="text" class="form-control"  name="fullname" placeholder="Full Name" autocomplete = "off">

    <input class="btn btn-primary w-100" type="submit" value="login">
    <p class="text-center">Already have an account? <a href="index.php?var=0"> &nbsp Sign In </a> </p>


</form>
