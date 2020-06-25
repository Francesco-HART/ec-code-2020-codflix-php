<?php
session_start();
require_once('../../model/user.php');
require_once('../../model/historyEpisode.php');

/***************************
 * ----- Create one history -----
 ***************************/
/**

 Request call by ajax in mediaInfo for create one historyEpisode if user is connect and

 **/

function deleteOneEpisode()
{
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    if ($user_id) {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

        if ($user_id == '') {
            return 'Erreur serveur';
        }
        $id = $_POST['target'];
        echo $_SESSION['user_id'];
        $historyMedia = HistoryEpisode::setHistoriqueEpisode($_POST['user_id'], $_POST['media_id'], $_POST['episode_id'], $_POST['time_start'], $_POST['time_finish'], $_POST['watch_duration']);
    }
}

echo deleteOneEpisode();


