<?php

include_once 'components/includes.php';
include_once 'components/Favourites.php';

?>

    <!DOCTYPE html>
    <html>

    <?php   
        echo generateHead("View Favourites");
    ?>

        <body>
            <?php
            echo generateHeader();
            $favourites = BusinessHelper::createObject(new Favourites(BusinessHelper::getConnection()));
        ?>
                <div class="ui stackable grid container">
                    <div class="left floated three wide column">
                        <h3 class="ui dividing header">Actions</h3>
                        <a class="ui button orange" href="clear-favourites.php?return=<?php echo urlencode(" view-favourites.php "); ?>"><i class="trash icon"></i> Clear Favourites</a>
                        <br>
                        <br>
                    </div>
                    <div class="twelve wide column">
                        <h2 class="ui dividing header">Favourites</h2>
                        <div class="two column grid">
                            
                                <br>
                                <h3 class="ui header">Paintings</h3>
                                <div class="ui items">
                                    <?php echo $favourites->generateFavouritesPaintingsView(); ?>
                                </div>
                            
                           
                                <br>
                                <br>
                                <h3 class="ui header">Artists</h3>
                                <div class="ui items">
                                    <?php echo $favourites->generateFavouritesArtistsView(); ?>
                                


                            </div>
                        </div>
                    </div>
                </div>

                <?php BusinessHelper::closeAllConnection(); ?>



        </body>

    </html>