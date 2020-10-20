<?php

// Chargement des classes
require_once('modele/PostManager.php');
require_once('modele/CommentManager.php');
require_once('modele/AdminManager.php');

// voir tous les Articles
function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('vue/accueil.php');
}
// Page pour voir UN Article
function post()
{   
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('vue/post.php');
}
// fonction pour ajouter les commentaires
function addComment($idArticle, $auteur, $contenu)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($idArticle, $auteur, $contenu);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $idArticle);
        exit;
    }
}
// Report commentaire
function addReport($id)
{
    $commentManager = new CommentManager();
    $addRep = $commentManager->reportCom($_GET['id']);

    if ($addRep === false) {
        throw new Exception('Impossible de signaler !');
    }
    else {
        header('Location: index.php?');
        exit();      
    }
}