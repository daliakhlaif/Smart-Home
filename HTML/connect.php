<?php
$dsn = 'mysql:host=localhost;dbname=project-3';
$user = 'root';
$pass = '';
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',

);

try{
    $con = new PDO($dsn,$user,$pass,$option);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//    echo 'You are Connected Welcome to Database';

}
catch (PDOException $e){
    echo 'Failed to Connect'. $e->getMessage();
}
