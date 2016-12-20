<?php

include_once 'components/includes.php';
include_once "components/Favourites.php";


$favourites = BusinessHelper::createObject(new Favourites(BusinessHelper::getConnection()));

if(isset($_GET["PaintingID"]) && !empty($_GET["PaintingID"])){
    $favourites->deleteItem($_GET["PaintingID"]);
    $favourites->saveFavourites();
}

else if(isset($_GET["ArtistID"]) && !empty($_GET["ArtistID"])){
    $favourites->deleteItem($_GET["ArtistID"]);
    $favourites->saveFavourites();
}

BusinessHelper::closeAllConnection();

//Redirect user back to previous page
if (isset($_GET["return"]) && !empty($_GET["return"]))
    header("Location: " . urldecode($_GET["return"]));
else
    header("Location: view-favourites.php");


exit;
?>