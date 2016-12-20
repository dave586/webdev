<?php
/*
 * Handles all pdo objects and keeps out of reach of business and presentation layers
 */

class DBHelper {


    /**
     * Creates a connection by creating a pdo provided user/pass and connstring
     * @param $connString
     * @param $user
     * @param $pass
     * @return PDO
     */
    public static function createConnection($connString, $user, $pass) {
        
        $pdo = new PDO($connString, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    /**
     * Runs a query with the passed SQL query and parameters.
     * @param $pdo
     * @param $sql
     * @param array $parameters
     * @return null
     */
    public static function runQuery($pdo, $sql, $parameters=array()) {
        


        
        if(!is_array($parameters)) {
            $parameters = Array($parameters);
        }
        try {
            $statement = null;
            if(count($parameters > 0)) {
                $statement = $pdo->prepare($sql);
                $statement->execute($parameters);
            }
            else {
                $statement = $pdo->query($sql);
            }

            return $statement;
            
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        
    }
}

?>