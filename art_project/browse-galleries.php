<?php
/**
 * Created by Dave
 *
 */
include_once 'components/includes.php';
include_once 'components/BrowseGalleries.php';// use an artist genre
//include_once 'components/BusinessHelper.php';

?>



<!DOCTYPE html>
<html lang=en xmlns="http://www.w3.org/1999/html">
<?php
echo generateHead("Browse Galleries");
?>

<body>
    
<?php
echo generateHeader();
    ?>
<main>
        <h2 class="ui horizontal divider"></h2>  
<?php
$gallery = BusinessHelper::createObject(new BrowseGalleries(BusinessHelper::getConnection()));
            
echo $gallery->generateBanner();
 ?>
<div class="ui container">
            
<?php
echo $gallery->generateGalleryList();

BusinessHelper::closeAllConnection();

?>

    </div>
</main>

<?php
echo generateFooter();
?>
</body>

</html>





