<?php

require('modele/modele.php');

function listPosts()
{
    $posts = getPosts();

    require('vue/accueil.php');
}

function post()
{   
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    require('vue/post.php');
}
// fonction pour ajouter les commentaires
function addComment($idArticle, $auteur, $contenu)
{
    $affectedLines = postComment($idArticle, $auteur, $contenu);

    if ($affectedLines === false) {
        die('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $idArticle);
    }
}
// vue pour voir tous les articles
function tabPosts()
{
    $posts = getPosts();

    require('vue/admin/voirArt.php');
}
// vue gestion des commentaires
function tabCom()
{
    $comments = getCom();

    require('vue/admin/gestCom.php');
}
// vue pour la modif d article
function frontModif()
{
        $post = getPost($_GET['id']);
        require('vue/admin/modArt.php');
}


