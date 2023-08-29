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
    $pageTitle='Comments';
    include 'init.php';

    if( isset( $_GET['do'] ) ){

        $do= $_GET['do'];

    } else {
        $do = 'Manage';
    }

    if($do == 'Manage'){

        $sql = "SELECT * FROM feedback";
        $result = $conn->query($sql);

        ?>


        <h1 class="text-center"> Manage Messages </h1>
        <div class="container">
            <div class="table-responsive">
                <table class="main-table table text-center table-bordered">
                    <tr>
                        <td> ID </td>
                        <td> Comment </td>
                        <td> Added Date </td>
                        <td> Username </td>
                        <td> Control </td>
                    </tr>

                    <?php
                    while($row = $result->fetch_assoc()) {
                        $id=$row['u_id'];
                        $sql = "SELECT username FROM users WHERE userID=$id";
                        $stmt3 = $conn->query($sql);
                         $name= $stmt3->fetch_assoc();

                        echo '<tr>';
                        echo '<td>' .$row['msg_id'].'</td>';
                        echo '<td>' .$row['msg'].'</td>';
                        echo '<td>' .$row['msg_date'].' </td>';
                        echo '<td>' .$name['username'].'</td>';
                        echo '<td> 
                                     
                                     <a href="messages.php?do=Delete&comid=' .$row['msg_id']. '" class="btn btn-danger confirm"><i class="fa fa-close"> </i>&nbsp;Delete </a>';

                        if($row['status'] == 0){
                            echo '<a href="messages.php?do=Approve&comid=' .$row['msg_id']. '" class="btn btn-info activate"><i class="fa fa-check"> </i>&nbsp; Approve  </a>';
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
        echo "<h1 class='text-center'>Delete Message </h1>";
        echo "<div class='container'> ";

        $comid =  isset($_GET['comid'])&& is_numeric($_GET['comid']) ? intval($_GET['comid']):0;

        $check= checkItem('msg_id' , 'feedback' ,$comid );

        if($check>0) {
            $sql = "DELETE FROM feedback WHERE msg_id =$comid";
            $stmt = $conn->query($sql);

            $theMsg= "<div class='alert alert-success'>". ' Record Deleted </div>';

            redirectHome($theMsg);
        }else{

            $theMsg= '<div class="alert alert-danger"> This ID does not exit </div>';
            redirectHome($theMsg ,'back');

        }
        echo "</div> ";

    }elseif($do=='Approve') {

        echo "<h1 class='text-center'>Approve Message </h1>";

        echo "<div class='container'> ";

        $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;


        // $stmt = $con -> prepare("SELECT * FROM users WHERE userID = ? LIMIT 1 ");

        $check = checkItem('msg_id', 'feedback', $comid);

        // if record is found the count will be incremented , if no record => count =0

        if ($check > 0) {
            $sql = "UPDATE feedback SET status = 1 WHERE msg_id=$comid";
            $stmt = $conn->query($sql);


            $theMsg = "<div class='alert alert-success'>"  . ' Message Approved </div>';

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
