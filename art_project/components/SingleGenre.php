<?php
include_once 'GenreDB.php';
include_once 'AbstractBusiness.php';

/**
 * Provides business logic for presentation layer and connects to genre db classes
 * 
 */
class SingleGenre extends AbstractBusiness
{
    private $GenreID;

    /**
     * SingleGenre constructor.
     * @param $gid INT genre id
     */
    public function __construct($db, $GenreID = null)
    {
        parent::__construct("genre", new GenreDB($db));
        
        if ($GenreID == null) {
            if (isset($_GET["GenreID"]) && !empty($_GET["GenreID"]))
                $this->GenreID=$_GET["GenreID"];
            else
                $this->GenreID = 1;
        }
    }

    /**
     * finds genre name by genreID
     * @return STRING genre name
     */
    public function getGenreName()
    {
        $row = $this->db["genre"]->getGenreNameByGID($this->GenreID);
        return $row["GenreName"];
    }

    /**
     * generates genre page head info
     * @return string HTML generated genre header
     */
    public function generateGenreHead()
    {
        $name = $this->db["genre"]->getGenreNameByGID($this->GenreID);
        $desc = $this->db["genre"]->getGenreDescriptionByGID($this->GenreID);

        return
            '<div class="ui segment">
    <div class="ui grid">
        <div class="three wide column"><img class="ui image left floated" src="images/art/genres/square-medium/' . $this->GenreID . '.jpg">
        </div>

        <div class="twelve wide column">
            <h3 class="header">' . $name["GenreName"] . '</h3>
            <p>' . utf8_encode($desc["Description"]) . '</p>
             <a href="' . $name["Link"] . '">more information could be found here </a>
        </div>
    </div>
</div>';

    }


    /**
     * compiles a list of paintings using GenreID
     * @return string HTML genre painting list
     */
    public function generatePaintingList()
    {
        $row = $this->db["genre"]->getPaintingList($this->GenreID);

        $output = '<div class="ui six stackable cards">';

        foreach ($row as $painting) {

            $output .= '<div class="ui card">
            <a class="image" href="single-painting.php?PaintingID=' . $painting["PaintingID"] . '">
      <img src="images/art/works/square-medium/' . $painting["ImageFileName"] . '.jpg">
    </a>
    <div class="content">
      <a class="header" href="single-painting.php?PaintingID=' . $painting["PaintingID"] . '">' . $this->utf8_Validate($painting["Title"]) . '</a>
    </div>
   </div>';

        }

        $output .= '</div>';

        return $output;


    }


    /**
     * generates the page banner
     * @return string
     */
    public function generateBanner(){
        
    $output = '<div class="ui fluid container">
    <div class="banner2">
    <div class="ui left aligned container">
    <h1 class="ui header">Single Genres</h1>
    </div>
    </div>
        </div><h1 class="ui horizontal divider"></h1>';
        
        
       return $output; 
        
    }
    


}
