<?php



abstract class AbstractDB {

    abstract public function getSelect();
    abstract public function getKeyFieldname();
    private $connection;

    /**
     * AbstractDB constructor.
     * @param $connection
     */
    public function __construct($connection) {
        $this->connection = $connection;
    }

    /**
     * @return mixed
     */
    protected function getConnection() {
        return $this->connection;
    }

    /**
     * @return mixed
     */
    public function getAll() {
        $statement = DBHelper::runQuery($this->connection,$this->getSelect(), null);
        
        
        return $statement->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findByID($id) {
        $sql = $this->getSelect() . " WHERE " . $this->getKeyFieldname() . "=:id";
        
        $statement = DBHelper::runQuery($this->connection, $sql, Array(":id" => $id));
        
        return $statement->fetch();
    }


    /**
     * Closes the connection to the database.
     */
    public function closeConnection()
    {
        $this->connection=null;
    }

}

?>