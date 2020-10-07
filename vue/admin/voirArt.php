<?php $title = "Tous les Articles"; ?>
<?php ob_start(); ?>

<header>
<h1>Vos Articles :</h1>
<?php require('vue/menu.php'); ?>
</header>

<section>
<div class="container">
      <h1>Tous vos Articles</h1>
      <table class="tabVoirArt table table-striped">
        <thead>
          <tr>
            <th>Titre</th>
            <th>Texte</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <tr>
<?php
	while ($data = $posts->fetch())
	{
?>
            <td>  
              <?= $data['title']; ?> 
              <a href="index.php?action=vueModif&amp;id=<?= $data['id'] ?>" class="modif"><i class="far fa-edit"></i>Modifier</a>
              <a href="index.php?action=deleteArt&amp;id=<?= $data['id'] ?>" onclick="return confirm('Confimer la suppression ?')" class="delete"><i class="fas fa-trash-alt"></i>Supprimer</a>    
            </td>
            <td> 
              <?= $data['text']; ?>
            </td>
            
            <td> Le: <?= $data['date_creation_fr']; ?>  
            </td>
          </tr>
<?php
	}
	$posts->closeCursor();
?>
        </tbody>
      </table>
</section>




<?php $content = ob_get_clean(); ?>
<?php require('vue/template.php'); ?>