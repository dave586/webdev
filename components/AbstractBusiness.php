<?php


class AbstractBusiness
{

    protected $db = null;

    /**
     * AbstractBusiness constructor.
     * @param $key
     * @param $db
     */
    public function __construct($key, $db)
    {
        $this->addDB($key,$db);
    }

    /**
     * Add to the list of databases that the business layer class can use
     * @param $key String to identify the database
     * @param $db Database object to be associated with key
     */
    public function addDB($key, $db){
        $this->db[$key]=$db;
    }

    /**
     * This will close the connection to the pdo
     */
    public function closeConnection()
    {
        foreach ($this->db as $item) {
            $item->closeConnection();
        }

    }

    /**
     * Check if the string is in utf8 and encode it if it is not
     * @param $string String to check and encode
     * @return string validated string
     */
    public function utf8_Validate($string)
    {
        $output=$string;
        if (!preg_match('!!u', $string)) {
            $output = utf8_encode($string);
        }
        return $output;
    }

}

?>