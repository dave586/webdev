<?php

include_once 'components/includes.php';
include_once 'components/Favourites.php';

//This is a special page that will clear the favourites and return the user to the previous page

$favourites = BusinessHelper::createObject(new Favourites(BusinessHelper::getConnection()));


$favourites->clearFavourites();

BusinessHelper::closeAllConnection();

//Redirect user back to previous page
header("Location: ".urldecode($_GET["return"]));

exit;
?>