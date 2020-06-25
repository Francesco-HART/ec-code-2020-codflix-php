<?php

require_once('model/user.php');
require_once('model/historyMedia.php');
require_once('model/historyEpisode.php');

/***************************
 * ----- LOAD history PAGE -----
 ***************************/

function historyPage()
{
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    if ($user_id) {
        $historyMedia = HistoryMedia::getHistoryMediaById($user_id);
        $historyEpisode = HistoryEpisode::getHistoryEpisodeById($user_id);
        echo '<p>' . $user_id . '</p>';
        foreach ($historyMedia as $saison => $value) {
            echo '<p>' . $value['media_id'] . '</p>';
        }

        require('view/historyView.php');
    }
}
