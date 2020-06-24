<?php
ob_start();
require './model/Tools.php';
?>
<div>
    <button>
        <a href="mailto:contact@codflix.com?subject = Feedback&body = Message">
            Nous contacter
        </a>
    </button>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('contactView.php'); ?>