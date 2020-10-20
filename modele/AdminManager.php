<?php

require_once('modele/Manager.php');

class AdminManager extends Manager
{
    // fonctions admin
    public function analyseUser()
    {
        $db = $this->dbConnect();
        $reqUser = $db->query('SELECT id, email, pass FROM membres');
        
        return $reqUser;
    }    
    // Fonction log admin
    public function getUser($email, $pass)
    {
        $db = $this->dbConnect();
        $reqUser = $db->prepare('SELECT * FROM membres WHERE email = ?');
        $reqUser->execute(array($email));
        $user = $reqUser->fetch(); 
    
        // test du mot de pass et compare au stockage dans la session
        $testPass = password_verify($pass, $user['pass']);
        if($testPass == true){
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['id'] = $user['id'];
            return true;
        }
        else {
            return false;
        }
    }
    // fonction ajouter un Article
    public function addArticle($idArticle, $titre, $texte)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO articles (id, title, text) VALUES(?, ?, ?)');
        $add = $req->execute(array($idArticle, $titre, $texte));

        return $add;

    }
    // fonction pour modifier article
    public function modArt($idArticle, $titre, $texte)
    {
        $db = $this->dbConnect();
        
        $reqmod = $db->prepare('UPDATE articles SET title = :nvtitle, text = :nvtext WHERE id = :nvid');
        $modifLines = $reqmod->execute(array(
        'nvid' => $idArticle,
        'nvtitle' => $titre,
        'nvtext' => $texte
        ));
        return $modifLines;
    }
    // fonction delete article
    public function deletArticle($id)
    {
        $db = $this->dbConnect();
        $reqDelet = $db->prepare('DELETE FROM articles WHERE id = ?');
        $delete = $reqDelet->execute(array($id));
        return $delete;
    }
    // fonction delete commentaire
    public function deletComment($id)
    {
        $db = $this->dbConnect();
        $reqDelet = $db->prepare('DELETE FROM commentaires WHERE id = ?');
        $delete = $reqDelet->execute(array($id));
        return $delete;
    }
    // voir les commentaires Page gestCom.php
    public function getCom()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, auteur, contenu, report, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM commentaires WHERE report > 0 ORDER BY report DESC');
        $comments->execute(array());

        return $comments;
    }
}