<?php
header('Content_Type:application/json');

include_once 'components/includes.php';
include_once 'components/Favourites.php';

$favourites = BusinessHelper::createObject(new Favourites(BusinessHelper::getConnection()));

echo json_encode($favourites->getJsonIdList());

BusinessHelper::closeAllConnection();

?>