<?php

include_once "AbstractDB.php";
include_once 'DBHelper.php';


class PaintingDB extends AbstractDB
{
    /**
     * PaintingDB constructor.
     * @param $connection
     */
    public function __construct($connection)
    {
        parent::__construct($connection);
    }

    /**
     * @return string
     */
    public function getKeyFieldname()
    {
        return "PaintingID";
    }

    /**
     * @return string
     */
    public function getSelect()
    {
        return "SELECT PaintingID, Title, Description, Excerpt, ArtistID, YearOfWork, Medium, Width, Height, MSRP, GoogleLink, GoogleDescription, WikiLink, AccessionNumber, CopyrightText, MuseumLink, ImageFileName, GalleryID, Cost FROM Paintings";
    }

    /**
     * This code was replaced with the Abstract one inside the class
     * Get a single painting given the id
     * @param $id int id of the painting to search for
     * @return Row with the found painting
     */
    /*    public function getPaintingFromID($id)
        {
            $sql = $this->getSelect() . "\nWHERE PaintingID = :id";
            $statement = DBHelper::runQuery($this->getConnection(), $sql, array(":id" => $id));
            return $statement->fetch();

        }*/


    /**
     * @return mixed
     */
    public function getSelectLimilt()
    {

        $sql = "SELECT PaintingID, Title, Description, Excerpt, ArtistID, YearOfWork, Medium, Width, Height, MSRP, GoogleLink, GoogleDescription, WikiLink, AccessionNumber, CopyrightText, MuseumLink, ImageFileName, Cost FROM Paintings ORDER BY YearOfWork ASC LIMIT 20";
        $statement = DBHelper::runQuery($this->getConnection(), $sql, null);
        return $statement->fetchAll();


    }


    /**
     * Get the Painting by Artist ID
     * @param $aid int Artist ID
     * @return row
     */
    public function getPaintingByAID($aid)
    {


        $sql = $this->getSelect() . "\nWHERE ArtistID = :id \n ORDER BY YearOfWork ASC LIMIT 20";
        $statement = DBHelper::runQuery($this->getConnection(), $sql, array(":id" => $aid));
        return $statement->fetchAll(PDO::FETCH_ASSOC);


    }
    

    /**
     * Get painting row by gallery id
     * @param $gid int gallery id
     * @return row
     */
    public function getPaintingByGID($gid)
    {


        $sql = $this->getSelect() . "\nWHERE GalleryID = :id \n ORDER BY YearOfWork ASC LIMIT 20";
        $statement = DBHelper::runQuery($this->getConnection(), $sql, array(":id" => $gid));
        return $statement->fetchAll();


    }


    /**
     * Get painting row by shape id
     * @param $sid shape id
     * @return row
     */
   public function getPaintingBySID($sid)
    {


        $sql = $this->getSelect() . "\nWHERE ShapeID = :id \n ORDER BY YearOfWork ASC LIMIT 20";
        $statement = DBHelper::runQuery($this->getConnection(), $sql, array(":id" => $sid));
        return $statement->fetchAll();


    }


    /**
     * @param $query
     * @return mixed
     */
    public function getSelectSearch($query)
    {


        $sql = $this->getSelect() . "\nWHERE Title LIKE :keys \n ORDER BY YearOfWork ASC LIMIT 20";
        $statement = DBHelper::runQuery($this->getConnection(), $sql, array(":keys" => $query));
        return $statement->fetchAll();


    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPaintingsFromGalleryID($id){
        $sql = "SELECT PaintingID, Title, YearOfWork, ImageFileName FROM Paintings \n WHERE GalleryID = :id \n ORDER BY YearOfWork ASC";
        $statement = DBHelper::runQuery($this->getConnection(), $sql, array(":id" => $id));
        return $statement->fetchAll();
    }


}