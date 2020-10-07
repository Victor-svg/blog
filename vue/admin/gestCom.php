<?php $title = "Page de gestion des Articles"; ?>
<?php ob_start(); ?>

<header>
<h1>Page de gestion des commentaires</h1>
<?php require('vue/menu.php'); ?>
</header>

<section>
<div class="container">
      <h1>Tous les Commentaires</h1>
      <table class="tabVoirCom table table-striped">
        <thead>
          <tr>
            <th>Auteur</th>
            <th>Texte</th>
            <th>Date</th>
            <th>Signalements</th>
          </tr>
        </thead>
        <tbody>
          <tr>
<?php
	while ($comment = $comments->fetch())
	{
?>
            <td>  <?= htmlspecialchars($comment['auteur']) ?>      </td>
            <td> <?= nl2br(htmlspecialchars($comment['contenu'])) ?>       </td>
            <td> Le: <?= $comment['date_creation_fr']; ?>  </td>
            <td class="report"> <?= $comment['report']; ?> 
            <a href="index.php?action=deleteCom&amp;id=<?= $comment['id'] ?>" onclick="return confirm('Confimer la suppression ?')" class="delete"><i class="fas fa-trash-alt"></i></a> 
            </td>
          </tr>
<?php
	}
	$comments->closeCursor();
?>
        </tbody>
      </table>
</section>




<?php $content = ob_get_clean(); ?>
<?php require('vue/template.php'); ?>