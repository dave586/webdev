<?php


include_once 'components/SingleSubject.php';
include_once 'components/includes.php';
$subjects = BusinessHelper::createObject(new SingleSubject(BusinessHelper::getConnection()));


?>


<!DOCTYPE html>
<html lang=en xmlns="http://www.w3.org/1999/html">
<?php
echo generateHead($subjects->getTitle());
?>

<body>
<?php
echo generateHeader();

    ?>
<main>
<h2 class="ui horizontal divider"></h2>
    
    
    
    <?php
    echo $subjects->generateBanner();
    
    ?>
    
    <div class="ui segment">
        <?php
echo $subjects->generateSubjectHead();
        echo "<h2 class=\"ui horizontal divider\">artworks</h2>";

echo $subjects->generatePaintingList();


BusinessHelper::closeAllConnection();
        ?></div>
</main>
<?php
echo generateFooter();
?>
</body>

</html>