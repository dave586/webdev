<?php

include_once 'AbstractDB.php';

/**
 *
 * This class acts as the data access layer for the subjects db.
 *
 */
class SubjectDB extends AbstractDB
{

    /**
     * SubjectDB constructor.
     * @param $db
     */
    public function __construct($db)
    {
        parent::__construct($db);
    }

    /**
     * @return string
     */
    public function getSelect() {
        return "SELECT SubjectID, SubjectName from Subjects";
    }

    /**
     * @return string
     */
    public function getKeyFieldname() {
        return "SubjectID";
    }

    /**
     * Return the name of the subject given the id
     * @param $id int id to use
     * @return Rows with from the resutant sql query
     */
    public function getNameByID($id){
        $sql = "SELECT SubjectName From Subjects\n WHERE SubjectID = :id";
        $statement = DBHelper::runQuery($this->getConnection(), $sql, array(":id" => $id));
        return $statement->fetch();
    }

    
    

    
    
    
}