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
    <div class="container-fluid">
        <div class=" col-xs-12 col-md-12">
            <button type="button" class="btn btn-block"
                    style="margin-bottom: 10px; background: var(--color-red)"
                    onclick=" handleDeleteAll()"

            >
                Supprimer les historiques
            </button>
        </div>
        <div class=" col-xs-12 col-md-12">
            <table class="table table-hover">
                <h3 style="text-align: center; margin-top: 10px"> Série </h3>
                <thead>
                <?php
                foreach ($historyEpisode as $saison => $value) {
                    echo '<tr >';
                    echo '<th scope="col">' . $value['title'] . '</th>';
                    echo '<th scope="col">' . $value['name'] . '</th>';
                    echo '<th scope="col"> Saison ' . $value['saison'] . '</th>';
                    echo '<th scope="col"> Episode ' . $value['episode'] . '</th>';
                    echo '<th scope="col">';
                    echo $value['start_date'] === 1 ? 'durée de visionnage' . $value['watch_duration'] : '';
                    echo '</th >';
                    echo '<th scope="col"> Supprimer de l\'historique <input  style="background: var(--color-red)" type="button" class="btn" value= ' . $value['id'] . ' onclick="handleDeleteOneEpisode(this)"></input></th>';
                    echo '</tr>';
                }
                ?>
        </div>
        <div class=" col-xs-12 col-md-12">
            <table class="table table-hover">
                <h3 style="text-align: center; margin-top: 10px"> Film </h3>
                <thead>
                <?php
                foreach ($historyMedia as $saison => $value) {
                    echo '<tr>';
                    echo '<th scope="col">' . $value['title'] . '</th>';
                    echo '<th scope="col">' . $value['name'] . '</th>';
                    echo '<th scope="col">';
                    echo $value['start_date'] === 1 ? 'durée de visionnage' . $value['watch_duration'] : '';
                    echo '</th>';
                    echo '<th scope="col"> Supprimer de l\'historique <input style="background: var(--color-red)"
                    type="button" class="btn " value= ' . $value['id'] . ' onclick="handleDeleteOneMedia(this)"></input> </th>';
                    echo '</tr>';

                }
                ?>
                </thead>
            </table>
        </div>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
