<?php
include_once "AbstractDB.php";

    class GalleryDB extends AbstractDB {

        /**
         * GalleryDB constructor.
         * @param $db
         */
        public function __construct($db) {
            parent::__construct($db);
        }

        /**
         * Get the select statement
         * @return string
         */
        public function getSelect() {
            return "SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry from Galleries ORDER BY GalleryName ASC";
        }

        /**
         * Get the keyfield name
         * @return string
         */
        public function getKeyFieldname() {
            return "GalleryID";
        }


        /**
         * Get the name of the gallery from the gallery id
         * @param $id
         * @return mixed
         */
        public function getNameByID($id){
            $sql="SELECT GalleryName, GalleryWebSite FROM Galleries \n WHERE GalleryID = :id";
            $statement = DBHelper::runQuery($this->getConnection(), $sql, array(":id" => $id));
            $row = $statement->fetch();
            return $row;
        }


        /**
         * Get the latititude of the gallery
         * @param $galId
         * @return float latitiude of the museum
         */
        public function getLatGID($galId)
    {
        $sql = "SELECT Latitude FROM Galleries \n WHERE GalleryID = :galId";

        $row = null;
        $statement = DBHelper::runQuery($this->getConnection(), $sql, array(":galId" => $galId));
        $row = $statement->fetch();

        return $row;

    }
    
    
    

        /**
         * getting the longitude, to build the google map
         * @param int $galId gallery id
         * @return float gallery longtitude
         */
        public function getLongGID($galId)
    {
        $sql = "SELECT Longitude FROM Galleries \n WHERE GalleryID = :galId";

        $row = null;
        $statement = DBHelper::runQuery($this->getConnection(), $sql, array(":galId" => $galId));
        $row = $statement->fetch();
  
        return $row;

    }
        
        
        
 
        
        
     
        
        
        
        

    }
?>
