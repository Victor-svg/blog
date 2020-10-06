<?php $title = 'Page connexion'; ?>

<?php ob_start(); ?>
<header>
<?php require('vue/menu.php'); ?>
    <h1>Espace Connexion</h1>
</header>

<section>
    <div class="conecForm col-sm-6 col-md-4 col-lg-4">
        <form action="index.php?action=admin" method="post">
            <div class="form-group">
                <label for="email">Email</label> <br />
                <input type="text" class="form-control-sm" id="email" name="email" />
            </div>
            <div class="form-group">
                <label for="password">Mot de Pass</label><br />
                <input type="password" class="form-control-md" id="pass" name="pass"> 
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
    </div>
</section>








<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>