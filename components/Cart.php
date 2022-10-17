<?php

include_once 'session.php';
include_once 'PaintingDB.php';
include_once 'ArtistDB.php';
include_once 'AbstractBusiness.php';
include_once 'Painting.php';
include_once 'TypesFramesDB.php';
include_once 'TypesMattDB.php';
include_once 'TypesGlassDB.php';


class Cart extends AbstractBusiness
{
    private $PaintingID;//This will be an array that will store the list of added paintings to the cart
    private $subTotal;
    private $shippingExpress;


    /**
     * This will take a pdo use it to construct the class
     * Cart constructor.
     * @param $db PDO object
     */
    public function __construct($db)
    {
        parent::__construct("painting", new PaintingDB($db));
        $this->addDB("artist", new ArtistDB($db));
        $this->addDB("frame", new TypesFramesDB($db));
        $this->addDB("glass", new TypesGlassDB($db));
        $this->addDB("matt", new TypesMattDB($db));
        $this->shippingExpress = false;//Set to default shipping(Standard)
        $this->loadCart();
    }
    
    /**
     * This will return a JSON object script containing all the objects in the cart
     * that can be used by other languages. The array will be contained in a array called cartArray 
     * 
     * @return JSON object array of cart
     */
    // public function getCartJSON(){
    //     $this->loadCart();
        
    //     $jsonArray = null;
        
    //     foreach($this->PaintingID as $key=>$paintingEntity){
    //         $jsonArray[str_replace(" ", "p", $key)] = $paintingEntity->prepareJson();
    //     }
        
    //     return '<script type="text/javascript"> var cartArray = ' .json_encode($jsonArray).';</script>';
    // }


    /**
     * Add a painting to the cart, will default to a quantity of 1
     * @param int $id Painting id
     * @param int $quantity the quantity that you want to add the item with
     * @param int $FrameID frame material id that should be added with
     * @param int $GlassID glass material id that should be added with
     * @param int $MattID matt material id that should be added with
     */
    public function addToCart($id = null, $quantity = 1, $FrameID = 0, $GlassID = 0, $MattID = 0)
    {

        $sp = false;//This is used to check if it's single painting if so it'll allow for replacement of item in cart

        //Check document for GET Variables
        if (isset($_GET["PaintingID"]) && !empty($_GET["PaintingID"]))
            $id = $_GET["PaintingID"];

        if (isset($_GET["quantity"]) && !empty($_GET["quantity"])) {
            $quantity = $_GET["quantity"];
            if ($quantity < 1) {
                $quantity = 1;
            }
        }


        if (isset($_GET["FrameID"]) && !empty($_GET["FrameID"]))
            $FrameID = $_GET["FrameID"];

        if (isset($_GET["GlassID"]) && !empty($_GET["GlassID"]))
            $GlassID = $_GET["GlassID"];

        if (isset($_GET["MattID"]) && !empty($_GET["MattID"]))
            $MattID = $_GET["MattID"];

        if (isset($_GET["sp"]) && !empty($_GET["sp"])) {
            if ($_GET["sp"] == "true") {
                $sp = true;
            }
        }


        //Main Logic
        if ($id != null) {


            //Check if special case for Frame, Glass, and Matt
            $oID = $this->validateTypes($FrameID, $GlassID, $MattID);


            if (isset($this->PaintingID[" $id"])) {
                if ($sp == false) {
                    $this->PaintingID[" $id"]->addQuantity($quantity);
                } else {
                    $this->deleteItem($id);
                    $this->PaintingID[" $id"] = new Painting($id, $oID["frameid"], $oID["glassid"], $oID["mattid"], $quantity);
                }

            } else {
                $this->PaintingID[" $id"] = new Painting($id, $oID["frameid"], $oID["glassid"], $oID["mattid"], $quantity);
            }



            $this->saveCart();
        }
    }


    /**
     * Update the cart paintings with new values
     */
    public function updateCart()
    {

        $this->loadCart();


        //Set Shipping type
        if($_POST["shipping"]=="standard"){
            $this->shippingExpress=false;
        } else
        {
            $this->shippingExpress=true;
        }

        foreach ($this->PaintingID as $key => $paintingEntity) {
            $fKey = str_replace(" ", "|", $key);
            //set quantity
            if($_POST["Quantity".$fKey]<1){
                $paintingEntity->setQuantity(1);
            } else {
                $pValue = explode(":", $_POST["Quantity".$fKey])[0];
                $paintingEntity->setQuantity($pValue);
            }

            //Set frame
            $pValue = explode(":", $_POST["FrameID".$fKey])[0];
            $paintingEntity->setFrameID($pValue);

            //Set glass
            $pValue = explode(":", $_POST["GlassID".$fKey])[0];
            $paintingEntity->setGlassID($pValue);

            //Set matt
            $pValue = explode(":", $_POST["MattID".$fKey])[0];
            $paintingEntity->setMattID($pValue);

        }

        $this->saveCart();

    }


