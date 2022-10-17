<?php

/**
 *
 * This class acts as the data access layer for the Glass DB.
 *
 */
class TypesGlassDB extends AbstractDB
{

    /**
     * TypesGlassDB constructor.
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
        return "SELECT GlassID, Title, Description, Price FROM TypesGlass";
    }

    /**
     * @return string
     */
    public function getKeyFieldname()
    {
        return "GlassID";
    }

    /**
     * @return mixed
     */
    public function getHighestID(){
        $sql="SELECT GlassID FROM TypesGlass
ORDER BY GlassID DESC LIMIT 1";

        $statement = DBHelper::runQuery($this->getConnection(),$sql);

        return $statement->fetch();
    }

    /**
     * @return mixed
     */
    public function getAllSorted() {
        
        $sql = "SELECT GlassID, Title, Price FROM TypesGlass ORDER BY GlassID DESC";
        $statement = DBHelper::runQuery($this->getConnection(),$sql);

        return $statement->fetchAll();
    }

}