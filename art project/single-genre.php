<?php
/**
 * Created by PhpStorm.
 * User: edbertvoo
 * Date: 2016-10-16
 * Time: 11:56 PM
 */

include_once 'components/includes.php';
include_once 'components/SingleGenre.php';
include_once 'components/BusinessHelper.php';

$genre = BusinessHelper::createObject(new SingleGenre(BusinessHelper::getConnection()));
?>

<!DOCTYPE html>
<html lang=en xmlns="http://www.w3.org/1999/html">
    
    
<?php


/*if (isset($_GET["GenreID"]) && !empty($_GET["GenreID"]))
    $genre = new SingleGenre($_GET["gid"]);
else
    $genre = new SingleGenre(33);*/

echo generateHead($genre->getGenreName());
   
?>

<body>
       
<?php

echo generateHeader();
    ?>
    
   <h2 class="ui horizontal divider"></h2>  
    <?php
echo $genre->generateBanner();
    ?>
     <div class="ui segment">
<?php
    
echo $genre->generateGenreHead();
echo $genre->generatePaintingList();
    
BusinessHelper::closeAllConnection();

?>

    </div>


</body>

</html>