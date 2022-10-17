<?php
include_once 'ArtistDB.php';
include_once 'AbstractBusiness.php';


class BrowseArtist extends AbstractBusiness
{

    /**
     * BrowseArtist constructor.
     * @param $connection
     */
    function __construct($connection)
    {
        parent::__construct("artist",new ArtistDB($connection));
    }

    /**
     * Generate the artist name and return HTML
     * @return string generated HTML
     */
    public function generateBanner(){
        
    $output = '<div class="ui fluid container">
    <div class="banner1">
    <div class="ui left aligned container">
    <h1 class="ui header">Browse Artists</h1>
    </div>
    </div>
        </div><h1 class="ui horizontal divider"></h1>';
        
        
       return $output; 
        
    }


    /**
     * Generate the artist list
     * @return string HTML generated
     */
    public function generateArtistList()
    {
        $output = '<div class="ui six stackable cards">';

        $row = $this->db["artist"]->getAll();

        foreach ($row as $artist) {
            $output .= '
<div class="ui card">
    <a class="image" href="single-artist.php?ArtistID=' . $artist["ArtistID"] . '">
      <img src="images/art/artists/square-medium/' . $artist["ArtistID"] . '.jpg">
       </a>
    <div class="content">
    
      <a class="header" href="single-artist.php?ArtistID=' . $artist["ArtistID"] . '">' . $this->utf8_Validate($artist["FirstName"]) . ' ' . $this->utf8_Validate($artist["LastName"]) . '</a>
    
    </div>
</div>';
        }

        $output .= '</div>';


        return $output;
    }

    
    

    
    
    
    
    
    
}