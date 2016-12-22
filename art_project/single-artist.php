<?php


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

echo generateHeader();?>

<main>
    <?php
echo "<h2 class=\"ui horizontal divider\"></h2>  ";
echo $artist->generateBanner();
echo $artist->generateInfo();
    ?>

    <h3 class="ui horizontal divider">artworks</h3>
<div class="ui segment">

    <?php
echo $artist->generatePaintingList();

BusinessHelper::closeAllConnection();

?>

    </div>
</main>
<?php
echo generateFooter();
?>

        </body>

    </html>
