<?php
ob_start();
session_start();
include 'functions.php';
include 'adminNav.php';
$nav ='';
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
if(isset($_SESSION['username'])){  // if logged in no need to show page
    $pageTitle='Members';
    include 'init.php';

    if( isset( $_GET['do'] ) ){

        $do= $_GET['do'];

    } else {
        $do = 'Manage';
    }

    if($do == 'Manage'){
        $sql = "SELECT * FROM checkouts";
        $result = $conn->query($sql);


        ?>


        <h1 class="text-center"> Manage Orders </h1>
        <div class="container">
            <div class="table-responsive">
                <table class="main-table table text-center table-bordered">
                    <tr>
                        <td> ID </td>
                        <td> UserID </td>
                        <td> Address </td>
                        <td> Phone </td>
                        <td> Final Price  </td>
                        <td> Paying Method  </td>
                        <td> Code  </td>
                        <td> Control </td>
                    </tr>

                    <?php
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' .$row['c_id'].'</td>';
                        echo '<td>' .$row['user_id'].'</td>';
                        echo '<td>' .$row['u_address'].' </td>';
                        echo '<td>' .$row['u_phone'].'</td>';
                        echo '<td>' .$row['totalprice'].'</td>';
                        echo '<td>' .$row['paying_method'].'</td>';
                        echo '<td>' .$row['code'].'</td>';
                        echo '<td> ';
                         if($row['checking_status'] ==1 ){
                             echo '  <a href="orders.php?do=Delete&orderid=' .$row['c_id']. '" class="btn btn-danger confirm"><i class="fa fa-close"> </i>&nbsp;Delete </a>';
                         }


                        if($row['checking_status'] == 0){
                            echo '<a href="orders.php?do=Approve&orderid=' .$row['c_id']. '" class="btn btn-info activate"><i class="fa fa-check"> </i>&nbsp; Approve  </a>';
                            echo '<a href="orders.php?do=Delete&orderid=' .$row['c_id']. '" class="btn btn-danger confirm"><i class="fa fa-close"> </i>&nbsp; Cancel </a>';
                        }
                        echo '</td>';

                        echo '<tr>';
                    }
                    ?>

                </table>
            </div>


        </div>

        <?php
//manage page

    }
    elseif ($do == 'Delete'){

        //edit page
        echo "<h1 class='text-center'>Delete Order </h1>";
        echo "<div class='container'> ";

        $orderid =  isset($_GET['orderid'])&& is_numeric($_GET['orderid']) ? intval($_GET['orderid']):0;


        // $stmt = $con -> prepare("SELECT * FROM users WHERE userID = ? LIMIT 1 ");

        $check= checkItem('c_id' , 'checkouts' ,$orderid );

        // if record is found the count will be incremented , if no record => count =0

        if($check>0) {
            $sql = "DELETE FROM checkouts WHERE c_id = $orderid";
            $conn->query($sql);


            $theMsg= "<div class='alert alert-success'>". ' Record Deleted </div>';

            redirectHome($theMsg);
        }else{

            $theMsg= '<div class="alert alert-danger"> This ID does not exit </div>';
            redirectHome($theMsg,'back');

        }
        echo "</div> ";

    }elseif($do=='Approve') {

        echo "<h1 class='text-center'>Approve Order </h1>";

        echo "<div class='container'> ";

        $orderid = isset($_GET['orderid']) && is_numeric($_GET['orderid']) ? intval($_GET['orderid']) : 0;


        // $stmt = $con -> prepare("SELECT * FROM users WHERE userID = ? LIMIT 1 ");

        $check = checkItem('c_id', 'checkouts', $orderid);

        // if record is found the count will be incremented , if no record => count =0

        if ($check > 0) {
            $sql = "UPDATE checkouts SET checking_status = 1 WHERE c_id = $orderid";
            $conn->query($sql);

            $theMsg = "<div class='alert alert-success'>" . ' Record Approved </div>';

            redirectHome($theMsg,'back');
        } else {

            $theMsg = '<div class="alert alert-danger"> This ID does not exit </div>';
            redirectHome($theMsg);
        }
        echo "</div> ";
    }


 }
else{
    header('Location: index.php');
    exit();
}

ob_end_flush();