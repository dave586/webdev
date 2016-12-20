<?php
/**
 * Created by PhpStorm.
 * User: edbertvoo
 * Date: 2016-10-24
 * Time: 2:46 AM
 */

include_once 'components/includes.php';
include_once 'components/Artist.php';
include_once 'components/ArtistDB.php';

$artist = BusinessHelper::createObject(new Artist(BusinessHelper::getConnection()));

/*if (isset($_GET["aid"]) && !empty($_GET["aid"]))
    $artist = new Artist($_GET["aid"]);
else
    $artist = new Artist(7); */?>

    <!DOCTYPE html>
    <html lang=en xmlns="http://www.w3.org/1999/html">
    <?php
echo generateHead($artist->getName());

?>

<body>
<?php

echo generateHeader();
echo $artist->generateBanner();
echo $artist->generateInfo();
    ?>
    
    
    <div class="ui segment">
    
    <?php
echo $artist->generatePaintingList();

BusinessHelper::closeAllConnection();

?>

    </div>


        </body>

    </html>
