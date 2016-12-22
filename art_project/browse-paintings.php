<?php


include_once 'components/includes.php';
include_once 'components/BrowsePainting.php';
$painting = BusinessHelper::createObject(new BrowsePainting(BusinessHelper::getConnection()));
?>

<!DOCTYPE html>
<html lang=en xmlns="http://www.w3.org/1999/html">
<?php
echo generateHead("Browse Paintings");
   
?>


<body>

<?php echo generateHeader();
    //echo $painting->generateBanner();

?>
<main>
<h2 class="ui horizontal divider"></h2>
<div class="ui fluid container">
    <div class="banner1">
        <div class="ui left aligned container">
        <h1 class="ui header">Browse Paintings</h1>
        </div>
    </div>
</div><h1 class="ui horizontal divider"></h1>


<div class="ui stackable grid container">
    <div class="left floated three wide column">
        <h3 class="ui dividing header">Filter</h3>
        <form class="ui form">
            <div class="field">
                <label>Artist</label>
                <select name="artist" class="ui search dropdown" id="artist-dropdown">
                    <?php echo $painting->generateArtistList(); ?>
                </select>
            </div>


            <div class="field">
                <label>Museum</label>
                <select name="museum" class="ui dropdown" id="museum-dropdown">
                    <?php echo $painting->generateMuseumList(); ?>
                </select>
            </div>


            <div class="field">
                <label>Shape</label>
                <select name="shape" class="ui dropdown" id="shape-dropdown">
                    <?php echo $painting->generateShapesList(); ?>
                </select>
            </div>

            

        </form>
    </div>

    <div class="twelve wide column">
        <h2 class="ui header">Paintings</h2>
        <p><b>Top 20 Paintings</b></p>
        <p>Artist = <span id="artist-label"><?php
            if (isset($_GET["artist"]) && !empty($_GET["artist"])) {
                if ($_GET["artist"] == '') {
                    echo 'All';
                } else {
                    echo $painting->getArtistName($_GET["artist"]);
                }
            } else
                echo 'All</span>'
            ?></p>


        <p>Museum = <span id="museum-label"><?php
            if (isset($_GET["museum"]) && !empty($_GET["museum"])) {
                if ($_GET["museum"] == '') {
                    echo 'All';
                } else {
                    echo $painting->getMuseumName($_GET["museum"]);
                }
            } else
                echo 'All</span>'
            ?></p>


        <p>Shape = <span id="shape-label"><?php
            if (isset($_GET["shape"]) && !empty($_GET["shape"])) {
                if ($_GET["shape"] == '') {
                    echo 'All';
                } else {
                    echo $painting->getShapeName($_GET["shape"]);
                }
            } else
                echo 'All</span>'
            ?></p>
<?php 
        //dont know where logic begin, should do some intergation on this
         if (isset($_GET["search"]) && !empty($_GET["search"])) {
             
             echo "you search for ".$_GET["search"];
             
             
         }
        
        ?>
        <div class="ui disabled centered loader" id="browse-loader"></div>
        <div class="ui items"></div>
            <?php //echo $painting->generatePaintingList(); ?>

    </div>


    <div class="one wide column">
        <p></p>
    </div>

</div>

<?php BusinessHelper::closeAllConnection() ?>



<script src="js/browse-painting.js"></script>

</main>
<?php
echo generateFooter();
?>
</body>

</html>
