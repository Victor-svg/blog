<?php

require('modele/modele.php');
// voir tous les Articles
function listPosts()
{
    $posts = getPosts();

    require('vue/accueil.php');
}
// Page pour voir UN Article
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
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $idArticle);
    }
}
// vue Admin pour voir la page tous les articles
function tabPosts()
{
    $posts = getPosts();

    require('vue/admin/voirArt.php');
}
// vue Admin gestion des commentaires
function tabCom()
{
    $comments = getCom();

    require('vue/admin/gestCom.php');
}
// vue Admin pour la modif d article
function frontModif()
{
        $post = getPost($_GET['id']);
        require('vue/admin/modArt.php');
}


