<?php
include 'functions.php';
ob_start();
session_start();
include 'adminNav.php';
$nav='';
$noFoot='';
$pageTitle='Categories';
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


if(isset($_SESSION['username'])){

    include 'init.php';

    $do =isset($_GET['do'] )? $_GET['do']:'Manage';


    if($do == 'Manage'){
        $sort ='ASC';

        $sort_array = array('ASC','DESC');

        if(isset($_GET['sort'])&& in_array($_GET['sort'],$sort_array)){
            $sort =$_GET['sort'];
        }
        $sql ="SELECT * FROM categories ORDER BY ordering $sort";
        $stmt2 = $conn->query($sql);

        $cats = $stmt2->fetch_assoc();
        ?>


        <h1 class="text-center">Manage Categories </h1>
        <div class="container categories">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Categories
                    <div class="ordering pull-right">
                        Ordering:
                        <a class="<?php if($sort=='ASC'){echo 'active';}?>" href="?sort=ASC">Asc </a> |
                        <a class="<?php if($sort=='DESC'){echo 'active';}?>" href="?sort=DESC">Desc</a>

                    </div>
                </div>

                <div class="panel-body">
                    <?php
                    while ($cat = $stmt2->fetch_assoc()) {
                        echo '<div class="cat"> ';
                        echo '<div class="hidden-buttons">';
                        echo '<a href="categories.php?do=Edit&catid=' .$cat['id'] .'    " class="btn btn-xs btn-primary"><i class="fa fa-edit"> </i>Edit</a> ';
                        echo '<a href="categories.php?do=Delete&catid=' .$cat['id'] .'    "  class="confirm btn btn-xs btn-danger"><i class="fa fa-close"> </i>Delete</a> ';

                        echo  '</div>';

                        echo '<h3>'. $cat['name'].'</h3>';
                        echo '<p>'; if ($cat['des'] ==''){
                            echo 'This category has no description';

                        }else{
                            echo $cat['des'] ;
                        }
                        echo'</p>' ;
                        if($cat['visibility']==0) {
                            echo '<span class="visibility">'.'Hidden '.'</span>';}

                        if($cat['allow_comment']==0) {
                            echo '<span class="comments">'.'Comments Disabled'.'</span>';}
                        if($cat['allow_ads']==0) {
                            echo '<span class="ads">'.'Ads Disabled '.'</span>';}

                        echo '</div> ';
                        echo '<hr>';
                    }
                    ?>

                </div>
            </div>
<!--            <a class=" add-cat btn btn-primary" href="categories.php?do=Add"> <i class="fa fa-plus"> </i>Add New Category </a>-->
        </div>
        <?php
    }



    elseif ($do=='Edit'){
        //edit page
        $catid =  isset($_GET['catid'])&& is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

        $sql = "SELECT * FROM categories WHERE id = $catid ";
        $stmt=$conn->query($sql);
        $cat= $stmt->fetch_assoc();



        if($stmt->num_rows > 0){
            ?>

            <h1 class="text-center"> Edit Category </h1>
            <div class="container">

                <form class="form-horizontal" action="?do=Update" method="POST">
                    <input type="hidden" name="id" value="<?php echo $catid?> ">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="name" class="form-control" required="required" placeholder="Name of Category" value="<?php  echo $cat['name']?> ">
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="description" class="form-control" placeholder="Describe Category" value="<?php  echo $cat['des']?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-sm-2 control-label">Ordering </label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="ordering" class="form-control" placeholder="For Your Profile" value="<?php  echo $cat['ordering']?>">
                        </div>
                    </div>




                    <div class="form-group form-group-sm">
                        <label class="col-sm-2 control-label">Visible</label>
                        <div class="col-sm-10 col-md-6">
                            <div>
                                <input id="vis-yes" type="radio" name="visibility" value="0" <?php if($cat['visibility']==0){echo 'checked';}?>>
                                <label for="vis-yes">Yes </label>
                            </div>
                            <div>
                                <input id="vis-no" type="radio" name="visibility" value="1" <?php if($cat['visibility']==1){echo 'checked';}?>>
                                <label for="vis-no">No </label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-sm-2 control-label">Allow Commenting</label>
                        <div class="col-sm-10 col-md-6">
                            <div>
                                <input id="com-yes" type="radio" name="commenting" value="0" <?php if($cat['allow_comment']==0){echo 'checked';}?>>
                                <label for="com-yes">Yes </label>
                            </div>
                            <div>
                                <input id="com-no" type="radio" name="commenting" value="1" <?php if($cat['allow_comment']==1){echo 'checked';}?>>
                                <label for="com-no">No </label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-sm-2 control-label">Allow Ads</label>
                        <div class="col-sm-10 col-md-6">
                            <div>
                                <input id="ads-yes" type="radio" name="ads" value="0" <?php if($cat['allow_ads']==0){echo 'checked';}?>>
                                <label for="ads-yes">Yes </label>
                            </div>
                            <div>
                                <input id="ads-no" type="radio" name="ads" value="1" <?php if($cat['allow_ads']==0){echo 'checked';}?>>
                                <label for="ads-no">No </label>
                            </div>

                        </div>
                    </div>
                    </br>
                    <div class="form-group form-group-sm">
                        <div class="col-sm-offset-2 col-sm-10 col-md-6">
                            <input type="submit" value="Save Changes" class="btn btn-primary btn-lg">
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

        echo "<h1 class='text-center'>Update Category </h1>";
        echo "<div class='container'> ";

        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

            $id    =$_POST['id'];
            $name  =$_POST['name'];
            $desc = $_POST['description'];
            $order =$_POST['ordering'];
            $vis =  $_POST['visibility'];
            $com =  $_POST['commenting'];
            $ad =   $_POST['ads'];
            $sql = "UPDATE categories SET  name= '$name', des= '$desc',ordering = '$order', visibility= '$vis', allow_comment= '$com', allow_ads= '$ad' WHERE id = '$id'";
            $conn->query($sql);



            $theMsg= "<div class='alert alert-success'>"  . ' Record Updated </div>';
            redirectHome($theMsg,'back');



        }
        else{

            $theMsg= ' <div class="alert alert-danger"> Sorry You Cant browse this page Directly </div>';
            redirectHome($theMsg);
        }

        echo "</div>";


    }
    elseif ($do == 'Delete'){
        echo "<h1 class='text-center'>Delete Category </h1>";
        echo "<div class='container'> ";

        $id =  isset($_GET['catid'])&& is_numeric($_GET['catid']) ? intval($_GET['catid']):0;


        // $stmt = $con -> prepare("SELECT * FROM users WHERE userID = ? LIMIT 1 ");

        $check= checkItem('id' , 'categories' , $id );

        // if record is found the count will be incremented , if no record => count =0

        if($check>0) {
            $sql = "DELETE FROM categories WHERE id = $id";
            $conn->query($sql);

            $theMsg= "<div class='alert alert-success'>"  . ' Record Deleted </div>';

            redirectHome($theMsg, 'back');
        }else{

            $theMsg= '<div class="alert alert-danger"> This ID does not exit </div>';
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

?>