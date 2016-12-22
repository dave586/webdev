<?php
include_once 'ArtistDB.php';
include_once 'AbstractBusiness.php';
include_once 'DBHelper.php';
include_once 'PaintingDB.php';
include_once 'Favourites.php';

/**
 * Created by PhpStorm.
 * User: edbertvoo
 * Date: 2016-10-22
 * Time: 9:56 PM
 */
class Artist extends AbstractBusiness
{
    private $ArtistID;
    private $favourites;

    /**
     * Artist constructor.
     * @param $db PDO database to be used
     * @param $ArtistID INT Artist id
     */
    public function __construct($db, $ArtistID = null)
    {
        parent::__construct("artist" ,new ArtistDB($db));
        $this->addDB("paintings", new PaintingDB($db));
        $this->favourites = BusinessHelper::createObject(new Favourites($db));
        
        if ($ArtistID == null) {
            if (isset($_GET["ArtistID"]) && !empty($_GET["ArtistID"]))
                $this->ArtistID=$_GET["ArtistID"];
            else
                $this->ArtistID = 7;
        }
        
    }

    /**
     * Change the artist id that the object will use
     * @param $id INT ArtistID to use
     */
    public function setArtistID($id){
        $this->ArtistID=$id;
    }

    /**
     * Return the name of the artist
     * @return string Name of the artist
     */
    public function getName()
    {

        $row = $this->db["artist"]->getName($this->ArtistID);

        return $this->nameHelper($row["FirstName"], $row["LastName"]);
    }

    /**
     * Generate the information of the artist and output a HTML
     * @return string generated HTML
     */
    public function generateInfo()
    {
        $row = $this->db["artist"]->findByID($this->ArtistID);
        
        $output =
            '<div class="ui segment">
    <div class="ui grid">
        <div class="three wide column"><img class="ui image left floated" src="images/art/artists/medium/' . $this->ArtistID . '.jpg">
        </div>
        <div class="twelve wide column">
            <h3 class="header">' . $this->nameHelper($row["FirstName"], $row["LastName"]) . '</h3>
            <p>Gender: ' . $row["Gender"] . '</p><p>Nationality: ' . $row["Nationality"] . '</p><p>Born on: ' . $row["YearOfBirth"] . '</p><p>Died on: ' . $row["YearOfDeath"] . '</p>
            <p>' . $this->utf8_Validate($row["Details"]) . '</p>
   
            <a href="' . $row["ArtistLink"] . '">more information could be found here </a>
            <br><p>';
                    if($this->favourites->getExistFav($this->ArtistID)){ 
                        $output.= '<a href="remove-favourite.php?PaintingID='.$this->ArtistID.'&return='.urlencode($_SERVER["REQUEST_URI"]).'">
                        <br><button class="ui right labeled icon button"><i class="ban icon"></i> Remove from Favourites';
                    }
                        else 
                            $output.='<a href="add-favourite.php?ArtistID='.$this->ArtistID.'&return='.urlencode($_SERVER["REQUEST_URI"]).'">
                            <br><button class="ui right labeled icon button"><i class="heart icon"></i> Add to Favorites';
            $output.='</button></a><p>
        </div>
    </div>
</div>';
        return $output;
    }

    /**
     * Generate the painting list
     * @return string HTML generated
     */
    public function generatePaintingList()
    {
        $output = '<div class="ui six stackable cards">';

        $row = $this->db["paintings"]->getPaintingByAID($this->ArtistID);

        foreach ($row as $painting) {
            $output .= '<div class="ui card">

  <a class="image" href="single-painting.php?PaintingID='.$painting["PaintingID"].'">
   
      <img src="images/art/works/square-medium/' . $painting["ImageFileName"] . '.jpg">
    </a>
    <div class="content">
      <a class="header" href="single-painting.php?PaintingID='.$painting["PaintingID"].'">' .$this->utf8_Validate( $painting["Title"]) . '</a>
    </div>
   </div>';
        }

        $output .= '</div>';


        return $output;
    }


    /**
     * Generate the banner
     * @return string HTML generated
     */
    public function generateBanner(){
        
    $output = '<div class="ui fluid container">
    <div class="banner2">
    <div class="ui left aligned container">
    <h1 class="ui header">Single Artist</h1>
    </div>
    </div>
        </div><h1 class="ui horizontal divider"></h1>';
        
        
       return $output; 
        
    }

    /**
     * Help functions with concatenating the name together
     * @param $first STRING first name of artist
     * @param $last STRING last name of artist
     * @return string contains the combined name
     */
    private function nameHelper($first, $last)
    {
        $output = '';
        if (!$first == null) {
            $output = $first . " ";
        }

        if (!$last == null) {
            $output .= $last;
        }
        return $this->utf8_Validate($output);
    }

}

?>