<?php
include_once 'components/includes.php';
include_once "components/Favourites.php";

$favourites = BusinessHelper::createObject(new Favourites(BusinessHelper::getConnection()));

if(isset($_GET['PaintingID'])) {
    $favourites->addPainting($_GET['PaintingID']);
}
else if (isset($_GET['ArtistID'])) {
    $favourites->addArtist($_GET['ArtistID']);
}

BusinessHelper::closeAllConnection();

//Redirect user back to previous page
if (isset($_GET["return"]) && !empty($_GET["return"]))
    header("Location: " . rawUrlDecode($_GET["return"]));
else
    header("Location: view-favourites.php");


exit;
?>