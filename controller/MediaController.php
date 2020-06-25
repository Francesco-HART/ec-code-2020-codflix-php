<?php

require_once('model/media.php');

/***************************
 * ----- LOAD Media PAGE -----
 ***************************/
/**
 * verif if connect if not connect redirect to homeView
 * if connect verif if action media is start
 * if is action media we get media by id
 * if media type === series we create tab of episode
 *
 * we search episode group by saison and create array where index === saison - 1
 * And all episode of the saison are stocked on one tab
 *
 * if not episode we return juste the media seached
 */
function mediaPage()
{
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

    if ($user_id) {
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
    } else {
        require('view/homeView.php');
    }
}


