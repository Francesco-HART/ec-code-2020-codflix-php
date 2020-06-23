<?php
ob_start();
require './model/Tools.php';
?>
<div>

    <?php
    echo '<p>' . $_GET[0] . '</p>';
    echo "<select name=episodes>";
    foreach ($episodes as $episode => $value) {
        echo "<option value='" . $value["saison"] . "'>" . $value["saison"] . "</option> ";
    }
    echo "</select>";

    echo "<select name=episodes>";
    foreach ($saisons as $saison => $value) {
        echo "<option value='" . $value["saison"] . "'>" . $value["saison"] . "</option> ";
    }
    echo "</select>";
    ?>
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
