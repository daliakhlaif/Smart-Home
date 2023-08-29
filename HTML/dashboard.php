<?php
ob_start();
session_start();
include 'adminNav.php';
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
include 'functions.php';
if(isset($_SESSION['username'])){

    $pageTitle='Dashboard';

    $latestUsers = 5 ;

?>
    <link rel="stylesheet" type="text/css" href="../CSS/backend.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../@fortawesome/fontawesome-free/css/all.min.css">
    <script src="../jquery/dist/jquery.slim.min.js"> </script>
        <div class="container home-stat text-center">
         <h1 class="text-center"> Dashboard </h1>
           <div class="row">
             <div class="col-md-3">
                 <div class="stat st-members">
                     <i class="fa fa-users"></i>
                   <div class="info">
                       Total Members
                       <span> <a href="members.php"><?php echo countItems('userID','users')?> </a></span>
                   </div>
                 </div>

             </div>
               <div class="col-md-3 ">
                   <div class="stat st-pending">
                       <i class="fa fa-user-plus"> </i>
                       <div class="info">
                           Pending Members
                           <span><a href="members.php?do=Manage&page=Pending"><?php echo checkItem("regStatus","users",0)?> </a></span>
                       </div>

                   </div>
               </div>
               <div class="col-md-3 ">
                   <div class="stat st-item"">
                   <i class="fa fa-tags"></i>
                   <div class="info">
                       Total Items
                       <span><a href="items.php"><?php echo countItems('id','device')?> </a></span>
                   </div>
                   </div>

               </div>
            <div class="col-md-3 ">
                <div class="stat st-order"">
                <i class="fa fa-shipping-fast"></i>
                <div class="info">
                    Total Orders
                    <span><a href="orders.php"><?php echo countItems('c_id','checkouts')?> </a></span>
                </div>
            </div>

        </div>
               <div class="col-md-3 ">
                   <div class="stat st-comments">
                       <i class="fa fa-comments"> </i>
                       <div class="info">
                           Total Comments
                           <span><a href="messages.php"><?php echo countItems('msg_id','feedback')?> </a></span>
                       </div>
                   </div>
               </div>

             </div>
           </div>
        </div>
    <div class="container latest">
        <div class="row">
            <div class="col-md-6">
             <div class="panel panel-group">
                <div class="panel-heading">

                <i class="fa fa-users"> </i>  Latest <?php echo $latestUsers ?> Registered Users
                </div>
                 <div class="panel-body">
                     <ul class="list-unstyled latest-users">
                  <?php
                  getLatest($latestUsers);
                   ?>
                     </ul>
                 </div>
             </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-group">
                    <div class="panel-heading">
                        <i class="fa fa-message"> </i> Latest Comments
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled latest-users">
                            <?php
                            $sql = "SELECT * FROM feedback";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $u_id = $row['u_id'];

                                    $sql = "SELECT username FROM users WHERE userID=$u_id";
                                    $name = $conn->query($sql);
                                    $n= $name->fetch_assoc();
                                    echo '<li> ' . $n["username"] . ' : ' . $row["msg"] . '</li>';
                                }
                            }


                            ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php


}
else{

    header('Location: index.php');
    exit();
}
ob_end_flush();
?>
