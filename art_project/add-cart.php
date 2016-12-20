<?php
/**
 * Created by PhpStorm.
 * User: edbertvoo
 * Date: 2016-11-11
 * Time: 10:27 PM
 */

include_once 'components/includes.php';
include_once "components/Cart.php";


$cart = BusinessHelper::createObject(new Cart(BusinessHelper::getConnection()));


$cart->addToCart();

BusinessHelper::closeAllConnection();

//Redirect user back to previous page
if (isset($_GET["return"]) && !empty($_GET["return"]))
    header("Location: " . rawUrlDecode($_GET["return"]));
else
    header("Location: view-cart.php");


exit;
?>

