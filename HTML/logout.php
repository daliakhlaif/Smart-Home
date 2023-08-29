<?php
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
$sql = " UPDATE device SET  wish  ='../images/gheart.png'";
$conn->query($sql);
session_start();  //start session
session_unset(); //unset the session
session_destroy(); //destroy the session
header('Location: home.php');
exit();

?>