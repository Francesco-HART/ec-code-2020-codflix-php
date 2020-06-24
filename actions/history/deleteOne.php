<?php

require_once('model/user.php');
require_once('model/historyMedia.php');
require_once('model/historyEpisode.php');

/***************************
 * ----- Delete one history -----
 ***************************/


function deleteOne($idStream, $type)
{
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    if ($user_id) {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

        if ($user_id == '' || $idStream == '' || $type == '') {
            return 'Erreur serveur';
        }
        $type === 'Flim' ?
            $historyMediaDelete = HistoryMedia::deleteOneHistoryMedia($user_id, $idStream)
            :
            $historyEpisodeDelete = HistoryEpisode::deleteOneHistoryEpisode($user_id, $idStream);
    }
}


