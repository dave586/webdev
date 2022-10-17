<?php


include_once 'components/includes.php';
include_once "components/Cart.php";


$cart = BusinessHelper::createObject(new Cart(BusinessHelper::getConnection()));

if(isset($_GET["PaintingID"]) && !empty($_GET["PaintingID"])){
    $cart->deleteItem($_GET["PaintingID"]);
    $cart->saveCart();
}


BusinessHelper::closeAllConnection();

//Redirect user back to previous page
if (isset($_GET["return"]) && !empty($_GET["return"]))
    header("Location: " . urldecode($_GET["return"]));
else
    header("Location: view-cart.php");


exit;
?>

