<?php $title = "Modifier vos Articles"; ?>

<?php ob_start(); ?>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ 
        selector:'textarea',
        plugins: [
            'advlist autolink link image lists charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'table emoticons template paste help'
        ],
        toolbar: 
            'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | link image | print preview media fullpage | ' +
            'forecolor backcolor emoticons | help',
        menu: {
        favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
            },
        menubar: 'favs file edit view insert format tools table help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'

    });
    </script>
<header>
    <?php require('vue/menu.php'); ?>
    <h1> Modifier vos Article </h1>
</header>

<section id="addArt">
        
    <div class="ajouter col-sm-6 col-md-6 col-lg-6">


        <form action="index.php?action=modifArt&amp;id=<?= $post['id'] ?>" method="post">
            <div class="form-group">
                <label for="titre">Titre de l'article</label> <br />
                <input type="text" class="titleArt form-control-sm" id="titre_article" name="titre_article"  value="<?= $post['title']; ?>"/>
            </div>
            <div class="form-group">
                <label for="texte">Texte de l'article</label><br />
                <textarea id="texte_article" class="txtArt form-control-md" name="texte_article">
                <?= $post['text']; ?>
                </textarea>
            </div>
                <input type="submit" />
            </div>
        </form>
    </div>
</section>






<?php $content = ob_get_clean(); ?>
<?php require('vue/template.php'); ?>