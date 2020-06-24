<?php ob_start(); ?>
<?php /**
 * Créer la page pour afficher l’historique (HTML et CSS)
 * ● Afficher l’historique avec les informations de chaque stream
 * ● Possibilité de supprimer un élément de l’historique
 * ● Possibilité de supprimer l’intégralité de l’historique via un bouton “Supprimer mon
 * historique”
 **/ ?>
<?php
require_once('controller/historyController.php');
require_once('model/historyMedia.php');
require_once('model/historyEpisode.php');
?>

<div class="row">
    <script type="text/javascript" src="jquery-3.2.1.min.js">
        let isDelete = false


        function handleDeleteOne() {
            $.ajax({
                url: "./action/history/deleteAll.php",
                type: "DELETE",
                cache: false,
                success: function (response) {
                    $('#thenode').html(response);
                }
            });
        }

        function handleDeleteAll() {
            console.log('hello')
            $.ajax({
                url: "./action/history/deleteAll.php",
                type: "DELETE",
                cache: false,
                success: function (response) {
                    $('#thenode').html(response);
                }
            });
        }

    </script>
    <button onclick="handleDeleteAll()">delete all</button>

</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
