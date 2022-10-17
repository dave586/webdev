<?php

//include_once 'AbstractBusiness.php';
include_once "AbstractDB.php";
include_once 'BusinessHelper.php';
include_once 'DBHelper.php';
include_once 'PaintingDB.php';
include_once 'ArtistDB.php';
include_once 'GalleryDB.php';
include_once 'ShapeDB.php';

class ServiceDB extends AbstractDB {
    
    
    public function __construct() {
        $painting = new PaintingDB(BusinessHelper::getConnection());
        $artist = new ArtistDB(BusinessHelper::getConnection());
        $shape = new ShapeDB(BusinessHelper::getConnection());
        $museum = new GalleryDB(BusinessHelper::getConnection());
    }
    
    public function getKeyFieldname()
    {
        return "PaintingID";
    }
    
    public function getSelect()
    {
        return "SELECT PaintingID, Paintings.ArtistID, ImageFileName, Title, Excerpt, Artists.FirstName, Artists.LastName, CONCAT_WS(' ', Artists.FirstName, Artists.LastName) AS Name, MSRP FROM Paintings INNER JOIN Artists ON Paintings.ArtistID=Artists.ArtistID";
    }
    
    public function getPaintingsByArtistID($artistID) {
        
        $sql = $this->getSelect() . "\nWHERE Paintings.ArtistID = :id \n ORDER BY YearOfWork ASC LIMIT 20";
        $statement = DBHelper::runQuery(BusinessHelper::getConnection(), $sql, array(":id" => $artistID));
        return $statement->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    public function getPaintingsByShapeID($shapeID) {
        
        $sql = $this->getSelect() . "\nWHERE ShapeID = :id \n ORDER BY YearOfWork ASC LIMIT 20";
        $statement = DBHelper::runQuery(BusinessHelper::getConnection(), $sql, array(":id" => $shapeID));
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPaintingsByGalleryID($galleryID) {
        
        $sql = $this->getSelect() . "\nWHERE GalleryID = :id \n ORDER BY YearOfWork ASC LIMIT 20";
        $statement = DBHelper::runQuery(BusinessHelper::getConnection(), $sql, array(":id" => $galleryID));
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPaintingsBySearchString($searchString) {
        
        $sql = $this->getSelect() . "\nWHERE Title LIKE :keys \n ORDER BY YearOfWork ASC LIMIT 20";
        $statement = DBHelper::runQuery(BusinessHelper::getConnection(), $sql, array(":keys" => $searchString."%"));
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
     /**
     * @return mixed
     */
    public function getSelectLimit()
    {
        
        $sql = $this->getSelect() . " ORDER BY YearOfWork ASC LIMIT 20";
        $statement = DBHelper::runQuery(BusinessHelper::getConnection(), $sql, null);
        return $statement->fetchAll(PDO::FETCH_ASSOC);


    }
}
































?>