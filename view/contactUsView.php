<?php
ob_start();
?>
<div>
    <button>
        <a href="mailto:contact@codflix.com?subject = Feedback&body = Message">
            Nous contacter
        </a>
    </button>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>