<?php
session_start();
require_once('../../model/user.php');
require_once('../../model/historyEpisode.php');
require_once('../../model/historyMedia.php');

function deleteAll()
{
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    if ($user_id) {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

        if ($user_id == '') {
            return 'Erreur serveur';
        }
        echo $_SESSION['user_id'];
        $historyMedia = HistoryMedia::deleteHistoryMedia($_SESSION['user_id']);
        $historyEpisode = HistoryEpisode::deleteHistoryEpisode($_SESSION['user_id']);
    }
}

echo deleteAll();





