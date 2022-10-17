<?php
/**
* This class is an artist object for holding specifically within a favourites array.
*
*/

class ArtistFavourite
{
    private $ArtistID;

    /**
     * ArtistFavourite constructor.
     * @param $ArtistID
     */
    public function __construct($ArtistID)
    {
        $this->ArtistID = $ArtistID;
    }

    /**
     * @return int artist id
     */
    public function getArtistID()
    {
        return $this->ArtistID;
    }

    /**
     * @param $id
     */
    public function setArtistID($id) {
        $this->ArtistID = $id;
    }
}
?>