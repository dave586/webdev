<?php

include_once 'session.php';
include_once 'AbstractBusiness.php';
include_once 'PaintingDB.php';
include_once 'Painting.php';
include_once 'ArtistDB.php';
include_once 'ArtistFavourite.php';

/**
* This class controls the favourites functionality. It stores a multidimensional array $favList that is pupulated by paintings and *artists at an offset specified by $paint and $art. Paintings are stored at $favList[$paint][i] and Artists at $favList[$art][i]
* This class is used heavily by all pages with favourites functionality.
*
*/

class Favourites extends AbstractBusiness {

    public $favList = array(); //This will be an array that will store the list of added paintings and artists. Paintings indexed at favList[0][i], and Artists at favList[1][i]
  
    //private $ArtistID;
    private $paint = 0;
    private $art = 1;

    /**
     * Favourites constructor.
     * @param $db
     */
    public function __construct($db) {
        parent::__construct("painting", new PaintingDB($db));
        $this->addDB("artist", new ArtistDB($db));
        $this->favList[$this->paint] = array();
        $this->favList[$this->art] = array();
        $this->loadFavourites();
    }


    /**
     * adds a painting to the list
     * @param $id
     */
    public function addPainting($id) {
    
        $this->favList[$this->paint][" $id"] = new Painting($id, null, null, null, 1);
        $this->saveFavourites();
    }
    

    /**
     * Adds an artist to the list
     * @param $id
     */
    public function addArtist($id) {
        
        $this->favList[$this->art][" $id"] = new ArtistFavourite($id);
        $this->saveFavourites();
    }
    

    /**
     * populates markup for painting items.
     * @return string
     */
    public function generateFavouritesPaintingsView() {
        
        $output = '';
        if ($this->favList != null) {
            if ($this->favList[$this->paint] != null) {
                
                foreach ($this->favList[$this->paint] as $key => $paintingEntity) {
                
                $item = $this->db["painting"]->findByID($key);

                $output .= '<div class="item">            
                <div class="image">
                    <a href="single-painting.php?PaintingID=' . $item["PaintingID"] . '"><img src="images/art/works/square-medium/' . $item["ImageFileName"] . '.jpg" alt="..." class="image"></a>
                </div>
                <div class="content">
                 <a class="header browserTitle" href="single-painting.php?PaintingID=' . $item["PaintingID"] . '">' . $this->utf8_Validate($item["Title"]) . '</a>';
                $output .= '<br>
                        <div class="extra">
                        <a href="remove-favourite.php?PaintingID=' . $item["PaintingID"] . '&return=' . urlencode($_SERVER['REQUEST_URI']) . '" class="ui icon orange button">
                            <i class="trash icon"></i>
                            Remove This Item
                        </a>
                    </div>
                    </div>
                    </div>                               
                 <hr><br>';

                }
            }
            else {
                $output .= '<p>You have no painting favourites</p>';
            }
            return $output;
        }
    }
    

    /**
     * populates markup for artist items.
     * @return string
     */
    public function generateFavouritesArtistsView() {
            
        $output = '';
        if ($this->favList != null) {
            if ($this->favList[$this->art] != null) {
                
                foreach ($this->favList[$this->art] as $key => $paintingEntity) {
                    $artist = $this->db["artist"]->findByID($key);
                    
                    $output .= '<div class="item">            
                                    <div class="image">
                                        <a href="single-artist.php?ArtistID=' . $artist["ArtistID"] . '"><img src="images/art/artists/square-medium/' . $artist["ArtistID"] . '.jpg" alt="..." class="image"></a>
                                        </div>
                                        <div class="content">
                                        <a class="header browserTitle" href="single-artist.php?ArtistID=' . $artist["ArtistID"] . '">' . $this->nameHelper($artist["FirstName"], $artist["LastName"]) . '</a>';
                    $output .= '
                        <div class="extra">
                        <a href="remove-favourite.php?ArtistID=' . $artist["ArtistID"] . '&return=' . urlencode($_SERVER['REQUEST_URI']) . '" class="ui icon orange button">
                            <i class="trash icon"></i>
                            Remove This Item
                        </a>
                        </div>
                        </div>
                        </div>
                    <hr><br>';
                }
            }

        
        else {
            $output .= '<p>You have no artist favourites</p>';
        }

        return $output;
    }
    }
    

    /**
     * erases all favourites stored.
     *
     */
    public function clearFavourites() {
        
        $this->favList = null;
        $this->saveFavourites();
        unset($_SESSION["favourites"]);
    }

    /**
     * @param $itemID
     */
    public function deleteItem($itemID) {
        
        $itemID = " " . $itemID;
        if (isset($this->favList[$this->paint][$itemID])) {
            unset($this->favList[$this->paint][$itemID]);
        }
        else if (isset($this->favList[$this->art][$itemID])) {
            unset($this->favList[$this->art][$itemID]);
        }
    }

    /**
     *
     */
    public function saveFavourites() {
        
        $_SESSION["favourites"] = serialize($this->favList);
    }
    

    /**
     *loads favourites using session data.
     */
    public function loadFavourites() {
        
        if (isset($_SESSION["favourites"]) && !empty($_SESSION["favourites"])) {
            $this->favList = unserialize($_SESSION["favourites"]);
        }
    }
    

    /**
     * determines if a particular artist or painting already exists within the array. Used for generating add vs remove links
     * @param $id
     * @return bool
     */
    public function getExistFav($id) {
        $output = false;
        $id = " " . $id;
        
        if (isset($this->favList[$this->paint][$id]) && !empty($this->favList[$this->paint][$id])) {
            $output = true;
        }
        
        else if (isset($this->favList[$this->art][$id]) && !empty($this->favList[$this->art][$id])) {
            $output = true;
        }

        return $output;
        
    }

    /**
     * @param $first
     * @param $last
     * @return string
     */
    function nameHelper($first, $last)
    {
        $output = '';
        if (!$first == null) {
            $output = $first . " ";
        }

        if (!$last == null) {
            $output .= $last;
        }
        return $this->utf8_validate($output);
    }
    
    public function getJsonIdList(){
        $this->loadFavourites();
        $idArray=null;
        
        if(isset($this->favList)){
            //print_r($this->favList[0]);
            foreach ($this->favList[0] as $key => $paintingEntity) {
            $idArray[]=str_replace(" ","",$key);
            }
        }

        
        return $idArray;
    }

}

?>