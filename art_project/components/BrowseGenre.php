<?php
include_once 'GenreDB.php';
include_once 'AbstractBusiness.php';

/**
 * Provides business logic for browse-genre.php page and connects to db access layer.
 *
 */
class BrowseGenre extends AbstractBusiness
{
    /**
     * BrowseGenre constructor.
     * @param $db
     * @param null $GenreID
     */
    public function __construct($db, $GenreID = null)
    {
        parent::__construct("genre", new GenreDB($db));
        
    }
    

    /**
     * Generate the genre list and return HTML
     * @return string generated HTML
     */
    public function generateGenreList()
    {
        $output = '<div class="ui six stackable cards">';

        $row = $this->db["genre"]->getGenreList();

        foreach ($row as $genre) {
            $output .= '
<div class="ui card">
  <a class="image" href="single-genre.php?GenreID='.$genre["GenreID"].'">
      <img src="images/art/genres/square-medium/' . $genre["GenreID"] . '.jpg">
     </a>
    <div class="content">
      <a class="header" href="single-genre.php?GenreID='.$genre["GenreID"].'">' . $genre["GenreName"] . '</a>
    </div>
    </div>';
        }

        $output .= '</div>';


        return $output;
    }


    /**
     * @return string
     */
    public function generateBanner(){
        
    $output = '<div class="ui fluid container">
    <div class="banner1">
    <div class="ui left aligned container">
    <h1 class="ui header">Browse Genres</h1>
    </div>
    </div>
        </div><h1 class="ui horizontal divider"></h1>';
        
        
       return $output; 
        
    }
    
    
    
    
    
    
    
    
}