<?php

/**
 *
 *
 * This class acts as the data access layer for the Frames DB.
 *
 */
class TypesFramesDB extends AbstractDB
{

    /**
     * TypesFramesDB constructor.
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
        return "SELECT FrameID, Title, Price, Color, Syle FROM TypesFrames";
    }

    /**
     * @return string
     */
    public function getKeyFieldname()
    {
        return "FrameID";
    }

    /**
     * @return mixed
     */
    public function getHighestID(){
        $sql="SELECT FrameID FROM TypesFrames
ORDER BY FrameID DESC LIMIT 1";

        $statement = DBHelper::runQuery($this->getConnection(),$sql);

        return $statement->fetch();
    }

    /**
     * @return mixed
     */
    public function getAllSorted() {
        
        $sql = "SELECT FrameID, Title, Price FROM TypesFrames ORDER BY FrameID DESC";
        $statement = DBHelper::runQuery($this->getConnection(),$sql);
        return $statement->fetchAll();
    }

}