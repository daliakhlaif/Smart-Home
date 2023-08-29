<?php
session_start();
include 'functions.php';
include 'adminNav.php';
$nav='';

ob_start();

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
if (isset($_SESSION['username'])) {

    $pageTitle = 'Items';
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') {
        $sql = "SELECT * FROM device";
        $result = $conn->query($sql);


        ?>


        <h1 class="text-center"> Manage Devices </h1>
        <div class="container">
            <div class="table-responsive">
                <table class="main-table table text-center table-bordered">
                    <tr>
                        <td> ID </td>
                        <td> Name </td>
                        <td> Description </td>
                        <td> Price </td>
                        <td> Image </td>
                        <td> Control </td>

                    </tr>

                    <?php
                    while($item = $result->fetch_assoc()) {
                        echo '<tr style="height=5px; width=30px" >';
                        echo '<td>' .$item['id'].'</td>';
                        echo '<td>' .$item['d_name'].'</td>';
                        echo '<td>' .$item['d_desc'].' </td>';
                        echo '<td>' .$item['d_price'].'</td>';
                        echo '<td > <img src="'.$item['d_img'].'" style="height=25%; width:25%"> ' .'</td>';
                        echo '<td> 
                                     <a href="items.php?do=Edit&itemid=' .$item['id']. '" class=" btn btn-success " ><i class="fa fa-edit"> </i> &nbsp;Edit  </a>
                                     <a href="items.php?do=Delete&itemid=' .$item['id']. '" class="btn btn-danger confirm"><i class="fa fa-close"> </i>&nbsp;Delete </a>';


                        echo '</td>';

                        echo '<tr>';
                    }
                    ?>

                </table>
            </div>
            <a href="items.php?do=Add" class="btn btn-primary"> <i class="fa fa-plus"> </i> &nbsp New Device</a>

        </div>

        <?php


    } elseif ($do == 'Add') {
        ?>

        <h1 class="text-center"> Add New Item </h1>
        <div class="container">

            <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="name" class="form-control"    placeholder="Name of Product">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="description" class="form-control"   placeholder="Add description">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="price" class="form-control"    placeholder="Product Price">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="file" name="img" class="form-control"    placeholder="Image of Product">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-10 col-md-6">
                        <select id="catID" name="category" class="form-control" >
                            <option value="0">...</option>
                            <?php
                            $sql = "SELECT * FROM categories";
                            $stmt2 = $conn->query($sql);
                            while ($cat = $stmt2->fetch_assoc()) {
                                echo '<option value="'.$cat['id'].' ">'. $cat['name'].'</option>';
                            }

                            ?>
                        </select>

                    </div>
                </div>


                </br>
                <div class="form-group form-group-sm">
                    <div class="col-sm-offset-2 col-sm-10 col-md-6">
                        <input type="submit" value="Add Item" class="btn btn-primary btn-sm">
                    </div>
                </div>


            </form>

        </div>




  <?php
    } elseif ($do == 'Insert') {

        echo "<h1 class='text-center'> Add Item </h1>";
        echo "<div class='container'> ";

        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

            $name  =$_POST['name'];
            $desc  =$_POST['description'];
            $price =$_POST['price'];
            $img_name = $_FILES["img"]["name"];
            $img   ='../images/'.$img_name;
            $catID =$_POST['category'];


            $formErrors = array();
            // form validation

            if(empty($name)){
                $formErrors[] ='Name cant be empty ';

            }if(empty($price)){
                $formErrors[] ='Price cant be empty ';

            }
            if(empty($img)){
                $formErrors[] ='Image cant be empty ';


            }


            foreach ($formErrors as $error){
                echo '<div class="alert alert-danger">' . $error . '</div> </br>';
            }


            if(empty($formErrors)){
                $sql = "INSERT INTO device(d_name,d_img, d_price,d_desc, cat_id  ) VALUES ('$name','$img','$price','$desc','$catID')";
                $result = $conn->query($sql);


                    $theMsg= "<div class='alert alert-success'>"  . ' Record Inserted </div>';
                    redirectHome($theMsg,'back');


            }



        }else{
            echo '<div class="container"> ';
            $theMsg= '<div class="alert alert-danger"> Sorry You Can not browse this page Directly </div>';
            redirectHome($theMsg);
            echo '</div>';
        }

        echo "</div>";

    } elseif ($do == 'Edit') {

        $itemid =  isset($_GET['itemid'])&& is_numeric($_GET['itemid']) ? intval($_GET['itemid']):0;
        $sql = "SELECT * FROM device WHERE id =$itemid";
        $result = $conn->query($sql);
        $item=$result->fetch_assoc();
        if($result->num_rows >0){


        ?>

        <h1 class="text-center"> Edit Item </h1>
        <div class="container">

            <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="itemid" value="<?php echo $itemid?>">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="name" class="form-control"  value="<?php echo $item['d_name']; ?>" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>

                    <div class="col-sm-10 col-md-6">

                        <input type="text" name="description" class="form-control"  value="<?php echo $item['d_desc']; ?>" >

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="price" class="form-control"   value="<?php echo $item['d_price']; ?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="file" name="img" class="form-control"  accept="image/*" value="<?php echo $item['d_img']; ?>"  >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-10 col-md-6">
                        <select name="category" class="form-control">
                        <option value="0">...</option>
                        <?php
                        $sql = "SELECT * FROM categories";
                        $stmt2 = $conn->query($sql);
                        while ($cat = $stmt2->fetch_assoc()) {
                            echo '<option value="'.$cat['id'].' ">'. $cat['name'].'</option>';
                        }

                        ?>
                        </select>
                    </div>
                </div>
                </br>
                <div class="form-group form-group-sm">
                    <div class="col-sm-offset-2 col-sm-10 col-md-6">
                        <input type="submit" value="Save changes" class="btn btn-primary btn-sm">
                    </div>
                </div>


            </form>

        </div>

        <?php }

    } elseif ($do == 'Update') {

        echo "<h1 class='text-center'>Update Item </h1>";

        echo "<div class='container'> ";

        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $itemid =$_POST['itemid'];
            $name  =$_POST['name'];
            $desc  =$_POST['description'];
            $price =$_POST['price'];
            $catID =$_POST['category'];

             $img = '../images/'. $_FILES['img']['name'];
            if($img=='../images/'){
                $sql = "SELECT d_img FROM device where id=$itemid ";
                $stmt2 = $conn->query($sql);
                $row = $stmt2->fetch_assoc();
                $img=$row["d_img"];

            }

            $formErrors = array();
            // form validation

            if(empty($name)){
                $formErrors[] ='Name cant be empty ';
            }if(empty($price)){
                $formErrors[] ='Price cant be empty ';
            }
            if(empty($img)){
                $formErrors[] ='Image cant be empty ';

            }


            foreach ($formErrors as $error){
                echo '<div class="alert alert-danger">' . $error . '</div> </br>';
            }

            if(empty($formErrors)){
                $sql = "UPDATE device SET d_name = '$name', d_img ='$img' , d_price = '$price', d_desc= '$desc', cat_id ='$catID' where id=$itemid";
                $stmt2 = $conn->query($sql);

                $theMsg= "<div class='alert alert-success'>"  . ' Record Updated </div>';
                redirectHome($theMsg,'back');
            }


        }
        else{

            $theMsg= ' <div class="alert alert-danger"> Sorry You Cant browse this page Directly </div>';
            redirectHome($theMsg);
        }

        echo "</div>";

    } elseif ($do == 'Delete') {
        echo "<h1 class='text-center'>Delete Device </h1>";
        echo "<div class='container'> ";

        $itemid =  isset($_GET['itemid'])&& is_numeric($_GET['itemid']) ? intval($_GET['itemid']):0;


        // $stmt = $con -> prepare("SELECT * FROM users WHERE userID = ? LIMIT 1 ");

        $check= checkItem('id' , 'device' ,$itemid );

        // if record is found the count will be incremented , if no record => count =0

        if($check>0) {

            $sql = "DELETE FROM device WHERE id = $itemid";
            $stmt2 = $conn->query($sql);


            $theMsg= "<div class='alert alert-success'>" . ' Record Deleted </div>';

            redirectHome($theMsg);
        }else{

            $theMsg= '<div class="alert alert-danger"> This ID does not exit </div>';
            redirectHome($theMsg);

        }
        echo "</div> ";



    }

} else {
    header('Location: index.php');
    exit();
}

ob_end_flush();