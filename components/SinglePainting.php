<?php


include_once 'ReviewsDB.php';
include_once 'TypesGlassDB.php';
include_once 'TypesFramesDB.php';
include_once 'TypesMattDB.php';
include_once 'GenreDB.php';
include_once 'DBHelper.php';
include_once 'AbstractBusiness.php';
include_once 'BusinessHelper.php';
include_once 'PaintingSubjectDB.php';
include_once 'SubjectDB.php';
include_once 'GalleryDB.php';
include_once 'PaintingDB.php';
include_once 'ArtistDB.php';

/**
 *
 *this page is used in making the single painting page
 *contains logic operations in most methods
 */
class SinglePainting extends AbstractBusiness
{

    //declears variables thats going to be used in making the page
    private $PaintingID, $title, $description, $artist, $excerpt, $yearofwork, $artistid, $medium, $width, $height, $msrp,
        $wikiLink = '', $googleLink = '', $googleText = '', $accessionNo, $museumLink, $copyrightText, $imagefilename, $galleryID;


    /**
     * SinglePainting constructor.
     * @param $PaintingID INT painting id
     */
    public function __construct($db, $PaintingID = null)
    {
        parent::__construct("paintings", new PaintingDB($db));
        $this->addDB("review", new ReviewsDB($db));
        $this->addDB("genre", new GenreDB($db));
        $this->addDB("subject", new PaintingSubjectDB($db));
        $this->addDB("glass", new TypesGlassDB($db));
        $this->addDB("frame", new TypesFramesDB($db));
        $this->addDB("matt", new TypesMattDB($db));
        $this->addDB("subjectName", new SubjectDB($db));
        $this->addDB("gallery", new GalleryDB($db));
        $this->addDB("artist", new ArtistDB($db));
        //$this->cart=BusinessHelper::createObject(new Cart($db));

        if ($PaintingID == null) {
            if (isset($_GET['PaintingID']) && !empty($_GET['PaintingID']))
                $this->PaintingID = $_GET['PaintingID'];
            else
                $this->PaintingID = 420;

            $row = $this->db["paintings"]->findByID($this->PaintingID);
        }

        $this->title = $row["Title"];
        $this->artistid = $row["ArtistID"];

        $nameRow = $this->db["artist"]->getName($this->artistid);


        if (($nameRow["FirstName"] != null) && ($nameRow["LastName"] != null)) {
            $this->artist = $nameRow["FirstName"] . " " . $nameRow["LastName"];
        } else {

            if ($nameRow["FirstName"] != null) {
                $this->artist .= $nameRow["FirstName"];
            }


            if ($nameRow["LastName"] != null) {
                $this->artist .= $nameRow["LastName"];
            }
        }




        $this->excerpt = $row["Excerpt"];
        $this->description = $row["Description"];
        $this->yearofwork = $row["YearOfWork"];
        $this->width = $row["Width"];
        $this->height = $row["Height"];
        $this->medium = $row["Medium"];
        $this->msrp = $row["MSRP"];


        $this->googleLink = $row["GoogleLink"];


        $this->googleText = $row["GoogleDescription"];


        $this->wikiLink = $row["WikiLink"];


        $this->museumLink = $row["MuseumLink"];
        $this->accessionNo = $row["AccessionNumber"];
        $this->copyrightText = $row["CopyrightText"];
        $this->imagefilename = $row["ImageFileName"];
        $this->galleryID = $row["GalleryID"];
    }

    /**
     * @return STRING image file name
     */
    public function getImagefilename()
    {
        return $this->imagefilename;
    }


    /**
     * @return STRING accession number
     */
    public function getAccessionNo()
    {
        if ($this->accessionNo == '' || $this->accessionNo == null)
            $this->accessionNo = 'No information avaliable';
        return $this->utf8_Validate($this->accessionNo);
    }

    /**
     * @return String museum link
     */
    public function getMuseumLink()
    {

        if ($this->museumLink == '' || $this->museumLink == null)
            $output = 'No link available';
        else
            $output = '<a href="' . $this->museumLink . '">View
                                    painting at museum site</a>';
        return $this->utf8_Validate($output);
    }

    /**
     * @return STRING copyright text
     */
    public function getCopyrightText()
    {
        if ($this->copyrightText == '' || $this->copyrightText == null) {
            $this->copyrightText = 'No information avaliable';
        }
        return $this->utf8_Validate($this->copyrightText);
    }


