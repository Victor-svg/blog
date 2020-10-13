<?php
require_once('modele/Manager.php');

class PostManager extends Manager
{
    // Requete pour sélectionner les Articles
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, text, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM articles');

        return $req;
    }
    // Renvoyer Un Article suivant son ID ( page Post )
    public function getPost($idArticle)
    {
        $idArticle = intval($idArticle);
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, text, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM articles WHERE id=?');
        $req->execute(array($idArticle));
        $post = $req->fetch();

        return $post;
    }
}