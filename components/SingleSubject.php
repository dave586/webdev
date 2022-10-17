<?php

include_once 'AbstractBusiness.php';
include_once 'SubjectDB.php';
include_once 'PaintingSubjectDB.php';
include_once 'PaintingDB.php';

/**
 *
 * Provides business logic for subjects and connects the data access layer subjectsdb to the markup and presentation layer
 *
 */
class SingleSubject extends AbstractBusiness
{
    private $SubjectID = null;

    /**
     * SingleSubject constructor.
     * @param $db
     * @param null $SubjectID
     */
    function __construct($db, $SubjectID = null)
    {
        parent::__construct("subject", new SubjectDB($db));
        $this->addDB("subjectPainting", new PaintingSubjectDB($db));
        $this->addDB("painting", new PaintingDB($db));

        if ($SubjectID == null) {
            if (isset($_GET["SubjectID"]) && !empty($_GET["SubjectID"]))
                $this->SubjectID = $_GET["SubjectID"];
            else
                $this->SubjectID = 1;
        }
    }

    /**
     * @return string HTML generated genre header
     */
    public function generateSubjectHead()
    {

        $row = $this->db["subject"]->getNameByID($this->SubjectID);


        return
            '<div class="ui segment">
    <div class="ui grid">
        <div class="three wide column"><img class="ui image left floated" src="images/art/subjects/square-medium/' . $this->SubjectID . '.jpg">
        </div>

        <div class="twelve wide column">
            <h3 class="header">' . $this->utf8_Validate($row["SubjectName"]) . '</h3>
            <p>List of painting that are under the subject: ' . $this->utf8_Validate($row["SubjectName"]) . '</p>
        </div>
    </div>
</div>';

    }

    /**
     * Generate a painting list using a subject id
     * @return string Generated HTML
     */
    public function generatePaintingList()
    {
        $paintingSubjectRows = $this->db["subjectPainting"]->getPaintingIDFromSubjectID($this->SubjectID);

        $output = '<div class="ui six stackable cards">';

        foreach ($paintingSubjectRows as $prow) {
            $painting = $this->db["painting"]->findByID($prow["PaintingID"]);
            
            $output .= '<div class="ui card">
            <a class="image" href="single-painting.php?PaintingID=' . $painting["PaintingID"] . '">
      <img src="images/art/works/square-medium/' . $painting["ImageFileName"] . '.jpg">
    </a>
    <div class="content">
      <a class="header" href="single-painting.php?PaintingID=' . $painting["PaintingID"] . '">' . $this->utf8_Validate($painting["Title"]) . '</a>
    </div>
   </div>';
        }


        $output .= '</div>';

        return $output;


    }

    /**
     * Get the title of the subject given the subject id
     * @return String name of the subject
     */
    public function getTitle()
    {
        $row = $this->db["subject"]->getNameByID($this->SubjectID);
        return $row["SubjectName"];
    }

    /**
     * @return string
     */
    public function generateBanner(){
        
    $output = '<div class="ui fluid container">
    <div class="banner1">
    <div class="ui left aligned container">
    <h1 class="ui header">Single Subject</h1>
    </div>
    </div>
        </div><h1 class="ui horizontal divider"></h1>';
        
        
       return $output; 
        
    }

}