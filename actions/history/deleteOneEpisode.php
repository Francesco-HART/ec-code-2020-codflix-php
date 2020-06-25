<?php
session_start();
require_once('../../model/user.php');
require_once('../../model/historyEpisode.php');

/***************************
 * ----- Delete one history -----
 ***************************/


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
        $historyMedia = HistoryEpisode::deleteOneHistoryEpisode($id, $user_id);
    }
}

echo deleteOneEpisode();


