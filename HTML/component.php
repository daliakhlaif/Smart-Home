

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
echo"    <link rel='stylesheet' type='text/css' href='../CSS/productsStyle.css'>";
function  component($productid,$productname, $productimg, $productprice,$wish)
{
    $url = $_SERVER['REQUEST_URI'];
    $element = "
   
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                <form action='$url' method=\"post\" style='display: inline-block;' >
                    <div class=\"shadow  box \">

                        <div>

                            <img src=\"$productimg\" alt=\"Image1\" class=\" card-img-top product-feature-box\" height='230px'>
                            
                        </div>
                        <div style='width: 230px;' >
                      
                            <h6 class='fontStyle'>$productname</h6>
                            
                            <h6 >
                                <span class='fontStyle'>$$productprice</span>
                            </h6>
                            <button type='submit' id=\"button\" class=\"btn btn-warning my-3 buttonStyle\"  name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"  ></i></button>
                            <button type='submit' name=\"wish\" style='border: none; background-color: white'><img id=\"$productid\" src=\"$wish\" class=\" circle marginleft\" height=\"5px\" width=\"5px\"></button>

                            <input type='hidden' name='product_id' value='$productid'>
                            <input type='hidden' name='product_image' value='$productimg'>
                            <input type='hidden' name='product_name' value='$productname'>
                            <input type='hidden' name='product_price' value='$productprice'>
                            <input type='hidden' name='wish' value='$wish'>
                                                       
                            </div>
                        
                        
                    </div>
                </form>
            </div>
    ";
    echo $element;
}

?>


</body>
</html>


