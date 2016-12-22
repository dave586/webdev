<?php


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
<main>
    <h2 class="ui horizontal divider"></h2>   

<?php
    echo $genre->generateBanner(); ?>
    <div class="ui segment"><?php
    
echo $genre->generateGenreList();
    
    BusinessHelper::closeAllConnection();
    ?></div>

</main>
<?php
echo generateFooter();
?>
</body>

</html>