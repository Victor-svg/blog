<?php
require_once('modele/modele.php');
// Connexion Admin
function connect($email, $pass) {
    $user = getUser($email, $pass);
    if($user == true){
        require('vue/admin.php');
    }
    else {
      ?> <script>alert ('mauvais identifiant ou mot de passe'); </script> <?php
       require('vue/connexion.php');
    }
}
// deconnexion
function deco() {
    $deco = destroy();
}
// Ajouter un Article
function addPost($idArticle, $titre, $texte)
{
    $add = addArticle($idArticle, $titre, $texte);

    if ($add === false) {
        throw new Exception("Impossible d'ajouter l'article !");
    }
    else {
        header('Location: index.php?action=voirArt.php');
    }
}
// Modifier un article
function modifArt($idArticle, $titre, $texte)
{
    $modifLines = modArt($idArticle, $titre, $texte);

    if ($modifLines === false) {
        throw new Exception("Impossible de modifier l'article !");
    }
    else {
        header('Location: index.php?action=post&id=' . $idArticle);
    }
}
// supprimer un article
function deletArt()
{
    $delet = deletArticle($_GET['id']);
    if ($delet === false) {
        throw new Exception('Impossible de supprimer cet Article !');
    }
    else {
       echo "Article supprimé !";
        header('Location: index.php?action=voirArt.php');
    }
}
// supprimer un commentaire
function deletCom()
{
    $delet = deletComment($_GET['id']);
    if ($delet === false) {
        throw new Exception('Impossible de supprimer ce commentaire !');
    }
    else {
        echo "Commentaire supprimé !";
        header('Location: index.php?action=gestCom.php');
    }
}
// Report commentaire
function addReport($id)
{
    $addRep = reportCom($_GET['id']);

    if ($addRep === false) {
        throw new Exception('Impossible de signaler !');
    }
    else {
        header('Location: http://localhost/blog_%C3%A9crivain/index.php?');
        exit();      
    }
}