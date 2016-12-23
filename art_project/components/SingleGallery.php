<?php
include_once 'GalleryDB.php';
include_once 'AbstractBusiness.php';
include_once 'PaintingDB.php';


/**
*
*builds and displays single gallery
*/
class SingleGallery extends AbstractBusiness
{
    private $GalleryID = null;


    /**
     * SingleGallery constructor.
     * @param $db
     * @param null $GalleryID
     */
    public function __construct($db, $GalleryID = null)
    {
        parent::__construct("gallery", new GalleryDB($db));
        //$this->addDB("galleryPainting", new PaintingGalleryDB($db));
        $this->addDB("painting", new PaintingDB($db));

        if ($GalleryID == null) {
            if (isset($_GET["GalleryID"]) && !empty($_GET["GalleryID"]))
                $this->GalleryID = $_GET["GalleryID"];
            else
                $this->GalleryID = 38;
        }
    }

    /**
     * @return STRING gallery name
     */


    public function setGalleryID($id)
    {
        $this->GalleryID = $id;
    }


    /**
     * @return string HTML generated gallery header
     */
    public function generateGalleryHead()
    {


        $row = $this->db["gallery"]->getNameByID($this->GalleryID);



        return
            '<div class="ui segment">
    <div class="ui grid">
        <div class="ten wide column">
       <div id="map" style="width:100%;height:500px"></div>

        </div>

        <div class="six wide column">
            <h3 class="header">' . $this->utf8_Validate($row["GalleryName"]) . '</h3>
            <a href=' . $row["GalleryWebSite"] . '>Link to ' . $this->utf8_Validate($row["GalleryName"]) . ' </a>
        </div>
    </div>
</div>';

    }


    /**
     * @return string HTML genre painting list
     */
    public function generatePaintingList()
    {
        $paintingGalleryRows = $this->db["painting"]->getPaintingsFromGalleryID($this->GalleryID);

        $output = '<div class="ui six stackable cards">';

        foreach ($paintingGalleryRows as $painting) {
            $output .= '<div class="ui card"><a class="image" href="single-painting.php?PaintingID=' . $painting["PaintingID"] . '">
    
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
     * gets the lat
     * @return mixed
     */
    public function generateLat()
    {

        $output = $this->db["gallery"]->getLatGID($this->GalleryID);


        return $output[0];
    }



    /**
     * gets the long, some locations have negative number and some should
     * @return mixed
     */
    public function generateLong()
    {

        $output = $this->db["gallery"]->getLongGID($this->GalleryID);


        return $output[0];
    }



    /**
     * gets the name
     * @return string
     */
    public function getName()
    {
        $row = $this->db["gallery"]->getNameByID($this->GalleryID);
        return $this->utf8_Validate($row["GalleryName"]);
    }


    /**
     * @return string
     */
    public function generateBanner()
    {

        $output = '<div class="ui fluid container">
    <div class="banner1">
    <div class="ui left aligned container">
    <h1 class="ui header">Single Gallery</h1>
    </div>
    </div>
        </div><h1 class="ui horizontal divider"></h1>';


        return $output;

    }


}