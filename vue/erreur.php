<?php $title = 'Page Erreur'; ?>
<?php ob_start(); ?>
<header>
    <?php require('vue/menu.php'); ?>
        <h1> <?php echo $errorMessage; ?> </br>
            <a href="index.php?"> <i class="far fa-arrow-alt-circle-right"></i>  
                Revenir à la page d'Accueil      
            <i class="far fa-arrow-alt-circle-left"></i>
        </h1>
    </header>
<section>

</section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>