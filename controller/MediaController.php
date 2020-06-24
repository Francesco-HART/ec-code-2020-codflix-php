<?php

require_once('model/media.php');

/***************************
 * ----- LOAD HOME PAGE -----
 ***************************/

function mediaPage()
{
    if (isset($_GET['media'])) {

        $mediaInfos = Media::getMediaById($_GET['media']);
        $saisons = [];
        $episodes = [];
        if ($mediaInfos['type'] === 'Serie') {

            $saisons = Media::getSaisonsByMediaId($_GET['media']);
            //init array key = saison value = episode
            foreach ($saisons as $saison => $value) {
                $searchedEpisodes = Media::getEpisodesBySaisonId($_GET['media'], $value["saison"]);
                array_push($episodes, $searchedEpisodes);
            }
        }
        $mediaGender = Media::getMediaGenderById($_GET['media']);
        require('view/mediaInfo.php');
    } else {
        $search = isset($_GET['title']) ? $_GET['title'] : null;
        $medias = Media::filterMedias($search);
        require('view/mediaListView.php');
    }
}


