<?php

//This is an entity object that represents a painting


class Painting
{
    private $PaintingID, $FrameID, $GlassID, $MattID, $quantity;


    public function __construct($PaintingID, $FrameID=0, $GlassID=0, $MattID=0, $quantity=1)
    {
        $this->PaintingID=$PaintingID;
        $this->FrameID=$FrameID;
        $this->GlassID=$GlassID;
        $this->MattID=$MattID;
        $this->quantity=$quantity;
    }

    /**
     * @return mixed
     */
    public function getPaintingID()
    {
        return $this->PaintingID;
    }

    /**
     * @param mixed $PaintingID
     */
    public function setPaintingID($PaintingID)
    {
        $this->PaintingID = $PaintingID;
    }



    /**
     * @return mixed
     */
    public function getFrameID()
    {
        return $this->FrameID;
    }

    /**
     * @param mixed $FrameID
     */
    public function setFrameID($FrameID)
    {
        $this->FrameID = $FrameID;
    }

    /**
     * @return mixed
     */
    public function getGlassID()
    {
        return $this->GlassID;
    }

    /**
     * @param mixed $GlassID
     */
    public function setGlassID($GlassID)
    {
        $this->GlassID = $GlassID;
    }

    /**
     * @return mixed
     */
    public function getMattID()
    {
        return $this->MattID;
    }

    /**
     * @param mixed $MattID
     */
    public function setMattID($MattID)
    {
        $this->MattID = $MattID;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }


    /**
     * @param $inc
     */
    public function addQuantity($inc){
        $this->quantity+=$inc;
    }


/**
 * Prepare an array that can be used to create JSON arrays
 * 
 * @return array prepared JSON array to be used
 * 
 */
// public function prepareJson(){
//     return array("PaintingID"=>$this->PaintingID, "FrameID"=>$this->FrameID, "GlassID"=>$this->GlassID, "MattID"=>$this->MattID, "quantity"=>$this->quantity);
// }

    /**
     * @return string
     */
    public function getObjectID(){
    return sprintf(" %d%d%d",$this->FrameID,$this->GlassID,$this->MattID);
}

}