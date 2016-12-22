<?php


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
    <main>
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
</main>
<?php
echo generateFooter();
?>
</body>

</html>