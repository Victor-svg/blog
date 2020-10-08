<?php $title = "Tableau de Bord"; ?>
<?php 
  ob_start(); 
?>
<section>
<h4>
    <?php echo 'Bienvenu sur votre Tableau de Bord Monsieur ' . $_SESSION['pseudo'];
    ?>
</h4>
<nav class="nav_tab col-sm-4 flex-column">
  <a class="nav-link active" href="index.php?action=addPost"><i class="far fa-edit"></i>  Ajouter un Article</a>
  <a class="nav-link" href="index.php?action=voirArt.php"><i class="far fa-eye"></i>  Voir tous les Articles</a>
  <a class="nav-link" href="index.php?action=gestCom.php"><i class="far fa-comments"></i>  Gerer les commentaires</a>
</nav>
</section>






<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>