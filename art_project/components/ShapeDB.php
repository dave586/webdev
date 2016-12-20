<?php
include_once "AbstractDB.php";

/*
 * This class forms the data access layer for accessing the shapes database.
 */
    class ShapeDB extends AbstractDB {

        /**
         * ShapeDB constructor.
         * @param $connection
         */
        public function __construct($connection) {
            parent::__construct($connection);
        }

        /**
         * @return string
         */
        public function getSelect() {
            return "SELECT ShapeName, ShapeID FROM Shapes";
        }

        /**
         * @return string
         */
        public function getKeyFieldname() {
            return "ShapeID";
        }


        /**
         * @param $ShapeID
         * @return mixed
         */
        public function getName($ShapeID){
            $sql="SELECT ShapeName, ShapeID FROM Shapes \n WHERE ".$this->getKeyFieldname()."= :ShapeID";
            $statement = DBHelper::runQuery($this->getConnection(),$sql, Array(":ShapeID" => $ShapeID));
            $row = $statement->fetch();
            return $row;
        }


    }
?>