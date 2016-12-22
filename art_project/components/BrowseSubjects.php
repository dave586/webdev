<?php
include_once 'AbstractBusiness.php';
include_once 'SubjectDB.php';


class BrowseSubjects extends AbstractBusiness
{
    /**
     * BrowseSubjects constructor.
     * @param $db
     */
    public function __construct($db)
    {
        parent::__construct("subject", new SubjectDB($db));
    }


    /**
     * Generate the Subject List
     * @return string HTML Generated
     */
    public function generateSubjectList()
    {
        $output = '<div class="ui six stackable cards">';

        $row = $this->db["subject"]->getAll();

        foreach ($row as $subject) {
            $output .= '
<div class="ui card">
  <a class="image" href="single-subject.php?SubjectID=' . $subject["SubjectID"] . '">
      <img src="images/art/subjects/square-medium/' . $subject["SubjectID"] . '.jpg">
   
    </a>
    <div class="content">
      <a class="header" href="single-subject.php?SubjectID=' . $subject["SubjectID"] . '">' . $subject["SubjectName"] . '</a>
    </div>
    </div>';
        }


        $output .= '</div>';


        return $output;
    }


    /**
     * Generate the banner
     * @return string HTML generated
     */
    public function generateBanner(){
        
    $output = '<div class="ui fluid container">
    <div class="banner2">
    <div class="ui left aligned container">
    <h1 class="ui header">Browse Subjects</h1>
    </div>
    </div>
        </div><h1 class="ui horizontal divider"></h1>';
        
        
       return $output; 
        
    }
}
