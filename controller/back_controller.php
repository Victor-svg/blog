<?php
require_once('modele/PostManager.php');
require_once('modele/CommentManager.php');
require_once('modele/AdminManager.php');

// Connexion Admin
function connect($email, $pass) {

    $adminManager = new AdminManager();
    $user = $adminManager->getUser($email, $pass);

    if($user == true){
        require('vue/admin.php');
    }
    else {
      ?> <script>alert ('mauvais identifiant ou mot de passe'); </script> <?php
       require('vue/connexion.php');
    }
}
// Ajouter un Article
function addPost($idArticle, $titre, $texte)
{
    $adminManager = new AdminManager();
    $add = $adminManager->addArticle($idArticle, $titre, $texte);

    if ($add === false) {
        throw new Exception("Impossible d'ajouter l'article !");
    }
    else {
        header('Location: index.php?action=voirArt.php');
        exit;
    }
}
// Modifier un article
function modifArt($idArticle, $titre, $texte)
{
    $adminManager = new AdminManager();
    $modifLines = $adminManager->modArt($idArticle, $titre, $texte);

    if ($modifLines === false) {
        throw new Exception("Impossible de modifier l'article !");
    }
    else {
        header('Location: index.php?action=post&id=' . $idArticle);
        exit;
    }
}
// supprimer un article
function deletArt()
{
    $adminManager = new AdminManager();
    $delet = $adminManager->deletArticle($_GET['id']);
    if ($delet === false) {
        throw new Exception('Impossible de supprimer cet Article !');
    }
    else {
        header('Location: index.php?action=voirArt.php');
        echo "Article supprimé !";
        exit;
    }
}
// supprimer un commentaire
function deletCom()
{
    $adminManager = new AdminManager();
    $delet = $adminManager->deletComment($_GET['id']);
    if ($delet === false) {
        throw new Exception('Impossible de supprimer ce commentaire !');
    }
    else {
        header('Location: index.php?action=gestCom.php');
        echo "Commentaire supprimé !";
        exit;
    }
}
// vue Admin gestion des commentaires
function tabCom()
{
    $adminManager = new AdminManager();
    
    $comments = $adminManager->getCom();

    require('vue/admin/gestCom.php');
}
// vue Admin pour la modif d article
function frontModif()
{
        $postManager = new PostManager();
        $post = $postManager->getPost($_GET['id']);
        require('vue/admin/modArt.php');
}
// vue Admin pour voir la page tous les articles
function tabPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('vue/admin/voirArt.php');
}
// fonction Session deconnexion
function destroy()
{
    $deco = session_destroy();
    header('Location: index.php?');
        exit();   
}