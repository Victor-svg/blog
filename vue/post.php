<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<div class="art mx-auto col-md-5">
    <h3>
        <?= $post['title']; ?>
        <hr>
    </h3> 
    <p class="articleTxt">
        <?= $post['text']; ?>
    </p>
</div>

<div class="spaceCom col-sm-6 col-md-5 col-lg-4 col-xl-3">
    <h2> Commentaires </h2>
    <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
        <div class="form-group">
            <label for="auteur">Auteur</label> <br />
            <input type="text" class="form-control-sm" id="auteur" name="auteur" />
        </div>
        <div class="form-group">
            <label for="contenu">Commentaire</label><br />
            <textarea id="contenu" class="form-control-md" name="contenu"></textarea>
        </div>
            <input type="submit" onclick="return confirm('Publier ?')"/>
        </div>
    </form>
</div>

<div class="comZone col-sm-6 col-md-5 col-lg-4 col-xl-3">
    <?php
    while ($comment = $comments->fetch())
    {
        $commentId = $comment['id'];
    ?>
        <p><strong><?= htmlspecialchars($comment['auteur']) ?></strong> le <?= $comment['date_creation_fr'] ?> </p>
        <form action="index.php?action=addReport&amp;id=<?= $commentId ?>" method="post">
            <button type="submit" id="report" onclick="return confirm('Signaler ce commentaire ?')">  <i class="fas fa-ban"></i> </button>
        </form>
        <p>
            <?= nl2br(htmlspecialchars($comment['contenu'])) ?> 
        </p>
        <hr>
        
    <?php
    }
    ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
