<?php

include_once 'AbstractBusiness.php';
include_once 'BusinessHelper.php';
include_once 'PaintingDB.php';
include_once 'Cart.php';
include_once 'ArtistDB.php';
include_once 'GalleryDB.php';
include_once 'ShapeDB.php';
include_once 'Favourites.php';



class BrowsePainting extends AbstractBusiness
{

    private $cart;
    private $favourites;

    /**
     * @return string
     */
    public function generateBanner()
    {

        $output = '<div class="ui fluid container">
    <div class="banner1">
    <div class="ui left aligned container">
    <h1 class="ui header">Browse Paintings</h1>
    </div>
    </div>
        </div><h1 class="ui horizontal divider"></h1>';


        return $output;

    }


    /**
     * BrowsePainting constructor.
     * @param $db
     */
    public function __construct($db)
    {
        parent::__construct("painting", new PaintingDB($db));
        $this->addDB("artist", new ArtistDB($db));
        $this->addDB("shape", new ShapeDB($db));
        $this->addDB("gallery", new GalleryDB($db));


        $this->cart = BusinessHelper::createObject(new Cart($db));
        $this->favourites = BusinessHelper::createObject(new Favourites($db));
        
    }


    /**
     * Generate the artist <option> for list for dropdown
     * @return string HTML of generated drop down
     */
    public function generateArtistList()
    {
        $output = '';



        //$row = $this->db["artist"]->getAll();
        $row = $this->db["artist"]->getAll();
        if (!isset($_GET["artist"]) || empty($_GET["artist"]))
            $output .= '<option value="" selected>Select Artist</option>';
        else
            $output .= '<option value="">Select Artist</option>';

        foreach ($row as $artist) {


            if (isset($_GET["artist"]) && !empty($_GET["artist"])) {


                if ($artist["ArtistID"] == $_GET["artist"]) {
                    $output .= '<option selected value="' . $artist["ArtistID"] . '">';
                } else
                    $output .= '<option value="' . $artist["ArtistID"] . '">';
            } else
                $output .= '<option value="' . $artist["ArtistID"] . '">';


            if ($artist["FirstName"] != null) {
                $output .= utf8_encode($artist["FirstName"]) . ' ';
            }

            if ($artist["LastName"] != null) {
                $output .= utf8_encode($artist["LastName"]);
            }

            $output .= '</option>';

        }

        return $output;

    }

    /**
     * Generate <option> for dropdown of museum
     * @return string HTML generated of dropdown
     */
    public function generateMuseumList()
    {
        $output = '';


        $row = $this->db["gallery"]->getAll();

        
        
        
        if (!isset($_GET["museum"]) || empty($_GET["museum"]))
            $output .= '<option value="" selected>Select Museum</option>';
        else
            $output .= '<option value="">Select Museum</option>';

        foreach ($row as $gallery) {


            if (isset($_GET["museum"]) && !empty($_GET["museum"])) {
                if ($gallery["GalleryID"] == $_GET["museum"]) {
                    $output .= '<option selected value="' . $gallery["GalleryID"] . '">';
                } else
                    $output .= '<option value="' . $gallery["GalleryID"] . '">';
            } else
                $output .= '<option value="' . $gallery["GalleryID"] . '">';

            if ($gallery["GalleryName"] != null) {
                $output .= utf8_encode($gallery["GalleryName"]);
            }

            $output .= '</option>';

        }

        return $output;

    }


    /**
     * Generate <option> for dropdown list of shapes
     * @return string generated HTML for dropdown
     */
    public function generateShapesList()
    {
        $output = '';
        $row = $this->db["shape"]->getAll();

        if (!isset($_GET["shape"]) && empty($_GET["shape"]))
            $output .= '<option value="" selected>Select Shape</option>';
        else
            $output .= '<option value="">Select Shape</option>';

        foreach ($row as $shape) {
            if (isset($_GET["shape"]) && !empty($_GET["shape"])) {
                if ($shape["ShapeID"] == $_GET["shape"]) {
                    $output .= '<option selected value="' . $shape["ShapeID"] . '">';
                } else
                    $output .= '<option value="' . $shape["ShapeID"] . '">';
            } else
                $output .= '<option value="' . $shape["ShapeID"] . '">';

            if ($shape["ShapeName"] != null) {
                $output .= $shape["ShapeName"];
            }

            $output .= '</option>';

        }

        return $output;

    }


    /**
     * Get the artist name given the artist id
     * @param $aid INT artist id
     * @return string name of the artist
     */
    public function getArtistName($aid)
    {
        // $bdb = new BrowsePaintingDB();

        $row = $this->db["artist"]->getName($aid);


        $output = '';
        if (!$row["FirstName"] == null) {
            $output = $row["FirstName"] . " ";
        }

        if (!$row["LastName"] == null) {
            $output .= $row['LastName'];
        }
        return utf8_encode($output);
    }


