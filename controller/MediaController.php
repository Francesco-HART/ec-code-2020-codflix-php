<?php

require_once('model/media.php');

/***************************
 * ----- LOAD HOME PAGE -----
 ***************************/

function mediaPage()
{
    if (isset($_GET['media'])) {
        $mediaInfos = Media::getMediaById($_GET['media']);
        $mediaGender = Media:: getMediaGenderById($_GET['media']);
        require('view/mediaInfo.php');
    } else {
        $search = isset($_GET['title']) ? $_GET['title'] : null;
        $medias = Media::filterMedias($search);
        require('view/mediaListView.php');
    }
}


