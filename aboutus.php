<?php


include_once 'components/includes.php';

?>

<!DOCTYPE html>
<html lang="en">
<?php
echo generateHead("About Us");
?>

<body>
<?php
echo generateHeader();
?>
<main>
    <br>

<h1 class="ui header center aligned">
    About Us
</h1>


<div class="ui segment">

    <h2 class="ui header">This site is made by</h2>
    <div class="ui items">


        <div class="item">
            <div class="image">
                <img src="images/pobear logo 1.jpeg">
            </div>
            <div class="content">
                <a class="header">Dave Cheng</a>
                <div class="meta">
                    <span>Description</span>
                </div>
                <div class="description">
                    <p>this site have almost 100% functionality, besides the account tab </p>
                </div>
                <div class="extra">
                    <a href="mailto:ycheng586@mtroyal.ca">Email</a>
                </div>
                <div class="description">
                    <p>this website is mostly created with PHP, JS, HTML, MYsql  and a little bit of love.  </p>
                </div>
            </div>
        </div>


    </div>

</div>
<div class="ui segment">
    <h3 class="ui header">This site was a term project</h3>
    <span>"This is not real, not real I tell ya, none of it is."</span>
    <br>
    <span>"All of this is for web2!!!"</span>
    <br>
    <span>"this was originally a group assignment for web2, however I had further modified most of the pages"</span>

</div>

<div class="ui segment">
    <h3 class="ui header">Third Party Material</h3>
    <ul class="ul list">
        <li>user image on this page done by Dianna</li>
        <li>Semantic CSS</li>
        <li>Semantic UI</li>
        <li>Assignment 1 Artwork</li>
        <li>Assignment 1 and 2 residual code</li>

    </ul>
</div>

<div class="ui segment">
    <h4 class="ui header">Instructor during web2</h4>
    <div class="ui raised segment">
        <span>Randy Connolly</span>
        <br>
        <span>Comp 3512</span>
        <br>
        <span>Mount Royal University</span>
    </div>
</div>
</main>
<?php
echo generateFooter();
?>
</body>

</html>