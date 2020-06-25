<?php

require_once('database.php');

/**
 * Class Media for create one media
 */
class Media
{

    protected $id;
    protected $genre_id;
    protected $title;
    protected $type;
    protected $status;
    protected $release_date;
    protected $summary;
    protected $trailer_url;

    public function __construct($media)
    {

        $this->setId(isset($media->id) ? $media->id : null);
        $this->setGenreId($media->genre_id);
        $this->setTitle($media->title);
    }

    /***************************
     * -------- SETTERS ---------
     ***************************/

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setGenreId($genre_id)
    {
        $this->genre_id = $genre_id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setReleaseDate($release_date)
    {
        $this->release_date = $release_date;
    }

    /***************************
     * -------- GETTERS ---------
     ***************************/

    public function getId()
    {
        return $this->id;
    }

    public function getGenreId()
    {
        return $this->genre_id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getReleaseDate()
    {
        return $this->release_date;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function getTrailerUrl()
    {
        return $this->trailer_url;
    }

    /***************************
     * -------- Request LIST --------
     ***************************/

    /**
     * @param $title
     * @return array
     * first page request for filter media by title
     */
    public static function filterMedias($title): array
    {
        // Open database connection
        $db = init_db();
        $req = $db->prepare("SELECT * FROM media WHERE title LIKE " . '"%' . $title . '%"' . " ORDER BY release_date DESC");
        $req->execute();
        // Close databse connection
        $db = null;
        return $req->fetchAll();
    }

    /**
     * @param $id
     * @return array
     * get one media
     */

    public static function getMediaById($id): array
    {
        // Open database connection
        $db = init_db();
        $req = $db->prepare("SELECT * FROM media WHERE id = " . $id);
        $req->execute();
        // Close databse connection
        $db = null;
        return $req->fetch();
    }

    /**
     * @param $id
     * @return mixed
     * get media genre
     */

    public static function getMediaGenderById($id)
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM genre WHERE id = " . $id;
        $req = $db->prepare($sql);
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetch();
    }

    /**
     * @return mixed get all series
     */

    public static function getSeries()
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM serie ";
        $req = $db->prepare($sql);
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetch();
    }

    /**
     * @param $id
     * @param $saison
     * @return array
     * get all episode for one saison of one serie
     */
    public static function getEpisodesBySaisonId($id, $saison)
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM episode WHERE serie_id = " . $id . " AND saison = " . $saison;
        $req = $db->prepare($sql);
        $req->execute();

        // Close database connection
        $db = null;
        return $req->fetchAll();
    }

    /**
     * @param $id
     * @return array
     * get all episode of one serie group by saison
     */
    public static function getSaisonsByMediaId($id)
    {
// Open database connection
        $db = init_db();
        $req = $db->prepare("SELECT * FROM episode WHERE serie_id = " . $id . " GROUP BY saison");
        $req->execute();
        // Close database connection
        $db = null;

        return $req->fetchAll();
    }
}

?>