    /**
     * Will generate a list of paintings to be displayed along with their materials and quantity
     * @return string generated html
     */
    public
    function generateCartView()
    {
        $output = '';
        if ($this->PaintingID != null) {
            $this->subTotal = 0;
            foreach ($this->PaintingID as $key => $paintingEntity) {
                $item = $this->db["painting"]->findByID($key);
                $artist = $this->db["artist"]->findByID($item["ArtistID"]);
               // $baseCost = $this->calcBaseCost($paintingEntity, $item);
              //  $this->subTotal += $baseCost;

                $output .= '<div class="item" id="paintng'.str_replace(" ", "|", $key).'">            
                <div class="image">
                    <a href="single-painting.php?PaintingID=' . $item["PaintingID"] . '"><img src="images/art/works/square-medium/' . $item["ImageFileName"] . '.jpg" alt="..." class="image"></a>
                </div>
                <div class="content">
                 <a class="header browserTitle" href="single-painting.php?PaintingID=' . $item["PaintingID"] . '">' . $this->utf8_Validate($item["Title"]) . '</a>
                 <div>
                    <a class="browseAuthor" href="single-artist.php?ArtistID=' . $item["ArtistID"] . '">' . $this->nameHelper($artist["FirstName"], $artist["LastName"]) . '</a></div>
                    <div id="msrp'.str_replace(" ", "|", $key).'" class="priceData">'.$item["MSRP"].'</div>
                    <p>Base MSRP: $' . number_format($item["MSRP"], 2) . '</p>';




                $output .= '
                    <!-- This is used to generate the material part of the painting -->
                    
                    <div class="ui segment">
                     <div class="four fields">
                                            <div class="three wide field">
                                                <label>Quantity</label>
                                                <input name="Quantity' . str_replace(" ", "|", $key) . '" id = "quantity' . str_replace(" ", "|", $key) . '" type="number" value="' . $paintingEntity->getQuantity() . '">
                                            </div>
                                            <div class="four wide field">
                                                <label>Frame</label>
                                                <select name="FrameID' . str_replace(" ", "|", $key) . '" id="frameID' . str_replace(" ", "|", $key) . '" class="ui search dropdown">
                                    ' . $this->generateMaterialList("frame", $paintingEntity->getFrameID()) . '
                                </select>
                                            </div>
                                            <div class="four wide field">
                                                <label>Glass</label>
                                                <select name="GlassID' . str_replace(" ", "|", $key) . '" id="glassID' . str_replace(" ", "|", $key) . '" class="ui search dropdown">
                                    ' . $this->generateMaterialList("glass", $paintingEntity->getGlassID()) . '
                                </select>
                                            </div>
                                            <div class="four wide field">
                                                <label>Matt</label>
                                                <select name="MattID' . str_replace(" ", "|", $key) . '" id="mattID' . str_replace(" ", "|", $key) . '" class="ui search dropdown">
                                    ' . $this->generateMaterialList("matt", $paintingEntity->getMattID()) . '
                                </select>
                                </div>
                                </div>
</div>';


                $output .= '
<div>
<div class="priceData" id="costData'.str_replace(" ", "|", $key) .'"></div>
<p class="alighRight" >Base Cost: $<span id="cost'.str_replace(" ", "|", $key) .'"></span></p>
</div>
                    <div>
                        <a href="remove-item.php?PaintingID=' . $item["PaintingID"] . '&return=' . urlencode($_SERVER['REQUEST_URI']) . '" class="ui icon grey button">
                            <i class="trash icon"></i>
                            Remove Item
                        </a>
                    </div>

                    </div>                               
                 </div><hr><br>';

            }


        } else {
            $output .= '<p>You have no items in your cart</p>';
        }

        return $output;
    }


    /**
     * Will clear the cart
     */
    public
    function clearCart()
    {
        $this->PaintingID = null;
        $this->saveCart();
        //session_unset();
    }

    /**
     * Get Matt ID from the from Cart object using PaintingID
     * @param int $PaintingID id of the painting object
     * @return int id of the matt
     */
    public function getMattID($PaintingID)
    {
        $PaintingID = " " . $PaintingID;

        return $this->PaintingID[$PaintingID]->getMattID();

    }