    /**
     * @return String wiki link
     */
    public function generateWikiLink()
    {
        $output = '';
        if ($this->wikiLink != '' && $this->wikiLink != null)
            $output = '<tr>
                        <td>
                            Wikipedia Link
                        </td>
                        <td>
                            <a href="' . $this->wikiLink . '">View painting on Wikipedia</a>
                        </td>
                    </tr>';
        return $this->utf8_Validate($output);
    }

    /**
     * @return STRING google link
     */
    public function generateGoogleLink()
    {
        $output = '';
        if ($this->googleLink != '' && $this->googleLink != null)
            $output = '<tr>
                        <td>
                            Google Link
                        </td>
                        <td>
                            <a href="' . $this->googleLink . '">View painting on Google Art Project</a>
                        </td>
                    </tr>';
        return $this->utf8_Validate($output);
    }

    /**
     * @return STRING google text
     */
    public function generateGoogleText()
    {
        $output = '';
        if ($this->googleText != '' && $this->googleText != null)
            $output = '<tr>
                        <td>
                            Google Text
                        </td>
                        <td>
                            ' . $this->googleText . '
                        </td>
                    </tr>';
        return $this->utf8_Validate($output);
    }


    /**
     * @return STRING msrp, the price
     */
    public function getMsrp()
    {
        return (int)$this->msrp;
    }


    /**
     * @return STRING medium text
     */
    public function getMedium()
    {
        return $this->medium;
    }

    /**
     * @return STRNG width text
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return STRING height text
     */
    public function getHeight()
    {
        return $this->height;
    }


    /**
     * @return STRING year of work text
     */
    public function getYearofwork()
    {
        return $this->yearofwork;
    }

    /**
     * @return STRING title text
     */
    public function getTitle()
    {
        return $this->utf8_Validate($this->title);
    }

    /**
     * @return STRING excerpt text
     */
    public function getExcerpt()
    {
        return $this->utf8_Validate($this->excerpt);
    }

    /**
     * @return string description text
     */
    public function getDescription()
    {
        if ($this->description == '')
            $this->description = 'No description avaliable';
        return $this->utf8_Validate($this->description);
    }

    /**
     * @return string artist name
     */
    public function getArtist()
    {
        return $this->utf8_Validate($this->artist);
    }


    /**
     * @return STRING artist id
     */
    public function getArtistID()
    {
        return $this->artistid;
    }

    /**
     * Generate html for frame list
     * @return string HTML of generated frame list
     */
    public function generateFrameList($selected = null)
    {
        $output = '';
        $row = $this->db['frame']->getAllSorted();
        $default = 0;
        if ($selected == null) {
            $default = $this->db["frame"]->getHighestID()["FrameID"];
        }


        for ($i = 0; $i < count($row); $i++) {
            if ($selected == null)
                if ($row[$i][0] == $default)
                    $output .= "<option selected value ='" . $row[$i][0] . "'>" . $row[$i][1] . "</option>";
                else
                    $output .= "<option value ='" . $row[$i][0] . "'>" . $row[$i][1] . "</option>";
            else {
                if ($row[$i][0] == $selected)
                    $output .= "<option selected value ='" . $row[$i][0] . "'>" . $row[$i][1] . "</option>";
                else
                    $output .= "<option value ='" . $row[$i][0] . "'>" . $row[$i][1] . "</option>";
            }
        }


        return $output;

    }


    /**
     * Generate html for glass list
     * @return string HTML glass list
     */
    public function generateGlassList($selected = null)
    {
        $output = '';
        $row = $this->db['glass']->getAllSorted();
        $default = 0;
        if ($selected == null) {
            $default = $this->db["glass"]->getHighestID()["GlassID"];
        }


        for ($i = 0; $i < count($row); $i++) {
            if ($selected == null)
                if ($row[$i][0] == $default)
                    $output .= "<option selected value ='" . $row[$i][0] . "'>" . $row[$i][1] . "</option>";
                else
                    $output .= "<option value ='" . $row[$i][0] . "'>" . $row[$i][1] . "</option>";
            else {
                if ($row[$i][0] == $selected)
                    $output .= "<option selected value ='" . $row[$i][0] . "'>" . $row[$i][1] . "</option>";
                else
                    $output .= "<option value ='" . $row[$i][0] . "'>" . $row[$i][1] . "</option>";
            }
        }


        return $output;

    }


