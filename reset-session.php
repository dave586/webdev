<?php


//Utility page for resetting session

include_once 'components/session.php';

session_unset();

session_destroy();

?>