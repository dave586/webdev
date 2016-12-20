<?php
/**
 * Created by PhpStorm.
 * User: edbertvoo
 * Date: 2016-11-12
 * Time: 12:19 AM
 */

//Utility page for resetting session

include_once 'components/session.php';

session_unset();

session_destroy();

?>