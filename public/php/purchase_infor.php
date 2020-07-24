<?php 

    $cookie_name = "addToCart";
    $productID = $_COOKIE[$cookie_name];

    $array = explode(",", $productID);
    $arraysize = sizeof($array);
        
?>