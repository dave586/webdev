<?php
include_once "AbstractDB.php";

    class ArtistDB extends AbstractDB {

        /**
         * ArtistDB constructor.
         * @param $connection
         */
        public function __construct($connection) {
            parent::__construct($connection);
        }

        /**
         * @return string
         */
        public function getSelect() {
            return "SELECT ArtistID, FirstName, LastName, Nationality, Gender, YearOfBirth, YearOfDeath, Details, ArtistLink from Artists";
        }

        /**
         * @return string
         */
        public function getKeyFieldname() {
            return "ArtistID";
        }


        /**
         * Get name of artist given the ID
         * @param $ArtistID
         * @return mixed
         */
        public function getName($ArtistID){
            $sql="SELECT FirstName, LastName FROM Artists \n WHERE ".$this->getKeyFieldname()."= :ArtistID";
            $statement = DBHelper::runQuery($this->getConnection(),$sql, Array(":ArtistID" => $ArtistID));
            $row = $statement->fetch();
            return $row;
        }


    }
?>
