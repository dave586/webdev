<?php

include_once 'DBHelper.php';


class PaintingSubjectDB extends AbstractDB
{

    /**
     * PaintingSubjectDB constructor.
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
        return "SELECT PaintingID, SubjectID, PaintingSubjectID FROM PaintingSubjects";
    }

    /**
     * @return string
     */
    public function getKeyFieldname()
    {
        return "PaintingSubjectID";
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getPaintingIDFromSubjectID($id){
        $sql = "SELECT PaintingID FROM PaintingSubjects\n WHERE SubjectID = :id";
        $statement = DBHelper::runQuery($this->getConnection(), $sql, array(":id" => $id));
        return $statement->fetchAll();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getSubjectIDFromPaintingID($id){
        $sql = "SELECT SubjectID FROM PaintingSubjects\n WHERE PaintingID = :id";
        $statement = DBHelper::runQuery($this->getConnection(), $sql, array(":id" => $id));
        return $statement->fetchAll();
    }
    
    
    
    
    
    
    
}