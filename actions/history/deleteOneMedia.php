<?php
session_start();
require_once('../../model/user.php');
require_once('../../model/historyMedia.php');

/***************************
 * ----- Delete one history media -----
 ***************************/

/**
 * @return string if ajax error
 * delete one history media search by id of the history and user id (user id not necessary)
 */
function deleteOneMedia()
{

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    if ($user_id) {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

        if ($user_id == '') {
            return 'Erreur serveur';
        }
        $id = $_POST['target'];
        echo $_POST['target'];
        echo $_SESSION['user_id'];
        $historyMedia = HistoryMedia::deleteOneHistoryMedia($id, $user_id);
    }
}

echo deleteOneMedia();


