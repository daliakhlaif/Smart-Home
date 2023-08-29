<?php
include 'init.php';
?>
<div class="navbar navbar-expand-md fixed-top navbar-light bg-light">

    <div class="container-fluid">

        <a class="navbar-brand" href="#"><img src="../images/logo.png" alt="smart-house-blue-logo" width="80px" height="50px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="members.php">Members</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="categories.php">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="items.php">Items</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['username'];?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['id'] ?>">Profile</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>


                    </ul>

        </div>
    </div>

</div>
<script src="../jquery/dist/jquery.slim.min.js"> </script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
