<?php $title = 'Accueil'; ?>
<?php ob_start(); ?>
<section>
	<div class="container">
		<div class="row">
<?php
		while ($data = $posts->fetch())
		{
?>
		<div class="art col-md-5">
			<h3>
				<?= $data['title']; ?>
				<hr>
			</h3>
			<p>
				<?= $data['text']; ?>
			</p>
				 <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btnArt">Lire la suite...</a>
		</div>
<?php
		}
	$posts->closeCursor();
?>
		</div>
	</div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
