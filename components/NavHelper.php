<?php


/**
 * Generate the item count HTML from session name
 * @param $sessionName string name of the session
 * @return string HTML generated
 */
function generateItemCount($sessionName)
{
    $output = '';
    $count = 0;
    if (isset($_SESSION[$sessionName])) {
        $iarray = unserialize($_SESSION[$sessionName]);
        $count = count($iarray);

        if($count>0){
            $output .='  <div class="ui label">
                        <i class="angle double right icon"></i> Items: '.$count.' 
                     </div>';
        }
    }

    return $output;
}

/**
 * Generate HTML for favourite count
 * @return string HTML generated
 */
function countFavourites() {
    $output = '';
    $count = 0;
    
    if (isset($_SESSION["favourites"]) && !empty($_SESSION["favourites"])) {
        $iarray = unserialize($_SESSION["favourites"]);
        $count = count($iarray[0]);
        $count += count($iarray[1]);

        if($count>0){
            $output .='  <div class="ui label">
                        <i class="angle double right icon"></i> Items: '.$count.' 
                     </div>';
        }
    }

    return $output;
}

?>