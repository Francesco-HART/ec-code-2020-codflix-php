<?php
ob_start();
require './model/Tools.php';
?>
<div>

    <form method="post" action="index.php?action=login" class="custom-form">
        <script type="text/javascript">
            onChangeSaison = (e) => {
                const saisonNumber = e.target.value
                console.log(saisonNumber)
            }

        </script>
        <select onchange="onChangeSaison()">
            <?php
            foreach ($saisons as $saison => $value) {
                echo "<option value='" . $value["saison"] . "'>" . $value["saison"] . "</option> ";
            }
            ?>
        </select>


        <select name='episodes'>
            <?php
            foreach ($episodes[0] as $key => $value) {
                echo "<option value='" . $value["episode"] . "'>" . $value["episode"] . "</option> ";
            }
            ?>
        </select>
    </form>

    <div class="col-xs-12 col-md-6">
        <div class="title"><?= $mediaInfos['title']; ?> </div>
        <div style="position: fixed; z-index: -99; width: 100%; height: 100%">
            <iframe frameborder="0" height="100%" width="100%"
                    src="<?= $mediaInfos["trailer_url"]; ?>">
            </iframe>

        </div>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