    /**
     * Generate HTML for matt list
     * @return string generated HTML
     */
    public function generateMattList($selected = null)
    {
        $output = '';
        $row = $this->db['matt']->getAllSorted();
        $default = 0;
        if ($selected == null) {
            $default = $this->db["matt"]->getHighestID()["MattID"];
        }


        for ($i = 0; $i < count($row); $i++) {
            if ($selected == null)
                if ($row[$i][0] == $default)
                    $output .= "<option selected value ='" . $row[$i][0] . "'>" . $row[$i][1] . "</option>";
                else
                    $output .= "<option value ='" . $row[$i][0] . "'>" . $row[$i][1] . "</option>";
            else {
                if ($row[$i][0] == $selected)
                    $output .= "<option selected value ='" . $row[$i][0] . "'>" . $row[$i][1] . "</option>";
                else
                    $output .= "<option value ='" . $row[$i][0] . "'>" . $row[$i][1] . "</option>";
            }
        }


        return $output;

    }

    /**
     * Generate html for review list
     * @return string generated HTML
     */
    public function generateReviewList()
    {
        $row = $this->db['review']->getReviewsByPID($this->PaintingID);

        $output = '';
        foreach ($row as $rating) {

            $date = $rating['reviewdate'];

            $createDate = new DateTime($date);

            $stripDate = $createDate->format('m/d/Y');

            $output .= '
                    <div class="event">
                        <div class="content">
                            <div class="date">' . $stripDate . '</div>
                            <div class="meta">
                                <a class="like">
                ' . $this->ratingStarHelper($rating["rating"]) . '
                                </a>
                            </div>
                            <div class="summary">
' . utf8_encode($rating["comment"]) . '
                            </div>
                        </div>
                    </div>';

            if ($rating != end($row))
                $output .= '<div class="ui divider"></div>';

        }

        if ($output == '') {
            $output = '
                    <div class="event">
                        <div class="content">
                            <div class="summary">
No review avaliable
                            </div>
                        </div>
                    </div>';
        }

        return $output;
    }

    /**
     * @return string Museum name
     */
    public function getMuseum($GalleryID)
    {
        $row = $this->db['gallery']->getNameByID($this->galleryID);
        if (isset($row['GalleryName']) && !empty($row['GalleryName']))
            $output = $row['GalleryName'];
        else
            $output = 'No information avaliable';
        return $this->utf8_Validate($output);
    }

    /**
     * @return string generated HTML
     */
    public function generateGenreList()
    {
        $output = '';
        $row = $this->db['genre']->getGenreNameByPID($this->PaintingID);

        foreach ($row as $genre) {
            $output .= '                        
                        <li class="item"><a href="' . 'single-genre.php?GenreID=' . $genre['GenreID'] . '">' . $genre['GenreName'] . '</a></li>';
        }
        if ($output == '')
            $output = '<li class="item">No genre avaliable</li>';

        return $output;
    }

    /**
     * Generate rating stars
     * @param $stars amount of stars to use
     * @return string HTML of stars
     */
    private function ratingStarHelper($stars)
    {
        $output = '';
        for ($i = 0; $i < $stars; $i++) {
            $output .= '<i class="star icon"></i>';
        }


        return $output;
    }

    /**
     * @return string
     */
    public function generatePaintingRating()
    {
        $row = $this->db['review']->getRatings($this->PaintingID);
        $total = 0;
        $count = 0;

        foreach ($row as $rating) {

            $total += intval($rating[0]);
            $count++;
        }

        if ($count == 0) {
            $stars = 0;
        } else
            $stars = round($total / $count);

        $output = $this->ratingStarHelper($stars);
        return $output;
    }


    /**
     * @return int
     */
    public function getPaintingID()
    {
        return $this->PaintingID;
    }

    /**
     * @return mixed
     */
    public function getGalleryID()
    {
        return $this->galleryID;
    }






    //builds the subject field
    /**
     * @return string
     */
    public function getSubject()
    {
        $row = $this->db["subject"]->getSubjectIDFromPaintingID($this->PaintingID);


        $output = '';


        foreach ($row as $value) {

            $output .= '<li class="item"><a href="single-subject.php?SubjectID=' . $value["SubjectID"] . '">' . $this->db["subjectName"]->getNameByID($value["SubjectID"])["SubjectName"] . '</a></li>';


        }

        return $output;

    }




}