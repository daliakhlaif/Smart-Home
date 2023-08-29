<?php
ob_start();
session_start();
include 'adminNav.php';
$nav ='';
$noFoot='';
$servername = "localhost";
$username = "root";
$password = "";
$database="project-3";
include 'functions.php';
include 'init.php';
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
       $query ='';

       if(isset($_GET['page']) && $_GET['page'] == 'Pending'){
           $query='AND regStatus =0 ';
       }
        $sql = "SELECT * FROM users WHERE groupID !=1 $query";
        $result = $conn->query($sql);


        ?>


        <h1 class="text-center"> Manage Members </h1>
        <div class="container">
            <div class="table-responsive">
                <table class="main-table table text-center table-bordered">
                    <tr>
                      <td> ID </td>
                      <td> Username </td>
                      <td> Email </td>
                      <td> Name </td>
                      <td> Registered Date </td>
                      <td> Control </td>
                    </tr>

                    <?php
                    while($row = $result->fetch_assoc()) {
                          echo '<tr>';
                          echo '<td>' .$row['userID'].'</td>';
                          echo '<td>' .$row['username'].'</td>';
                          echo '<td>' .$row['email'].' </td>';
                          echo '<td>' .$row['fullname'].'</td>';
                          echo '<td>' .$row['date'].'</td>';
                          echo '<td> 
                                     <a href="members.php?do=Edit&userid=' .$row['userID']. '" class=" btn btn-success " ><i class="fa fa-edit"> </i> &nbsp;Edit  </a>
                                     <a href="members.php?do=Delete&userid=' .$row['userID']. '" class="btn btn-danger confirm"><i class="fa fa-close"> </i>&nbsp;Delete </a>';

                                if($row['regStatus'] == 0){
                                   echo '<a href="members.php?do=Activate&userid=' .$row['userID']. '" class="btn btn-info activate"><i class="fa fa-check"> </i>&nbsp; Activate  </a>';
                                }
                                echo '</td>';

                          echo '<tr>';
                      }
                    ?>

                </table>
            </div>

            <a href="members.php?do=Add" class="btn btn-primary"> <i class="fa fa-plus"> </i> &nbsp New Member</a>
        </div>

