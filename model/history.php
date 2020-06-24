<?php

require_once('database.php');

class History
{


    protected $id;
    protected $user_id;
    protected $media_id;
    protected $start_date;
    protected $finish_date;

    public function __construct($history)
    {
        $this->setId(isset($history->id) ? $history->id : null);
        $this->setStartDate($history->start_date);
        $this->setFinishDate($history->finish_date);
    }

    /***************************
     * -------- SETTERS ---------
     ***************************/

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    public function setMediaId($media_id)
    {
        $this->media_id = $media_id;
    }

    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;
    }

    public function setFinishDate($finishDate)
    {
        $this->finish_date = $finishDate;
    }


    /***************************
     * -------- GETTERS ---------
     ***************************/

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getMediaId()
    {
        return $this->media_id;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function getFinishDate()
    {
        return $this->finish_date;
    }


    /***************************
     * -------- GET LIST --------
     ***************************/

    public static function getHistoryById($userId, $historyId): array
    {
        // Open database connection
        $db = init_db();
        $req = $db->prepare("DELETE FROM `history` WHERE user_id = " . $userId . " AND id =" . $historyId);
        $req->execute();
        // Close databse connection
        $db = null;
        return $req->fetchAll();
    }

    public static function deleteHistory($userId)
    {
// Open database connection
        $db = init_db();
        $req = $db->prepare("DELETE FROM `history` WHERE user_id = " . $userId);
        $req->execute();
        // Close database connection
        $db = null;

        return $req->fetchAll();
    }

    public static function deleteOneHistory($userId, $historyId)
    {
// Open database connection
        $db = init_db();
        $req = $db->prepare("SELECT * FROM series WHERE serie_id = " . $id . " GROUP BY saison");
        $req->execute();
        // Close database connection
        $db = null;

        return $req->fetchAll();
    }
}

?>