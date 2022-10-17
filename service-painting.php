<?php
header('Content_Type:application/json');
//this is a testing page, also use http://jsonlint.com/ to check,

// more reference http://api.jquery.com/jquery.getjson/
// and if you go https://assign3-evoo540-edbertv.c9users.io/service-painting.php you will get a json object


include_once 'components/ServiceDB.php';
//a list of array that containts the serviceDB
$list = new ServiceDB();
 //logic in selecting the right query
    if (isset($_GET['artist'])) {
        $artistID = $_GET['artist'];
        if($artistID ==null)
            $paintings = $list->getSelectLimit();
        else
        $paintings = $list->getPaintingsByArtistID($artistID);
       
    }
    
    else if(isset($_GET['shape'])) {
        $shapeID = $_GET['shape'];
        if($shapeID ==null)
            $paintings = $list->getSelectLimit();
        else
        $paintings = $list->getPaintingsByShapeID($shapeID);
        
    }
    
    else if(isset($_GET['museum'])) {
        $museumID = $_GET['museum'];
        if($museumID ==null)
            $paintings = $list->getSelectLimit();
        else
        $paintings = $list->getPaintingsByGalleryID($museumID);
    }
    
    else if(isset($_GET['search'])) {
        $searchString = $_GET['search'];
        if($searchString ==null)
            $paintings = $list->getSelectLimit();
        else
        $paintings = $list->getPaintingsBySearchString($searchString);
    }
    else{
        
        $paintings = $list->getSelectLimit();
        //default case
    }


    $response = [];
    


//converters the paintings array to proper utf8 format
$response=utf8_converter($paintings);

$test = array();
foreach($paintings as $key => $value) {
    
}

echo json_encode(array('results'=>$response));


//converter function used to correct parse artist names and other unfit characters
function utf8_converter($array)
{
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
        }
    });
 
    return $array;
}
?>