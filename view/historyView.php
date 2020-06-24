<?php ob_start(); ?>
<?php   /**
Créer la page pour afficher l’historique (HTML et CSS)
● Afficher l’historique avec les informations de chaque stream
● Possibilité de supprimer un élément de l’historique
● Possibilité de supprimer l’intégralité de l’historique via un bouton “Supprimer mon
historique”
 **/?>

<div class="row">

</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
