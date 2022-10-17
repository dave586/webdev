<?php
include_once 'AbstractBusiness.php';
include_once 'GalleryDB.php';



class BrowseGalleries extends AbstractBusiness
{

    /**
     * BrowseGalleries constructor.
     * @param $db
     */
    function __construct($db)
    {
        parent::__construct("gallery", new GalleryDB($db));
    }

    /**
     * Generate the gallery name and return HTML
     * @return string generated HTML
     */
    public function generateGalleryList()
    {
        $output = '<div class="ui relaxed divided list">';

        $row = $this->db["gallery"]->getAll();

        foreach ($row as $gallery) {
            $output .= '
            
<div class="item">
  <i class="huge building icon"></i>
    <div class="content">
    
  <a class="header" href="single-gallery.php?GalleryID=' . $gallery["GalleryID"] . '">'.$this->utf8_Validate($gallery["GalleryName"]).'</a>
  <div class="description"> This gallery is located at '.$gallery["GalleryCity"].', '.$gallery["GalleryCountry"].'</div>
  
  </div></div>';
        }

        $output .= '</div>';


        return $output;
    }


    /**
     * Generate Banner
     * @return string HTML generated
     */
    public function generateBanner(){
        
    $output = '<div class="ui fluid container">
    <div class="banner2">
    <div class="ui left aligned container">
    <h1 class="ui header">Browse Galleries</h1>
    </div>
    </div>
        </div><h1 class="ui horizontal divider"></h1>';
        
        
       return $output; 
        
    }
}
