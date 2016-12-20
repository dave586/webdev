<?php
/**
 * Created by PhpStorm.
 * User: edbertvoo
 * Date: 2016-11-04
 * Time: 7:16 PM
 */

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

    ?> <h2 class="ui horizontal divider"></h2>  
    
    
    
    <?php
    echo $subjects->generateBanner();
    
    ?>
    
    <div class="ui segment">
        <?php
echo $subjects->generateSubjectHead();

echo $subjects->generatePaintingList();


BusinessHelper::closeAllConnection();
        ?></div>

</body>

</html>