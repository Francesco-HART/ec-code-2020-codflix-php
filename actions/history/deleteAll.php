
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<?php

require_once('model/user.php');
require_once('model/historyMedia.php');
require_once('model/historyEpisode.php');

/***************************
 * ----- Delete all history -----
 ***************************/

function deleteAll()
{
    echo '<p>iciii</p>';
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    if ($user_id) {
        if ($user_id == '') {
            return 'Erreur serveur';
        }
        echo '<p>iciiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii</p>';
    }
}

echo deleteAll();

?>



