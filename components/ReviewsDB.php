<?php
include_once "AbstractDB.php";

    class ReviewsDB extends AbstractDB {

        /**
         * ReviewsDB constructor.
         * @param $connection
         */
        public function __construct($connection) {
            parent::__construct($connection);
        }

        /**
         * @return string
         */
        public function getSelect() {
            return "SELECT RatingID, PaintingID, ReviewDate, Rating, Comment FROM Reviews";
        }

        /**
         * @return string
         */
        public function getKeyFieldname() {
            return "ReviewID";
        }

        /**
         * Get Rating using painting id
         * @param $PaintingID int painting id
         * @return row
         */
        public function getRatings($PaintingID) {
            
            $sql = "SELECT Rating FROM Reviews WHERE PaintingID = :PaintingID";
            $statement = DBHelper::runQuery($this->getConnection(), $sql, Array(":PaintingID" => $PaintingID));
            $row = $statement->fetchAll();
            return $row;
            
        }

        /**
         * Get review row by painting id
         * @param $PaintingID int painting id
         * @return mixed
         */
        public function getReviewsByPID($PaintingID) {
            
        $sql = 'SELECT reviewdate, rating, comment
        FROM Reviews';
        $sql .= ' WHERE Reviews.PaintingID = :PaintingID';
        $statement = DBHelper::runQuery($this->getConnection(),$sql, Array(":PaintingID" => $PaintingID));
        $row = $statement->fetchAll();        
        return $row;
}
    }
?>