    /**
     * Get Frame ID from the cart object using the Painting ID
     * @param int $PaintingID id of the painting object
     * @return int id of the frame
     */
    public function getFrameID($PaintingID)
    {
        $PaintingID = " " . $PaintingID;

        return $this->PaintingID[$PaintingID]->getFrameID();

    }

    /**
     * Get the Glass id of the painting object using painting id
     * @param int $PaintingID painting id of the object
     * @return glass painting object
     */
    public function getGlassID($PaintingID)
    {
        $PaintingID = " " . $PaintingID;

        return $this->PaintingID[$PaintingID]->getGlassID();

    }

    /**
     * Get quantity of the object given the painting id
     * @param int $PaintingID painting id of the object
     * @return int quanitity of painting
     */
    public function getQuantity($PaintingID)
    {
        $PaintingID = " " . $PaintingID;

        return $this->PaintingID[$PaintingID]->getQuantity();
    }

    /**
     * Get if the shipping is express
     * @return boolean true if express else false
     */
    public function isShippingExpress()
    {
        return $this->shippingExpress;
    }

    /**
     * Set the shipping express
     * @param boolean $shippingExpress true if express otherwise false
     */
    public function setShippingExpress($shippingExpress)
    {
        $this->shippingExpress = $shippingExpress;
    }

    /**
     * Calculate the shipping of item in the basket
     * @return int shipping cost of items
     */
    public function calcShipping()
    {
        $shippingTotal = 0;

        if (isset($this->PaintingID) && !empty($this->PaintingID)) {

            if (($this->subTotal < 2500)) {
                if ($this->subTotal < 1500 && !$this->isShippingExpress()) {
                    //caculate standard shipping
                    foreach ($this->PaintingID as $paintingEntity) {
                        $shippingTotal += 25 * $paintingEntity->getQuantity();
                    }
                } else {
                    if ($this->isShippingExpress()) {
                        //calculate express shipping
                        foreach ($this->PaintingID as $paintingEntity) {
                            $shippingTotal += 50 * $paintingEntity->getQuantity();
                        }
                    }
                }


            }
        }


        return $shippingTotal;
    }

    /**
     * Check if the painting exists
     * @param int $PaintingID painting id to check for
     * @return bool true if it exists else false
     */
    public function getExistCart($PaintingID)
    {
        $output = false;
        $PaintingID = " " . $PaintingID;
        if (isset($this->PaintingID[$PaintingID]) && !empty($this->PaintingID[$PaintingID])) {
            $output = true;
        }

        return $output;
    }

    /**
     * Check if cart is empty
     * @return bool true if it's empty else false
     */
    public function isEmpty()
    {
        $output = true;
        if (count($this->PaintingID) > 0) {
            $output = false;
        }

        return $output;
    }


    /**
     * Delete an item from cart
     * @param int $itemID id of item to be deleted
     */
    public function deleteItem($itemID)
    {

        $itemID = " " . $itemID;
        if (isset($this->PaintingID[$itemID])) {
            unset($this->PaintingID[$itemID]);
        }


    }


    /**
     * Save the cart to session
     */
    public
    function saveCart()
    {
        $_SESSION["cart"] = serialize($this->PaintingID);
        $_SESSION["shippingExpress"] = serialize($this->shippingExpress);
    }

    /**
     * Load the cart from session
     */
    public
    function loadCart()
    {
        if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
            $this->PaintingID = unserialize($_SESSION["cart"]);
        }

