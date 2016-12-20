<?php
header('Content_Type:application/json');

include_once 'components/includes.php';
include_once 'components/Cart.php';

$cart = BusinessHelper::createObject(new Cart(BusinessHelper::getConnection()));

echo json_encode($cart->getJsonIdList());

BusinessHelper::closeAllConnection();

?>