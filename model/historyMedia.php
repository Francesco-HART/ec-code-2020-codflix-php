<?php

require_once('database.php');

class HistoryMedia
{


    protected $id;
    protected $user_id;
    protected $media_id;
    protected $start_date;
    protected $finish_date;
    protected $watch_duration;

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

    public function setWatchDuration($watchDuration)
    {
        $this->watch_duration = $watchDuration;
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

    public function getWatchDuration()
    {
        return $this->watch_duration;
    }


    /***************************
     * -------- GET LIST --------
     ***************************/

    public static function getHistoryMediaById($userId): array
    {
        // Open database connection

        $db = init_db();
        $req = "SELECT  hm.id, hm.media_id ,title ,title, type, summary, start_date, finish_date, watch_duration, genre.name FROM `media` 
                LEFT JOIN genre 
                ON genre.id = media.genre_id
                LEFT JOIN history_media as hm
                ON hm.media_id = media.id
                WHERE user_id = " . $userId;
        $req = $db->prepare($req);
        $req->execute();
        // Close databse connection
        $db = null;
        return $req->fetchAll();
    }


    public static function deleteHistoryMedia($userId)
    {
// Open database connection
        $db = init_db();
        $req = $db->prepare("DELETE FROM `history_media` WHERE user_id = " . $userId);
        $req->execute();
        // Close database connection
        $db = null;

        return $req->fetchAll();
    }


    public static function deleteOneHistoryMedia($id, $idMedia)
    {
// Open database connection
        $db = init_db();
        $req = $db->prepare("SELECT * FROM history_media WHERE id = " . $id . " WHERE id_media = " . $idMedia);
        $req->execute();
        // Close database connection
        $db = null;

        return $req->fetchAll();
    }


    public static function setHistoriqueMedia($user_id, $media_id, $time_start, $time_finish, $watch_duration)
    {
// Open database connection
        $db = init_db();
        $req = "INSERT INTO history_media (user_id, media_id, start_date, finish_date, watch_duration) VALUES
                (' . $user_id . ', ' . $media_id . ',' . $time_start . ',' . $time_finish . ', ' . $watch_duration . ' )";
        $req = $db->prepare();
        $req->execute();
        // Close database connection
        $db = null;
        return $req->fetchAll();
    }

    public static function verifIfExist($userId, $media_id): bool
    {
        // Open database connection
        $db = init_db();
        $req = $db->prepare("SELECT * FROM `history_media` WHERE user_id = " . $userId . " WHERE media_id =" . $media_id);
        $req->execute();
        // Close databse connection
        $db = null;
        $res = $req->fetchAll();
        if (empty($res)) {
            return true;
        }
        return false;
    }


}

?>