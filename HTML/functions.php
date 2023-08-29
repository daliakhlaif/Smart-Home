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

function getTitle()
{
    global $pageTitle;

    if (isset($pageTitle)) {

        echo $pageTitle;


    } else {
        echo 'Default';
    }
}
//redirect function : this function accepts parameters
// $theMsg = echo the  message
//$seconds = seconds before redirecting

    function redirectHome( $theMsg ,$url =null, $seconds = 3 ){
    if($url == null){
        $url='index.php';

    }else{
        $url= isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER']!==''?$url = $_SERVER['HTTP_REFERER'] : $url='index.php';

    }
        echo $theMsg;

        echo '<div class="alert alert-info">You will be redirected to'. $url. ' after ' .  $seconds . '</div>';
        header("refresh: $seconds; url= $url");
        exit();

    }

//function to check items in databse
// $select = the item to select
//$from=the table to select from
//$value
    function checkItem($select , $from , $value){

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

        $sql = "SELECT $select FROM $from where $select ='$value'";
        $result = $conn->query($sql);
        return $result->num_rows;

    }
function countItems($item,$table){

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
    $sql = "SELECT $item FROM $table";
    $result = $conn->query($sql);
    return $result->num_rows;
}

function getLatest( $latestUsers)
{

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "project-3";

// Create connection
    $conn = new mysqli($servername, $username, $password);

// Check connection
    $conn = new mysqli($servername, $username, $password, $database);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM users ORDER BY userID desc";
    $result = $conn->query($sql);
//                      $theLatest = getLatest("*","users","userID", $latestUsers);
    if ($result->num_rows > 0) {
        while($latestUsers>'0') {
            $row = $result->fetch_assoc();
            echo '<li> ' . $row["username"] . '  <a href="members.php?do=Edit&userid=' . $row ["userID"] . '" >';

            echo '<span class="btn btn-success pull-right"> <i class="fa fa-edit"> </i>';

            echo 'Edit';

            if ($row["regStatus"] == 0) {

                echo '<a href="members.php?do=Activate&userid=' . $row["userID"] . '" class="btn btn-info pull-right activate"><i class="fa fa-close"> </i>&nbsp; Activate  </a>';

            }

            echo '</span>';
            echo '</a> ';
            echo ' </li>';
            $latestUsers-='1';
        }
    }
}
//echo"    <link rel='stylesheet' type='text/css' href='../CSS/productsStyle.css'>";
//function  component($productid,$productname, $productimg, $productprice){
//    $url= $_SERVER['REQUEST_URI'];
//    $element = "
//
//    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
//                <form action='$url' method=\"post\" style='display: inline-block;'>
//                    <div class=\"card shadow description cart\" style='margin: 10px; margin-left: 10px;' >
//
//                        <div>
//
//                            <img src=\"$productimg\" alt=\"Image1\" class=\" card-img-top product-feature-box\" height='230px'>
//
//                        </div>
//                        <div class=\"card-text \" >
//
//                            <h6 class=\"card-title  h6\">$productname</h6>
//
//                            <h6>
//                                <span class=\"price h6\">$$productprice</span>
//                            </h6>
//                            <button type='submit' id=\"button\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"  ></i></button>
//
//                            <input type='number' name='quantity' value='1' class='form-control my-sm-3'>
//                            <input type='hidden' name='product_id' value='$productid'>
//                            <input type='hidden' name='product_image' value='$productimg'>
//                            <input type='hidden' name='product_name' value='$productname'>
//                            <input type='hidden' name='product_price' value='$productprice'>
//                            <input type='hidden' name='wish' value='$wish'>
//                            </div>
//
//
//                    </div>
//                </form>
//            </div>
//    ";
//    echo $element;
//}
//
//function wishelement($productimg, $productname, $productprice, $productid){
//?>
<!--    <link rel='stylesheet' type='text/css' href='../../../theme/css/productStyle.css'>-->
<?php
//    $element = "
//<form action=\"wishList.php?var=print\" method=\"post\">
//    <div class=\"border rounded\">
//    <div class=\"row bg-white\">
//    <div class=\"col-md-3 pl-0\">
//    <img src=$productimg alt=\"\" class=\"img-fluid\">
//    </div>
//    <div class=\"col-md-6\">
//        <h5 class=\"pt-2\">$productname</h5>
//        <small class=\"text-secondary\">Seller: dailytuition</small>
//        <h5 class=\"pt-2\">$$productprice</h5>
//        <button type='submit' class=\"btn btn-warning\" name=\"save\">Add to cart</button>
//        <button type='submit' class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
//        <input type='hidden' name='product_id' value='$productid'>
//        <input type='hidden' name='product_price' value='$productprice'>
//        <input type='hidden' name='product_name' value='$productname'>
//        <input type='hidden' name='product_image' value='$productimg'>
//
//    </div>
//    </div>
//    </div>
//</form>
//";
//    echo $element;
//
//}