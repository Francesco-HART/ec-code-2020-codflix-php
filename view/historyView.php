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
    <script type="text/javascript">

        function handleDeleteOneMedia(target) {
            $.ajax({
                type: "POST",
                url: "./actions/history/deleteOneMedia.php",
                cache: false,
                data: {'target': target.value},
                success: function (response) {
                    console.log(response)
                    window.location.reload()
                }
            });

        }

        function handleDeleteOneEpisode(target) {

            $.ajax({
                type: "POST",
                url: "./actions/history/deleteOneEpisode.php",
                cache: false,
                data: {'target': target.value},
                success: function (response) {
                    console.log(response)
                    window.location.reload()
                }
            });


        }


        function handleDeleteAll() {
            $.ajax({
                url: "./actions/history/deleteAll.php",
                cache: false,

                success: function (response) {
                    console.log(response)

                    window.location.reload()

                }
            });
        }

    </script>
    <button onclick="handleDeleteAll()">delete all</button>
    <?php
    foreach ($historyMedia as $saison => $value) {
        echo '<p>' . $value['title'] . '</p> <input type="button" value= ' . $value['id'] . ' onclick="handleDeleteOneMedia(this)">delete</input>';
    }
    foreach ($historyEpisode as $saison => $value) {
        echo '<p>' . $value['name'] . '</p> <input type="button" value= ' . $value['id'] . ' onclick="handleDeleteOneEpisode(this)">delete</button>';;
    }
    ?>

</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
