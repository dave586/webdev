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

//Functionally continue shopping is basically the same as update cart
$cart->updateCart();


BusinessHelper::closeAllConnection();

//Redirect user back to home to continue shopping
    header("Location: index.php");


exit;
?>
