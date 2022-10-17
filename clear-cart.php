<?php

include_once 'components/includes.php';
include_once 'components/Cart.php';



//This is a special page that will clear the items in the cart and return the user to the previous page

$cart = BusinessHelper::createObject(new Cart(BusinessHelper::getConnection()));


$cart->clearCart();

BusinessHelper::closeAllConnection();

//Redirect user back to previous page
header("Location: ".urldecode($_GET["return"]));


exit;
?>