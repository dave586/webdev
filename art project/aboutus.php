<?php
/**
 * Created by PhpStorm.
 * User: edbertvoo
 * Date: 2016-10-17
 * Time: 12:04 AM
 */

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

<h1 class="ui header center aligned">
    About Us
</h1>


<div class="ui segment">


    <div class="ui items">
        <div class="item">
            <div class="image">
                <img src="images/profileLarge.jpg">
            </div>
            <div class="content">
                <a class="header">Edbert Voo</a>
                <div class="meta">
                    <span>Description</span>
                </div>
                <div class="description">
                    <p>Comp 3512</p>

                </div>
                <div class="extra">
                    <a href="http://www.edbertvoo.com">edbertvoo.com</a>
                </div>
                <div class="description">
                    <p>Contributions to Project:</p>
                    <div class="ui bulleted list">
                        <div class="item">All cart functionality</div>
                        <div class="item">Program design<div class="list"><div class="item">Abstract Business implementation, Business Helper, DB Abstract</div> </div> </div>
                        <div class="item">Single-Gallery
                            <div class="list">
                                <div class="item">Fixed errors</div>
                            </div>

                        </div>
                        <div class="item">Browse Gallery
                            <div class="list">
                                <div class="item">Fixed errors</div>
                            </div>
                        </div>


                        <div class="item">Browse Painting
                            <div class="list">
                                <div class="item">Fixed SQL errors</div>
                            </div>

                        </div>

                        <div class="item">Single Painting
                            <div class="list">
                                <div class="item">Subjects</div>
                                <div class="item">Add to cart</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="item">
            <div class="image">
                <img src="images/male.png">
            </div>
            <div class="content">
                <a class="header">Matt Groeneveld</a>
                <div class="meta">
                    <span>Description</span>
                </div>
                <div class="description">
                    <p>Comp 3512</p>
                </div>
                <div class="extra">
                    <a href="mailto:groe602@mtroyal.ca">Email</a>
                </div>
                <div class="description">
                    <p>Contributions to Project: All favourite functionality, single-painting, program design (Business
                    and data access layers), bug fixes, code updates from assignment 1, service-painting functionality and integration
                    with existing browse-painting page, loader, hover functionality, jquery for browse-paintings, and moral support.</p>
                </div>
            </div>
        </div>


        <div class="item">
            <div class="image">
                <img src="images/male.png">
            </div>
            <div class="content">
                <a class="header">Dave Cheng</a>
                <div class="meta">
                    <span>Description</span>
                </div>
                <div class="description">
                    <p>Comp 3512</p>
                </div>
                <div class="extra">
                    <a href="mailto:ycheng586@mtroyal.ca">Email</a>
                </div>
                <div class="description">
                    <p>Contributions to Project: Styling, Genre and Subjects pages, browse-paintings, and program
                        design. </p>
                </div>
            </div>
        </div>


    </div>

</div>
<div class="ui segment">
    <h2 class="ui header">This site is term project</h2>
    <span>"This is not real, not real I tell ya, none of it is."</span>
    <br>
    <span>"All of this is for web2!!!"</span>

</div>

<div class="ui segment">
    <h2 class="ui header">Third Party Material</h2>
    <ul class="ul list">
        <li>SemanticCSS</li>
        <li>Assignment 1 Artwork</li>
        <li>
            <div>Icons made by <a href="http://www.flaticon.com/authors/icomoon" title="Icomoon">Icomoon</a> from <a
                    href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a
                    href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC
                    3.0 BY</a></div>
        </li>
    </ul>
</div>

<div class="ui segment">
    <h2 class="ui header">Instructor</h2>
    <div class="ui raised segment">
        <span>Randy Connolly</span>
        <br>
        <span>Comp 3512</span>
        <br>
        <span>Mount Royal University</span>
    </div>
</div>


</body>

</html>