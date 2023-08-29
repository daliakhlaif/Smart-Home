<?php
session_start();
include 'functions.php';
$servername = "localhost";
$username = "root";
$password = "";
$database="project-3";
// Create connection-->

$conn = new mysqli($servername, $username, $password);

// Check connection-->
$conn = new mysqli($servername, $username, $password, $database);
// Check connection-->
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$noNavbar ='';
include 'init.php';

$userid =  isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']):0;
$id=$_SESSION['id'];
$sql = "SELECT * FROM users WHERE userID = $id LIMIT 1 ";
$stmt = $conn->query($sql);


$row=$stmt->fetch_assoc();

$do =$_GET['do'];


?>
<h1 class="text-center"> <?php echo $_SESSION['username']?>'s Profile </h1>
<div class="container">

    <form class="form-horizontal" action="?do=Update" method="POST">
        <input type="hidden" name="userid" value="<?php echo $_SESSION['id']?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10 col-md-6">
                <input type="text" name="username" class="form-control" autocomplete="off" value="<?php echo $_SESSION['username']?>" required="required">
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
                <input type="submit" value="Save Changes" class="btn btn-primary btn-lg">
            </div>
        </div>

    </form>

</div>

<?php
if($do == 'Update'){
    echo "<h1 class='text-center'>Update Profile </h1>";
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
            $stmt = $conn->query($sql);

            $_SESSION['username']=$user;

            $theMsg= "<div class='alert alert-success'>" . ' Profile Updated </div>';
            redirectHome($theMsg,'back');
        }


    }


    echo "</div>";
}


