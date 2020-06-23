<?php ob_start(); ?>
<div>
    <?php foreach ($mediaInfos as $media): ?>
        <div class="col-xs-12 col-md-6">
            <div class="title"><?= $media['title']; ?> </div>
            <div style="position: fixed; z-index: -99; width: 100%; height: 100%">
                <iframe frameborder="0" height="100%" width="100%"
                        src="<?= $media["trailer_url"]; ?>">
                </iframe>

            </div>
        </div>
    <?php endforeach; ?>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