    /**
     * Get the museum name given musuem id
     * @param $mid INT museum id
     * @return string museum name
     */
    public function getMuseumName($mid)
    {
        // $bdb = new BrowsePaintingDB();
        // $row = $bdb->getMuseumNameByMID($mid);
        $row = $this->db["gallery"]->getNameByID($mid);
        return utf8_encode($row["GalleryName"]);
    }


    /**
     * Retreive shape name give shape id
     * @param $sid INT shape id
     * @return string shape name
     */
    public function getShapeName($sid)
    {
        //$bdb = new BrowsePaintingDB();
        //$row = $bdb->getShapeNameBySID($sid);
        $row = $this->db["shape"]->getName($sid);
        return utf8_encode($row["ShapeName"]);
    }

    /**
     * Generate painting list html
     * @return string HTML of generated painting list
     */
    public function generatePaintingList()
    {
        $row = null;



        if (!empty($_GET)) {

            if (isset($_GET["Search"]) && !empty($_GET["Search"])) {
                $query = "%".$_GET["Search"]."%";
                
                $row = $this->db["painting"]->getSelectSearch($query);

            } else if (isset($_GET["artist"]) && !empty($_GET["artist"])) {

                $artistID = $_GET["artist"];
                $row = $this->db["painting"]->getPaintingByAID($artistID);

            } else if (isset($_GET["museum"]) && !empty($_GET["museum"])) {
                $museumID = $_GET["museum"];
                $row = $this->db["painting"]->getPaintingByGID($museumID);

            } else if (isset($_GET["shape"]) && !empty($_GET["shape"])) {
                $shapeID = $_GET["shape"];
                $row = $this->db["painting"]->getPaintingBySID($shapeID);

            } else {
                $row = $this->db["painting"]->getSelectLimilt();
            }

        } else {
            $row = $this->db["painting"]->getSelectLimilt();

        }


        if ($row != null) {

            foreach ($row as $item) {

                $output .= '
        <div class="item painting" id="p'.$item["PaintingID"].'">
            <a name="' . $item["PaintingID"] . '"></a>
                <div class="image">
                <a href="single-painting.php?PaintingID=' . $item["PaintingID"] . '"><img src="images/art/works/square-medium/' . $item["ImageFileName"] . '.jpg" alt="'. $this->utf8_Validate($item["Title"]) .'" class="image"></a>
                </div>
                <div class="content">
                <div class="header browserTitle">' . $this->utf8_Validate($item["Title"]) . '</div>
                    <p class="browseAuthor">' . $this->nameHelper($item["ArtistID"]) . '</p>
                    <p>$' . number_format($item["MSRP"], 2) . '</p>
                    <div class="item">
                    <p>' . $this->utf8_Validate($item["Excerpt"]) . '</p>
                    </div>
                    <div>
                        ' . $this->genGoToCart($item["PaintingID"]);
                            if($this->favourites->getExistFav($item["PaintingID"])){ 
                                        $output.= '<a href="remove-favourite.php?PaintingID='.$item["PaintingID"].'&return='.urlencode($_SERVER["REQUEST_URI"]).'"">
                        <button class="ui icon grey button"><i class="ban icon"></i>';
                            }
                                    else 
                                        $output.='<a href="add-favourite.php?PaintingID='.$item["PaintingID"].'&return='.urlencode($_SERVER["REQUEST_URI"]).'"">
                                        <button class="ui icon grey button"><i class="heart icon"></i>';
                $output .= '</button>
                        </a>
                    </div>
                </div>
        </div>

';


                if ($item != end($row)) {
                    $output .= '<hr>';
                }

            }
        }


        return $output;
    }


    /**
     * Help with generating names from rows of PDO
     * @param $first STRING first name to use
     * @param $last STRING last name to use
     * @return string combined name
     */
    private function nameHelper($num)
    {





        $output = '';

        $output = $this->db["artist"]->getName($num);
        //echo $output;
        $name = $output["FirstName"] . " " . $output["LastName"];
        


        return utf8_encode($name);
    }

    /**
     * @param $PaintingID
     * @return string
     */
    private function genGoToCart($PaintingID)
    {
        if ($this->cart->getExistCart($PaintingID)) {
            $output = '<a href="view-cart.php" class="ui icon orange button"><i class="unhide icon"></i></a>';
        } else {
            $output = '<a href="add-cart.php?PaintingID=' . $PaintingID . '&return=' . urlencode($_SERVER['REQUEST_URI'] . '#' . $PaintingID) . '" class="ui icon orange button"><i class="add to cart icon"></i></a>';
        }

        return $output;
    }


}