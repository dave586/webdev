<?php


include_once 'components/includes.php';
include_once 'components/BrowseSubjects.php';


?>

<!DOCTYPE html>
<html lang=en xmlns="http://www.w3.org/1999/html">
<?php
echo generateHead("Browse Subjects");
?>

<body>
<?php
echo generateHeader();
    
  ?>
<main>
    <h2 class="ui horizontal divider"></h2> 
   
    <?php
$subjects = BusinessHelper::createObject(new BrowseSubjects(BusinessHelper::getConnection()));

echo $subjects->generateBanner();
    ?>
        <div class="ui segment">
<?php
echo $subjects->generateSubjectList();

BusinessHelper::closeAllConnection();
?>
</div>
</main>
<?php
echo generateFooter();
?>
</body>

</html>