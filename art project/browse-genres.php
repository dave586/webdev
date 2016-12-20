<?php
/**
 * Created by PhpStorm.
 * User: edbertvoo
 * Date: 2016-10-24
 * Time: 1:23 AM
 */

include_once 'components/includes.php';
include_once 'components/BrowseGenre.php';
    $genre = BusinessHelper::createObject(new BrowseGenre(BusinessHelper::getConnection()));


?>

<!DOCTYPE html>
<html lang=en xmlns="http://www.w3.org/1999/html">
<?php
echo generateHead("Browse Genre");
?>

<body>
<?php
echo generateHeader();
?> 
    <h2 class="ui horizontal divider"></h2>   

<?php
    echo $genre->generateBanner(); ?>
    <div class="ui segment"><?php
    
echo $genre->generateGenreList();
    
    BusinessHelper::closeAllConnection();
    ?></div>

</body>

</html>