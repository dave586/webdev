<?php
/**
 * Created by PhpStorm.
 * User: edbertvoo
 * Date: 2016-11-19
 * Time: 6:39 PM
 */

include_once 'components/includes.php';
include_once "components/Cart.php";


$cart = BusinessHelper::createObject(new Cart(BusinessHelper::getConnection()));

$cart->updateCart();


BusinessHelper::closeAllConnection();

//Redirect user back to previous page
if (isset($_GET["return"]) && !empty($_GET["return"]))
    header("Location: " . urldecode($_GET["return"]));
else
    header("Location: view-cart.php");


exit;
?>