        if (isset($_SESSION["shippingExpress"]) && !empty($_SESSION["shippingExpress"])) {
            $this->shippingExpress = unserialize($_SESSION["shippingExpress"]);
        }

    }

    /**
     * Generate the sub total of items in cart(only work if cart has been listed)
     * @return int subtotal
     */
    public function getSubTotal()
    {
        return $this->subTotal;
    }
    
    /**
     * Generate a json array list with a list of painting ids
     * 
     * @return JSON object that contains a array with a list of ids
     */
    public function getJsonIdList(){
        $this->loadCart();
        $idArray=null;
        
        if(isset($this->PaintingID)){
            foreach ($this->PaintingID as $key => $paintingEntity) {
            $idArray[]=str_replace(" ","",$key);
            }
        }

        
        return $idArray;
    }

    /**
     * Help with generating names from rows of PDO
     * @param $first STRING first name to use
     * @param $last STRING last name to use
     * @return string combined name
     */
    private
    function nameHelper($first, $last)
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


    /**
     * Calculate the base cost of an painting
     * @param Painting $pObj entity object of painting
     * @param $row row from painting query
     * @return int base cost
     */
    private function calcBaseCost($pObj, $row)
    {
        $defaultMatt = $this->db["matt"]->getHighestID()["MattID"];
        $mattCost = 0;
        $frameCost = 0;
        $glassCost = 0;
        if ($pObj->getMattID() != $defaultMatt) {
            $mattCost = 10;
        }

        $frameCost = $this->db["frame"]->findByID($pObj->getFrameID())["Price"];
        $glassCost = $this->db["glass"]->findByID($pObj->getGlassID())["Price"];

        return ($row["MSRP"] + $mattCost + $frameCost + $glassCost) * $pObj->getQuantity();
    }

    /**
     * Set the material id to none if they are all set to 0
     * @param $FrameID
     * @param $GlassID
     * @param $MattID
     * @return arrray with material id
     */
    private
    function validateTypes($FrameID, $GlassID, $MattID)
    {

        if ($FrameID == 0 || $GlassID == 0 || $MattID == 0) {
            $f = $FrameID;
            $g = $GlassID;
            $m = $MattID;
            if ($FrameID == 0) {
                $f = $this->db["frame"]->getHighestID()["FrameID"];
            }

            if ($GlassID == 0) {
                $g = $this->db["glass"]->getHighestID()["GlassID"];
            }

            if ($MattID == 0) {
                $m = $this->db["matt"]->getHighestID()["MattID"];
            }

            //$ouput["key"] = sprintf(" %d%d%d", $f, $g, $m);
            //The above is no longer needed in the updated requirement will clean up later on
            $ouput["frameid"] = $f;
            $ouput["glassid"] = $g;
            $ouput["mattid"] = $m;

        } else {
            //$ouput["key"] = sprintf(" %d%d%d", $FrameID, $GlassID, $MattID);
            //The above is no longer needed in the updated outline. Will clean up later on
            $ouput["frameid"] = $FrameID;
            $ouput["glassid"] = $GlassID;
            $ouput["mattid"] = $MattID;
        }
        return $ouput;
    }


    /**
     * Generate the list of materials used
     * @param $type type of material to be generated
     * @param int $selected id of the selected material
     * @return string HTML generated material list
     */
    private
    function generateMaterialList($type, $selected = null)
    {
        $output = '';
        $row = $this->db[$type]->getAllSorted();
        
        $price=0;
        if ($selected == null) {
            
            
            if(!isset($row[0]["Price"])){
                if($type=="matt")
                {
                    $price=0;
                }
            } else 
                $price=$row[0]["Price"];
            
            $output .= '<option selected value="' . $row[0][0] .':'.$price.'"> ' . $row[0][1] . '</option>';
        } else {
            if ($row[0][0] == $selected) {
                
                if(!isset($row[0]["Price"])){
                    if($type=="matt")
                    {
                        $price=0;
                    }
                } else 
                    $price=$row[0]["Price"];
                
                $output .= '<option selected value="' . $row[0][0] .':'.$price.'">' . $row[0][1] . '</option>';
            } else {
                
                
                if(!isset($row[0]["Price"])){
                    if($type=="matt")
                    {
                        $price=0;
                    }
                } else 
                    $price=$row[0]["Price"];
                
                $output .= '<option value="' . $row[0][0] .':'.$price.'">' . $row[0][1] . '</option>';
            }
        }


        for ($i = 1; $i < count($row); $i++) {
            if ($selected != null) {
                if ($row[$i][0] == $selected) {
                    
                    
                    if(!isset($row[$i]["Price"])){
                        if($type=="matt")
                        {
                            $price=10;
                        }
                    } else 
                        $price=$row[$i]["Price"];
                    
                    $output .= '<option selected value ="' . $row[$i][0] .':'.$price.'">' . $row[$i][1] . '</option>';
                } else {
                    
                    
                    if(!isset($row[$i]["Price"])){
                        if($type=="matt")
                        {
                            $price=10;
                        }
                    } else 
                        $price=$row[$i]["Price"];
                    
                    $output .= '<option value ="' . $row[$i][0] .':'.$price.'">' . $row[$i][1] . '</option>';
                }
            } else {
                
                
                    if(!isset($row[$i]["Price"])){
                        if($type=="matt")
                        {
                            $price=10;
                        }   
                    } else 
                        $price=$row[$i]["Price"];
                
                $output .= '<option value ="' . $row[$i][0] .':'.$price.'">' . $row[$i][1] . '</option>';
            }
        }


        return $output;

    }


}