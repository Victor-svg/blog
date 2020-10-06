<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<header>
<?php require('vue/menu.php'); ?>
    <h1>Blog de Jean Forteroche</h1>
    <h2>Billet simple pour l'Alaska</h2>
</header>
<section>
	<div class="container">
		<div class="row">
<?php
		while ($data = $posts->fetch())
		{
?>
		<div class="art col-md-4">
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
