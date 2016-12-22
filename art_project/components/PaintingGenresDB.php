<?php

include_once 'AbstractDB.php';

class PaintingGenresDB extends AbstractDB
{

    /**
     * PaintingGenresDB constructor.
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
        return "SELECT PaintingGenreID, PaintingID, GenreID, GenreName
        FROM PaintingGenres
        INNER JOIN Genres
        ON GenreID=Genres.GenreID";
    }

    /**
     * @return string
     */
    public function getKeyFieldname()
    {
        return "PaintingGenreID";
    }

    /**
     * @param $PaintingID
     * @return mixed
     */
    public function getGenreNamebyPID($PaintingID) {
        $sql = $this->getSelect();
        $sql.=" WHERE PaintingID = " .$PaintingID;
        $statement = DBHelper::runQuery($this->getConnection(),$sql, Array(":PaintingID" => $PaintingID));
        return $statement->fetchAll();
    }

}