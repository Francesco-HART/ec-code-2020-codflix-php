<?php

require_once('model/user.php');
require_once('model/historyMedia.php');
require_once('model/historyEpisode.php');

/***************************
 * ----- LOAD history PAGE -----
 ***************************/
/**
 * set history media and episode for show all user history in the view
 * verif if user is connect
 */
function historyPage()
{
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    if ($user_id) {
        $historyMedia = HistoryMedia::getHistoryMediaById($user_id);
        $historyEpisode = HistoryEpisode::getHistoryEpisodeById($user_id);
        require('view/historyView.php');
    } else {
        require('view/homeView.php');
    }
}
