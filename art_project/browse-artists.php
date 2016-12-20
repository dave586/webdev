<?php
/**
 * Created by PhpStorm.
 * User: edbertvoo
 * Date: 2016-10-24
 * Time: 1:23 AM
 */

include_once 'components/includes.php';
include_once 'components/BrowseArtists.php';// use an artist genre
$artists = BusinessHelper::createObject(new BrowseArtist(BusinessHelper::getConnection()));

?>



<!DOCTYPE html>
<html lang=en xmlns="http://www.w3.org/1999/html">
<?php
echo generateHead("Browse Artists");
?>

<body>
    
    
    
<?php
echo generateHeader();
    
  ?>  
    
  <h2 class="ui horizontal divider"></h2>  
    
 <?php   
    
    
    
echo $artists->generateBanner();
?>
        <div class="ui segment">

<?php        
echo $artists->generateArtistList();

BusinessHelper::closeAllConnection();

?>
        </div>

</body>

</html>