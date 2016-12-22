<?php

include_once 'AbstractDB.php';


class OrderDetailsDB extends AbstractDB
{




    /**
     * OrderDetailsDB constructor.
     * @param $connection
     */
    public function __construct($connection)
    {
        parent::__construct($connection);
    }

    /**
     * @return string
     */
    public function getSelect()
    {
        return "SELECT OrderDetailID, OrderID, PaintingID, FrameID, GlassID, MattID FROM OrderDetails";
    }

    /**
     * @return string
     */
    public function getKeyFieldname()
    {
        return "OrderDetailID";
    }


    /**
     * @param $PaintingID
     */
    public function findByPaintingID($PaintingID)
    {
        $sql = "SELECT FrameID, GlassID, MattID FROM OrderDetails
WHERE PaintingID = :pid";


    }

}