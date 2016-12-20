<?php
include_once "AbstractDB.php";
/**
 * Provides data access layer functionality for Genre table
 *
 */
class GenreDB extends AbstractDB
{
    /**
     * GenreDB constructor.
     * @param $connection
     */
    public function __construct($connection) {
        parent::__construct($connection);
    }

    /**
     * returns the default query string
     * @return string
     */
    public function getSelect() {
        return "SELECT GenreID, GenreName, EraID, Description, Link FROM Genres";
    }

    /** returns the primary key for the genre table
     * @return string
     */
    public function getKeyFieldname() {
        return "GenreID";
    }
    /**
     * returns the genreName provided a genreID
     * @param $gid INT genre id
     * @return ARRAY row with genre name
     */
    public function getGenreNameByGID($GenreID)
    {
        $sql = $this->getSelect();
        $sql.=" WHERE " .$this->getKeyFieldname()." = :GenreID";
        $statement = DBHelper::runQuery($this->getConnection(),$sql, Array(":GenreID" => $GenreID));
        $row = $statement->fetch();
        return $row;
    }

    /**
     * returns a genre description given a genreID
     * @param $gid INT genreid
     * @return ARRAY row with genre description
     */
    public function getGenreDescriptionByGID($GenreID)
    {
        $sql = "SELECT Description FROM Genres WHERE " .$this->getKeyFieldname()."= :GenreID";
        $statement = DBHelper::runQuery($this->getConnection(),$sql, Array(":GenreID" => $GenreID));
        $row = $statement->fetch();
        return $row;
    }

    /**
     * Returns a painting list as an array provided a genreid
     * @param $gid INT genreid
     * @return array row with painting list that match the genreid
     */
    public function getPaintingList($GenreID)
    {
        $sql = "SELECT PaintingID, ImageFileName, Title
        FROM Paintings
        JOIN PaintingGenres USING(PaintingID)
        WHERE GenreID = :GenreID";
        $statement = DBHelper::runQuery($this->getConnection(),$sql, Array(":GenreID" => $GenreID));
        $row = $statement->fetchAll();
        return $row;

    }

    /**
     * returns genrename when provided a painting id
     * @param $PaintingID
     * @return mixed
     */
    public function getGenreNamebyPID($PaintingID) {
        $sql = "SELECT PaintingGenres.GenreID, Genres.GenreName
        FROM PaintingGenres
        INNER JOIN Genres
        ON Genres.GenreID=PaintingGenres.GenreID";
        $sql.=" WHERE PaintingID = " .$PaintingID;
        $statement = DBHelper::runQuery($this->getConnection(),$sql, Array(":PaintingID" => $PaintingID));
        return $statement->fetchAll();
    }

    /**
     * returns an array of all genres
     * @return mixed
     */
    public function getGenreList() {
        $sql = "SELECT GenreName, GenreID
        FROM Genres
        JOIN Eras USING(EraID)
        ORDER BY EraID DESC, GenreName DESC";
        
        $statement = DBHelper::runQuery($this->getConnection(), $sql, null);
        return $statement->fetchAll();
    }


}