<?php
$var=0;

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
static $url="index.php?var=0";
if (isset($_SESSION['username'])) {
    $id = $_SESSION['id'];
    $url="profile.php?do=Edit&userid=<?php echo $id ?>";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/HomeStyle.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../@fortawesome/fontawesome-free/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<!--<script type="text/javascript" src="page1.js"></script>-->

<div class="navbar navbar-expand-md fixed-top navbar-light bg-light">

    <a class="navbar-brand" href="home.php" id="logo-nav"><img src="../images/logo.png" alt="smart-house-blue-logo" width="80px" height="60px"> </a>


    <div class="collapse navbar-collapse" id="myMenu">

        <ul class="navbar-nav" id="first-list-nav">

            <form action="search.php" method="post" class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" autocomplete = "off" name="searchText"aria-label="Search" style="width: 300px">
                <button type="submit" class="search-btn" name="search" >Search</button>
            </form>

            <li class="nav-item" id="item1-nav"><a class="nav-link" href="home.php"> Home </a></li>

            <li class="nav-item dropdown"><a id="prod-menu" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Product </a>

                <ul class="dropdown-menu" aria-labelledby="prod-menu">
                    <?php
                    $sql = "SELECT * FROM categories ORDER BY ordering ASC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $img = $row['img'];
                            $catid = $row['id'];
                            $name = $row['name'];

                            echo '<li> <a onclick=" '.$var.'=2?>" class="dropdown-item" href="products.php?var='.$catid.'" id="'.$name.'"> '.$name.' </a></li>';

                        }
                    }
                    ?>

                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="AboutUs.php"> About </a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php"> Support </a></li>

        </ul>
    </div>
    <a  class="nav-icon" href="wishList.php?var=print" id="nav-icon1"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
        </svg> </a>

    <a class="nav-icon " href="cart.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
        </svg></a>

    <a class="nav-icon" href="<?php echo $url?>"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </svg></a>


    <a class="nav-icon" id="logout" href="logout.php" style="display: none" "><i class="fa fa-sign-out"> </i>Logout</a>


    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#myMenu" aria-controls="#myMenu" aria-expanded="false" aria-label="toggle-navigation"> <span class="navbar-toggler-icon"> </span></button>
</div>
<?php
if (isset($_SESSION['username'])) {
    echo"<script>document.getElementById('logout').style.display='block'</script>";
    $id = $_SESSION['id'];
    $url="members.php?do=Edit&userid=<?php echo $id ?>";

}
?>
</body>
</html>