<?php
$var=0;
session_start();

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../CSS/product.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HomeStyle.css">


    <title>Smart Home</title>

</head>
<body>
<?php include 'navbar.php';?>
<div class="container-fluid container-video" style="height: 600px;">
    <div class="caption">
        <h1> Make Your House Smart </h1>
        <p>   </p>
        <button class="btn1"> Start Now </button>
        <video class="video-bg" id="background-video" autoplay loop muted poster="../images/smartHouse-slide2.jpg" ">
            <source src="../images/video.mp4" type="video/mp4">
        </video>

    </div>
</div>


<div class="container-fluid gallery">
    <h2> A Step to Your Smart House </h2>
    <p class="para"> Choose where you want to start </p>
    <p> </p>
    <div class="row">
        <div class="column">
            <?php
            $sql = "SELECT * FROM categories";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $img = $row['img'];
                    $catid = $row['id'];
                    $name = $row['name'];

                    echo '<div class="feature" > <a href="products.php?var=' . $catid . '"><img src="' . $img . '" alt="' . $name . '" style= width="60px"; height="50px" "></a> <h3> &nbsp &nbsp ' . $name . ' </h3> <p class="div-text">>> Explore</p></div>';

                }
            }
            ?>
        </div>


    </div>

</div>


<section class="our-brands ">

    <h2> Our Brands </h2>
    <div class="brands-container">

        <img src="../images/philips-logo.png" width="200px;" class="bransicon" >
        <img src="../images/Ring_logo.svg.png"width="100px;"class="bransicon">
        <img src="../images/Honeywell-Logo.png"width="200px;" class="bransicon">
        <img src="../images/Google_Nest_logo.png"width="130px;" class="bransicon">

    </div>

</section>

<div id="carouselExampleCaptions" style="width: 100%"  class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" >
            <img src="../images/homeTV.jpg" class="d-block w-100 " alt="..."style="height: 600px;">
            <div class="carousel-caption d-none d-md-block">
                <h5> </h5>
                <button class="slider-btn1" onclick="window.location.href='products.php?var=5' "> Family Entertainment</button>

            </div>
        </div>
        <div class="carousel-item">
            <img src="../images/Smart-Heating.jpg" class="d-block w-100" alt="..."style="height: 600px;">
            <div class="carousel-caption d-none d-md-block">
                <h5>  </h5>
                <button class="slider-btn2" onclick="window.location.href='products.php?var=3' "> Modern Heating System</button>

            </div>
        </div>
        <div class="carousel-item">
            <img src="../images/cam.jpg" class="d-block w-100" alt="..." style="height: 600px;">
            <div class="carousel-caption d-none d-md-block">
                <h5></h5>
                <button class="slider-btn3" onclick="window.location.href='products.php?var=1' "> Stay Protected with Security Cameras</button>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button"  data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="navbar bottom last ">
    <div class="content links" ><a href="AboutUs.php">About Us |</a> <a href="contact.php"> Contact Us </a> </div>
    <div class="content social"> <a href="https://www.facebook.com/Smart-Home-116769177684375" > <i class="fa-brands fa-facebook fa-2x"></i> </a> <a href="#" > <i class="fa-brands fa-youtube fa-2x"></i> </a>  <a href="#" > <i class="fa-brands fa-twitter fa-2x"></i> </a> </div>

</div>

<script type="text/javascript">
    $('#document_dropdown .notify').click(function(e){
        let preventDefault = e.preventDefault();
        let id = this.id;
        alert(id);
        doSomething(id);
    });

    function doSomething(id) {
        alert('You clicked #' + id);
    }

</script>
<script src="../jquery/dist/jquery.slim.min.js"> </script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
