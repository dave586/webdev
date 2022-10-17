<?php

/**
 *
 * This class acts as the data access layer for the Matt DB
 *
 */
class TypesMattDB extends AbstractDB
{

    /**
     * TypesMattDB constructor.
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
        return "SELECT MattID, Title, ColorCode FROM TypesMatt";
    }

    /**
     * @return string
     */
    public function getKeyFieldname()
    {
        return "MattID";
    }


    /**
     * @return mixed
     */
    public function getHighestID(){
        $sql="SELECT MattID FROM TypesMatt
        ORDER BY MattID DESC LIMIT 1";

        $statement = DBHelper::runQuery($this->getConnection(),$sql);

        return $statement->fetch();
    }

    /**
     * @return mixed
     */
    public function getAllSorted() {
        $sql="SELECT MattID, Title FROM TypesMatt ORDER BY MattID DESC";

        $statement = DBHelper::runQuery($this->getConnection(),$sql);

        return $statement->fetchAll();
    }

}