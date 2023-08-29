<?php
$do = '';

if( isset( $_GET['do'] ) ){

   $do= $_GET['do'];

} else {
    $do = 'Manage';
}

// if the page is main page
if($do=='Manage'){
   echo' Welcome You are in manage items page';
   echo '<a href="page.php?do=Insert">Add new Category</a>';
}
elseif ($do=='Add'){
    echo'You are in Add Category page';
}

elseif ($do='Insert'){
    echo'You are in Insert Category page';
}

else{
    echo 'error .there is no page with this name';
}