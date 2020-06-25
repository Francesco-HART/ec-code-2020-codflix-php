<?php

require_once('database.php');

/**
 * Class HistoryEpisode model for history episode
 */
class HistoryEpisode
{


    protected $id;
    protected $user_id;
    protected $media_id;
    protected $episode_id;
    protected $start_date;
    protected $finish_date;
    protected $watch_duration;

    /**
     * HistoryEpisode constructor.
     * @param $history data for init start and finish
     * start_date and finish date are bool 0 or 1
     */
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

    public function setEpisodeId($idEpisode)
    {
        $this->id = $idEpisode;
    }

    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    public function setMediaId($media_id)
    {
        $this->media_id = $media_id;
    }

    public function setStartDate()
    {
        $this->start_date = 1;
    }

    public function setFinishDate()
    {
        $this->finish_date = 1;
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

    public function getEpisodeId()
    {
        return $this->$episode_id;
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
     * -------- request LIST --------
     ***************************/

    /**
     * @param $userId
     * @return array of history episode for one user
     */
    public static function getHistoryEpisodeById($userId): array
    {
        // Open database connection
        $db = init_db();
        $req = "SELECT he.id, he.media_id ,he.episode_id,title, type, summary, start_date, finish_date, watch_duration,episode.time, episode.saison, episode.episode ,genre.name FROM `media` 
                LEFT JOIN episode 
                ON media.id = episode.serie_id
                LEFT JOIN genre 
                ON genre.id = media.genre_id
                LEFT JOIN history_episode as he
                ON he.episode_id = episode.id
                WHERE user_id = " . $userId;
        $req = $db->prepare($req);
        $req->execute();
        // Close databse connection
        $db = null;
        return $req->fetchAll();
    }

    public static function getEpisode($episode, $saison, $media_id): array
    {
        // Open database connection
        $db = init_db();
        $req = "SELECT * FROM `episode` 
                WHERE saison = " . $saison . " AND   episode = " . $episode . " AND serie_id =" . $media_id;
        $req = $db->prepare($req);
        $req->execute();
        // Close databse connection
        $db = null;
        return $req->fetch();
    }

    /**
     * @param $userId
     * @return array
     * Delete  all history episode for one user
     */
    public static function deleteHistoryEpisode($userId)
    {
        // Open database connection
        $db = init_db();
        $req = "DELETE FROM `history_episode` WHERE user_id = " . $userId;
        echo $req;
        $req = $db->prepare($req);
        $req->execute();
        // Close database connection
        $db = null;

        return $req->fetchAll();
    }

    /**
     * @param $id
     * @param $user_id
     * @return array
     * Delete one history episode (user id not necessary)
     */

    public static function deleteOneHistoryEpisode($id, $user_id)
    {
// Open database connection
        $db = init_db();
        $req = $db->prepare("DELETE  FROM `history_episode` WHERE id = " . $id . " AND user_id = " . $user_id);
        $req->execute();
        // Close database connection
        $db = null;
        return $req->fetchAll();
    }

    /**
     * @param $user_id
     * @param $media_id
     * @param $episode_id
     * @param $watch_duration
     * @return array
     * Create one history episode
     */

    public static function setHistoryEpisode($user_id, $media_id, $episode, $saison, $watch_duration)
    {
// Open database connection
        $episode = self::getEpisode($episode, $saison, $media_id);
        $episode_id = $episode['id'];
        echo '<p>' . $episode_id . '</p>';
        $db = init_db();
        $req = "INSERT INTO history_episode (user_id, media_id,episode_id, watch_duration) VALUES
                ($user_id ,$media_id , $episode_id , ' $watch_duration ' )";
        $req = $db->prepare($req);
        $req->execute();
        // Close database connection
        $db = null;
    }

    /**
     * @param $id  of the history episode
     * @param $time_start
     * @param $time_finish
     * @param $watch_duration
     * @return array
     * when start video or stop video we update history episode time_start , watch_duration and time_finish
     */
    public static function UpdateHistory($id, $time_start, $time_finish, $watch_duration)
    {
// Open database connection
        $db = init_db();
        $req = "UPDATE `history_episode` SET `time_start`=" . $time_start . ", `time_finish`=" . $time_finish . ", `watch_duration`=" . $watch_duration . " WHERE id = " . $id;
        $req = $db->prepare($req);
        $req->execute();
        // Close database connection
        $db = null;
        return $req->fetchAll();
    }

    /**
     * @param $userId
     * @param $episode_id
     * @return bool true history exist fale history don't exist
     * verif if history for one episode exist
     * if exist whe don't create history we update juste history
     */
    public static function verifIfExist($userId, $saison, $episode, $media_id): bool
    {
        // Open database connection
        $episode_id = self::getEpisode($episode, $saison, $media_id);
        $db = init_db();
        $req = $db->prepare("SELECT * FROM `history_episode` WHERE user_id = " . $userId . " AND episode_id =" . $episode_id);
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