<?php
//manage page

    }elseif ($do=='Add'){
        //Add members page
        ?>

        <h1 class="text-center"> Add Member </h1>
        <div class="container">

            <form class="form-horizontal" action="?do=Insert" method="POST">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="username" class="form-control" autocomplete="off"  required="required" placeholder="Username to Login">
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="email" name="email" class="form-control"required="required" placeholder="Valid Email Address">
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10 col-md-6">

                         <input type="password"  name="password" class="password form-control" autocomplete="password" placeholder="Complex Password" required="required" >
                         <i class="show-pass fa fa-eye fa-2x"> </i>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-sm-2 control-label">Full Name </label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="fullname" class="form-control" placeholder="For Your Profile" required="required">
                    </div>
                </div>
                </br>
                <div class="form-group form-group-sm">
                    <div class="col-sm-offset-2 col-sm-10 col-md-6">
                        <input type="submit" value="Add Member" class="btn btn-primary btn-lg">
                    </div>
                </div>

            </form>

        </div>

        <?php

    }elseif ($do =='Insert'){

        echo "<h1 class='text-center'> Add Member </h1>";
        echo "<div class='container'> ";

        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

            $pass  =$_POST['password'];
            $user  =$_POST['username'];
            $email =$_POST['email'];
            $name  =$_POST['fullname'];


            $hashPass = sha1($_POST['password']);

            $formErrors = array();
            // form validation

            if(strlen($user)<4){
                $formErrors[] =' username cant be less than <strong> 4 characters</strong> ';

            }if(strlen($user)>20){
                $formErrors[] ='  username cant be more than <strong> 20 characters</strong> ';

            }
            if(empty($user)){
                $formErrors[] ='  username cant be <strong>empty</strong>';


            }
            if(empty($pass)){
                $formErrors[] ='  password cant be <strong>empty</strong>';


            }
            if(empty($name)){
                $formErrors[] ='  full name cant be <strong>empty</strong> ';

            }if(empty($email)){
                $formErrors[] ='  email cant be <strong>empty</strong>  ';

            }

            foreach ($formErrors as $error){
                echo '<div class="alert alert-danger">' . $error . '</div> </br>';
            }


            if(empty($formErrors)){
                //check if user exists in database
                $check = checkItem('username','users',''.$user);

                if($check == 1){

                    $theMsg= " <div class='alert alert-danger'> user already exists </div>";
                    redirectHome($theMsg ,'back');

                }
                else{
                    $sql = "INSERT INTO users(username, email, fullname, password,date,regStatus) VALUES('$user' ,'$email','$name','$hashPass',now(),1)";
                    $conn->query($sql);

                    $theMsg= "<div class='alert alert-success'>"  . ' Record Inserted </div>';
                    redirectHome($theMsg,'back');
                }


            }



        }else{
            echo '<div class="container"> ';
            $theMsg= '<div class="alert alert-danger"> Sorry You Can not browse this page Directly </div>';
            redirectHome($theMsg,'back');
            echo '</div>';
        }

        echo "</div>";
    }

    elseif ($do=='Edit'){

        //edit page

        $userid =  isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']):0;
        $sql = "SELECT * FROM users WHERE userID =$userid  LIMIT 1";
        $result = $conn->query($sql);

        $row=$result->fetch_assoc();

        $count =$result->num_rows;   // if record is found the count will be incremented , if no record => count =0

        if($count>0){
            ?>

            <h1 class="text-center"> <?php if ($_SESSION['id']==6 | $_SESSION['id']==7) echo 'My Profile'; else echo 'Edit Member'; ?>  </h1>
            <div class="container">

                <form class="form-horizontal" action="?do=Update" method="POST">
                    <input type="hidden" name="userid" value="<?php echo $userid?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="username" class="form-control" autocomplete="off" value="<?php echo $row['username']?>" required="required">
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="email" name="email" class="form-control" value="<?php echo $row['email']?>" required="required">
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="hidden" name="oldpassword" value="<?php echo $row['password']?>">
                            <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="leave it blank if you don't want to change">
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-sm-2 control-label"> Full Name </label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="fullname" class="form-control" value="<?php echo $row['fullname']?>"required="required">
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <div class="col-sm-offset-2 col-sm-10 col-md-6">
                            <input type="submit" value="Save" class="btn btn-primary btn-lg">
                        </div>
                    </div>

                </form>

            </div>


            <?php
        }
        else{

            echo '<div class="container">';
            $theMsg= '<div class="alert alert-danger"> there is no such id </div>';
            redirectHome($theMsg);
            echo '</div>';
        }

    }   elseif ($do=='Update'){

        echo "<h1 class='text-center'>Update Members </h1>";
        echo "<div class='container'> ";

        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

            $id    =$_POST['userid'];
            $user  =$_POST['username'];
            $email =$_POST['email'];
            $name  =$_POST['fullname'];

            $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] :  sha1($_POST['newpassword']);


            $formErrors = array();
            // form validation

            if(strlen($user)<4){
                $formErrors[] =' username cant be less than <strong> 4 characters</strong> ';

            }if(strlen($user)>20){
                $formErrors[] ='  username cant be more than <strong> 20 characters</strong> ';

            }
            if(empty($user)){
                $formErrors[] ='  username cant be <strong>empty</strong>';


            }if(empty($name)){
                $formErrors[] ='  full name cant be <strong>empty</strong> ';

            }if(empty($email)){
                $formErrors[] ='  email cant be <strong>empty</strong>  ';

            }

            foreach ($formErrors as $error){
                echo '<div class="alert alert-danger">' . $error . '</div> </br> ';
            }

            if(empty($formErrors)){
                $sql = "UPDATE users SET username = '$user', email = '$email', fullname = '$name', password = '$pass' WHERE userID = '$id'";
                $conn->query($sql);
                $theMsg= "<div class='alert alert-success'>". ' Record Updated </div>';
                redirectHome($theMsg,'back');
            }


        }
        else{

            $theMsg= ' <div class="alert alert-danger"> Sorry You Cant browse this page Directly </div>';
            redirectHome($theMsg);
        }

        echo "</div>";
    }
    elseif ($do == 'Delete'){

        //edit page
        echo "<h1 class='text-center'>Delete Member </h1>";
        echo "<div class='container'> ";

        $userid =  isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']):0;


        // $stmt = $con -> prepare("SELECT * FROM users WHERE userID = ? LIMIT 1 ");

        $check= checkItem('userID' , 'users' ,$userid );

        // if record is found the count will be incremented , if no record => count =0

        if($check>0) {
            $sql = "DELETE FROM checkouts  WHERE user_id ='$userid'";
            $conn->query($sql);
            $sql = "DELETE FROM order_details  WHERE user_id   ='$userid'";
            $conn->query($sql);
            $sql = "DELETE FROM wishlist   WHERE user_id   ='$userid'";
            $conn->query($sql);
            $sql = "DELETE FROM feedback WHERE u_id ='$userid'";
            $conn->query($sql);
            $sql = "DELETE FROM users WHERE userID ='$userid'";
             $conn->query($sql);

            $theMsg= "<div class='alert alert-success'>" . ' Record Deleted </div>';

            redirectHome($theMsg);
        }else{

            $theMsg= '<div class="alert alert-danger"> This ID does not exit </div>';
            redirectHome($theMsg);

        }
        echo "</div> ";

    }elseif($do=='Activate') {

        echo "<h1 class='text-center'>Activate Member </h1>";

        echo "<div class='container'> ";

        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;


        // $stmt = $con -> prepare("SELECT * FROM users WHERE userID = ? LIMIT 1 ");

        $check = checkItem('userID', 'users', $userid);

        // if record is found the count will be incremented , if no record => count =0

        if ($check > 0) {
            $sql = "UPDATE users SET regStatus = 1 WHERE userID ='$userid'";
            $conn->query($sql);


            $theMsg = "<div class='alert alert-success'>" . ' Record Activated </div>';

            redirectHome($theMsg);
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
