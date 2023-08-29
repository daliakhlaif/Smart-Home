<?php
session_start();

$var = $_GET['var'];
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


$noNavbar='';// this page doesn't have navigation bar
$nav='';
$pageTitle='Login';

if(isset($_SESSION['username']) && $_SESSION['groupID']==1){              // if already logged in no need to show page
    header('Location: dashboard.php');  // redirect to home page

}elseif (isset($_SESSION['username']) && $_SESSION['groupID']==0){
    header('Location: home.php');
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $hashedPass = sha1($password);
    $v= $_POST['var'];
    // check if user exists in database
    $sql = "SELECT userID, username, password, groupID FROM users WHERE username='$username' && password='$hashedPass'";
    $result = $conn->query($sql);

       // if record is found the count will be incremented , if no record => count =0

    // if count >0 this means the database contains record about this user

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;

        $_SESSION['id'] = $row['userID'];

        if( $row['groupID'] == 1 ){

            header('Location: dashboard.php');

            $_SESSION['groupID']= 1;

        }elseif( $row['groupID'] == 0 ){
           if($v==0)
               header('Location: home.php');
           else echo"<script>window.location.href=\"products.php?var=$v\"</script>";

            $_SESSION['groupID']= 0;

        }

    }else{
        echo"<script>window.location.href=\"index.php?var=$v\"; alert('Wrong username or password')</script>";

    }
}
?>
    <link rel="stylesheet" type="text/css" href="../CSS/backend.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../@fortawesome/fontawesome-free/css/all.min.css">
    <script src="../jquery/dist/jquery.slim.min.js"> </script>
<form class="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h4 class="text-center">Login</h4>
    <input type="text" class="form-control"  name="user" placeholder="Username" autocomplete = "off">
    <input type="password" class="form-control "  name="pass" placeholder="Password" autocomplete = "off">
    <input class="btn btn-primary w-100" type="submit" value="login">
    <p class="text-center">Don't have an account? <a href="signup.php"> &nbsp Sign up </a> </p>
    <input type="hidden"   name="var" value=<?php echo"$var";?>>

</form>



<?php

?>