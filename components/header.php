<?php


include_once 'NavHelper.php';



/**
 * Generate the header for help pages(NAV, TITLE, ETC)
 * @return string generated HTML
 */
function generateHeader()
{
    $output = '<header>
    <div class="ui attached stackable grey inverted menu">
        <div class="ui container">
            <nav class="right menu">
                <div class="ui simple  dropdown item">
                    <i class="user icon"></i>
                    Account
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="oops.php?code=4"><i class="sign in icon"></i> Login</a>
                        <a class="item" href="oops.php?code=4"><i class="edit icon"></i> Edit Profile</a>
                        <a class="item" href="oops.php?code=4"><i class="globe icon"></i> Choose Language</a>
                        <a class="item" href="oops.php?code=4"><i class="settings icon"></i> Account Settings</a>
                    </div>
                </div>
                <a class=" item" href="view-favourites.php">
                    <i class="heartbeat icon"></i> Favorites '.countFavourites("favourites").'
                </a>
                <a class=" item" href="view-cart.php">
                <i class="shop icon"></i> Cart
                '.generateItemCount("cart").'
                </a>
            </nav>
        </div>
    </div>

    <div class="ui attached stackable borderless huge menu">
        <div class="ui container">
            <h2 class="header item">
                <img src="images/logo5.png" class="ui small image">
            </h2>
            <a class="item" href="index.php">
                <i class="home icon"></i> Home
            </a>
            <a class="item" href="aboutus.php">
                <i class="mail icon"></i> About Us
            </a>
            <a class="item" href="oops.php?code=3">
                <i class="home icon"></i> Blog
            </a>
            <div class="ui simple dropdown item">
                <i class="grid layout icon"></i>
                Browse
                <i class="dropdown icon"></i>
                <div class="menu">
                
                    <a class="item" href="browse-artists.php"><i class="users icon"></i> Artists</a>
                    <a class="item" href="browse-genres.php"><i class="theme icon"></i> Genres</a>
                    <a class="item" href="browse-paintings.php"><i class="paint brush icon"></i> Paintings</a>
                    <a class="item" href="browse-subjects.php"><i class="cube icon"></i> Subjects</a>
                    <a class="item" href="browse-galleries.php"><i class="book icon"></i> Galleries</a>
                </div>
            </div>
            <div class="right item">
                <div class="ui action input">
               <!-- <form action="browse-paintings.php" method="get" id="searchForm">!-->
                           <!-- <input type=search placeholder="Search..." type="text" name="Search" id="searchBar">
                            <input type="submit" class="ui primary basic button" value="Search" id="searchBarSubmit">!-->
                            <div class="ui search">
  <div class="ui icon input">
    <input class="prompt" placeholder="Search paintings..." type="text"  id="searchBar">
    <i class="search icon"></i>
  </div>
  <div class="results"></div>
</div>
                            <!--</form>!-->
                    </div>
                </div>
            </div>

        </div>
   

</header>';

    return $output;
}

?>