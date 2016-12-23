<?php




function generateFooter()
{
    $output = '<h3 class="ui horizontal divider"></h3>
<footer class="ui inverted vertical footer segment" >
<div class="ui center aligned container">
      <div class="ui stackable inverted divided grid">
        <div class="two wide column">
          <h4 class="ui inverted header">Artists</h4>
          <div class="ui inverted link list">
            <a href="browse-artists.php" class="item">All</a>
            <a href="single-artist.php" class="item">Single</a>
            
          </div>
        </div>
        <div class="two wide column">
          <h4 class="ui inverted header">Genres</h4>
          <div class="ui inverted link list">
            <a href="browse-genres.php" class="item">All</a>
            <a href="single-genre.php" class="item">Single</a>
            
          </div>
        </div>
        <div class="two wide column">
          <h4 class="ui inverted header">Paintings</h4>
          <div class="ui inverted link list">
            <a href="browse-paintings.php" class="item">browse</a>
            <a href="single-painting.php" class="item">Single</a>
            
          </div>
        </div>
        
        <div class="two wide column">
          <h4 class="ui inverted header">Subjects</h4>
          <div class="ui inverted link list">
            <a href="browse-subjects.php" class="item">All</a>
            <a href="single-subject.php" class="item">Single</a>

          </div>
        </div>
        
        
        <div class="two wide column">
          <h4 class="ui inverted header">Galleries</h4>
          <div class="ui inverted link list">
            <a href="browse-galleries.php" class="item">List</a>
            <a href="single-gallery.php" class="item">Single</a>
         
          </div>
        </div>
        
        <div class="five wide column">
          <h4 class="ui inverted header">Art Store Project</h4>
          <p>Functional art store that aims to allow users to buy paintings, store favorites, and browse categories. </p>
        </div>
      </div>
      <div class="ui inverted section divider"></div>
     
     
      <div class="ui horizontal inverted small divided link list">
        <a class="item" href="oops.php?code=1">Site Map</a>
        <a class="item" href="aboutus.php">About Us</a>
        <a class="item" href="oops.php?code=2">Terms and Conditions</a>
        
      </div>
      </div>
     
    </footer>';


    return $output;
}


?>


