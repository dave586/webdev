<?php



include_once 'components/includes.php';
include_once 'components/SinglePainting.php';
include_once 'components/Cart.php';
include_once 'components/Favourites.php';

include_once 'components/Artist.php';
include_once 'components/ArtistDB.php';

//echo print_r(get_declared_classes());
?>

<!DOCTYPE html>
<html>


<?php
$artist = BusinessHelper::createObject(new Artist(BusinessHelper::getConnection()));
$painting = BusinessHelper::createObject(new SinglePainting(BusinessHelper::getConnection()));
$cart = BusinessHelper::createObject(new Cart(BusinessHelper::getConnection()));
$favourites = BusinessHelper::createObject(new Favourites(BusinessHelper::getConnection()));

echo generateHead(utf8_encode($painting->getTitle()));
?>

<body>

<?php
echo generateHeader();


?>
<main>
    <!-- Main section about painting -->
    <section class="ui segment grey100">
        <div class="ui doubling stackable grid container">

            <div class="nine wide column">
                <img src="images/art/works/medium/<?php echo $painting->getImagefilename() ?>.jpg" alt="..."
                     class="ui big image" id="artwork">

                <div class="ui fullscreen modal">
                    <div class="image content">
                        <img src="images/art/works/large/<?php echo $painting->getImagefilename() ?>.jpg" alt="..."
                             class="image">
                        <div class="description">
                            <p><?php echo utf8_encode($painting->getDescription()) ?></p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- END LEFT Picture Column -->


            <div class="seven wide column">

                <!-- Main Info -->
                <div class="item">
                    <h2 class="header">
                        <?php echo ($painting->getTitle()); ?>
                    </h2>
                    <h3>
                        <?php echo ($painting->getArtist()); ?>
                    </h3>
                    <div class="meta">
                        <p>
                            <?php
                            echo $painting->generatePaintingRating();
                            ?>

                        </p>
                        <p>
                            <?php echo ($painting->getExcerpt()); ?>
                        </p>
                    </div>
                </div>

                <!-- Tabs For Details, Museum, Genre, Subjects -->
                <div class="ui top attached tabular menu ">
                    <a class="active item" data-tab="details"><i class="image icon"></i>Details</a>
                    <a class="item" data-tab="museum"><i class="university icon"></i>Museum</a>
                    <a class="item" data-tab="genres"><i class="theme icon"></i>Genres</a>
                    <a class="item" data-tab="subjects"><i class="cube icon"></i>Subjects</a>
                </div>

                <div class="ui bottom attached active tab segment" data-tab="details">
                    <table class="ui definition very basic collapsing celled table">
                        <tbody>
                        <tr>
                            <td>
                                Artist
                            </td>
                            <td>
                                <a href="single-artist.php?ArtistID=<?php echo $painting->getArtistID(); ?>"><?php echo utf8_encode($painting->getArtist()); ?></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Year
                            </td>
                            <td>
                                <?php echo $painting->getYearofwork(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Medium
                            </td>
                            <td>
                                <?php echo $painting->getMedium(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Dimensions
                            </td>
                            <td>
                                <?php echo $painting->getWidth() . 'cm x ' . $painting->getHeight() . 'cm'; ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="ui bottom attached tab segment" data-tab="museum">
                    <table class="ui definition very basic collapsing celled table">
                        <tbody>
                        <tr>
                            <td>
                                Museum
                            </td>
                            <td>
                                <a href="single-gallery.php?GalleryID=<?php echo $painting->getGalleryID() ?>"><?php echo $painting->getMuseum($painting->getGalleryID()); ?></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Assession #
                            </td>
                            <td>
                                <?php echo $painting->getAccessionNo(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Copyright
                            </td>
                            <td>
                                <?php echo $painting->getCopyrightText(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                URL
                            </td>
                            <td>
                                <?php echo $museumLink = $painting->getMuseumLink(); ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="ui bottom attached tab segment" data-tab="genres">

                    <ul class="ui list">
                        <?php echo $painting->generateGenreList(); ?>
                    </ul>

                </div>
                <div class="ui bottom attached tab segment" data-tab="subjects">
                    <ul class="ui list">
                        <?php echo $painting->getSubject() ?>
                    </ul>

                </div>

                <!-- Cart and Price -->
                <div class="ui segment">
                    <form class="ui form segment" action="add-cart.php" method="get">
                        <div class="ui tiny statistic">
                            <div class="value">
                                <?php echo '$' . $painting->getMsrp(); ?>
                            </div>
                        </div>
                        <input type="hidden" name="PaintingID" value="<?php echo $painting->getPaintingID(); ?>"/>
                        <input type="hidden" name="return" value="<?php echo rawUrlEncode($_SERVER['REQUEST_URI']); ?>"/>
                        <input type="hidden" name="sp" value="true">
                        <div class="four fields">
                            <div class="four wide field">
                                <label>Quantity</label>

                                <?php
                                if ($cart->getExistCart($painting->getPaintingID())) {
                                    echo '<input name="quantity" type="number" value="' . $cart->getQuantity($painting->getPaintingID()) . '">';
                                } else {
                                    echo '<input name="quantity" type="number" value="1">';
                                }
                                ?>
                            </div>
                            <div class="four wide field">
                                <label>Frame</label>
                                <select name="FrameID" class="ui search dropdown">
                                    <?php
                                    if ($cart->getExistCart($painting->getPaintingID())) {
                                        echo $painting->generateFrameList($cart->getFrameID($painting->getPaintingID()));
                                    } else {
                                        echo $painting->generateFrameList();
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="four wide field">
                                <label>Glass</label>
                                <select name="GlassID" class="ui search dropdown">
                                    <?php
                                    if ($cart->getExistCart($painting->getPaintingID())) {
                                        echo $painting->generateGlassList($cart->getGlassID($painting->getPaintingID()));
                                    } else {
                                        echo $painting->generateGlassList();
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="four wide field">
                                <label>Matt</label>
                                <select name="MattID" class="ui search dropdown">
                                    <?php
                                    if ($cart->getExistCart($painting->getPaintingID())) {
                                        echo $painting->generateMattList($cart->getMattID($painting->getPaintingID()));
                                    } else {
                                        echo $painting->generateMattList();
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <button class="ui orange submit button">
                            <?php
                            if ($cart->getExistCart($painting->getPaintingID())) {
                                echo '<i class="refresh icon"></i> Update Cart';
                            } else {
                                echo '<i class="add to cart icon"></i> Add to Cart';
                            }
                            ?>

                        </button>

                        <a href="add-favourite.php?PaintingID=<?php echo $painting->getPaintingID(); ?>&return=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">
                            <div class="ui right labeled icon button">
                                <?php if ($favourites->getExistFav($painting->getPaintingID())) {
                                    echo '<i class="ban icon"></i> Remove from Favourites';
                                } else {
                                    echo '<i class="heart icon"></i> Add to Favorites';
                                }
                                ?>
                            </div>
                        </a>
                    </form>
                </div>
                <!-- END Cart -->

            </div>
            <!-- END RIGHT data Column -->
        </div>
        <!-- END Grid -->
    </section>
    <!-- END Main Section -->

    <!-- Tabs for Description, On the Web, Reviews -->
    <section class="ui doubling stackable grid container">
        <div class="sixteen wide column">

            <div class="ui top attached tabular menu ">
                <a class="active item" data-tab="first">Description</a>
                <a class="item" data-tab="second">On the Web</a>
                <a class="item" data-tab="third">Reviews</a>
            </div>

            <div class="ui bottom attached active tab segment" data-tab="first">
                <?php echo utf8_encode($painting->getDescription()); ?>
            </div>
            <!-- END DescriptionTab -->

            <div class="ui bottom attached tab segment" data-tab="second">
                <table class="ui definition very basic collapsing celled table">
                    <tbody>

                    <?php
                    $wikiLink = $painting->generateWikiLink();
                    $googleLink = $painting->generateGoogleLink();
                    $googleText = $painting->generateGoogleText();

                    if ($wikiLink == "" && $googleLink == "" && $googleText == "") {
                        echo '<tr><td>No information avaliable</td></tr>';
                    } else {
                        echo $wikiLink, $googleLink, $googleText;
                    }
                    ?>


                    </tbody>
                </table>
            </div>
            <!-- END On the Web Tab -->

            <div class="ui bottom attached tab segment" data-tab="third">
                <div class="ui feed">


                    <?php echo $painting->generateReviewList(); ?>


                </div>
            </div>
            <!-- END Reviews Tab -->

        </div>
    </section>
    <!-- END Description, On the Web, Reviews Tabs -->

    <!-- Related Images ... will implement this in assignment 2 -->
    <h2 class="ui dividing header"></h2>
    <section class="ui container">
        <h3 class="ui dividing header">Related Works</h3>

       <?php $artist->setArtistID($painting->getArtistID()); echo $artist->generatePaintingList(); ?>


    </section>

</main>


<?php
echo generateFooter();
?>

</body>

</html>